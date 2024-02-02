<?php

namespace App\Http\Controllers\Api\Providers;

use App\Helpers\Core as Helper;
use App\Http\Controllers\Controller;
use App\Models\GameExclusive;
use Illuminate\Http\Request;

class VGamesController extends Controller
{
    /**
     * vGame Provider
     * Store a newly created resource in storage.
     */
    public function vgameProvider(Request $request, $token, $action)
    {
        $tokenOpen = Helper::DecToken($token);
        $validEndpoints = ['session', 'icons', 'spin', 'freenum'];

        if (in_array($action, $validEndpoints)) {
            if(isset($tokenOpen['status']) && $tokenOpen['status'])
            {
                $game = GameExclusive::whereActive(1)->where('uuid', $tokenOpen['game'])->first();
                if(!empty($game)) {
                    $controller = \Helper::createController($game->uuid);

                    switch ($action) {
                        case 'session':
                            return $controller->session($token);
                        case 'spin':
                            return $controller->spin($request, $token);
                        case 'freenum':
                            return $controller->freenum($request, $token);
                        case 'icons':
                            return $controller->icons();
                    }
                }
            }
        } else {
            return response()->json([], 500);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.vgames.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        if(auth()->check()) {
            $game = GameExclusive::whereActive(1)->where('uuid', $slug)->first();
            if(!empty($game)) {
                $game->increment('views', 1); // add mais uma visualização

                $token = \Helper::MakeToken([
                    'id' => auth()->user()->id,
                    'game' => $slug
                ]);

                return view('web.vgames.play', [
                    'game' => $game,
                    'gameUrl' => url('/vgames/'.$slug.'/'),
                    'token' => $token
                ]);
            }

            return back()->with('error', 'UUID Errado');
        }

        return back()->with('error', 'Você precisa fazer login para jogar');
    }
}
