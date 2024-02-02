<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialAuthController extends Controller
{
    use AffiliateHistoryTrait;

    /**
     * Login with social OAuth feature
     *
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param $driver
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            $existing_user = User::where('oauth_id', $user->getId())->orWhere([
                ['oauth_id', '=', NULL],
                ['email', '=', $user->email]
            ])->first();

            if ($existing_user) {
                Auth::login($existing_user);
                return redirect()->to(url('/'));
            } else {
                $new_user = User::create([
                    'name'          => $user->getName(),
                    'email'         => $user->getEmail(),
                    'oauth_id'      => $user->getId(),
                    'oauth_type'    => $driver,
                    'password'      => $user->getEmail(),
                ]);

                event(new Registered($new_user));
                Auth::login($new_user);

                Wallet::create([
                    'user_id' => $new_user->id,
                    'balance' => 0,
                    'balance_bonus' => 0
                ]);

                if(!empty($new_user->inviter)) {
                    self::saveAffiliateHistory($new_user);
                }

                return redirect()->to(url('/'))->with('success', 'Sua conta foi ativada com sucesso, a senha de acesso foi enviada para seu E-mail');
            }

        } catch (Exception $e) {
            return redirect()->to(url('/'))->with('error', 'Login with your social media account has failed, try again or register with email');
        }
    }


}
