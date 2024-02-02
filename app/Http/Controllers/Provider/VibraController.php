<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\VibraCasinoGame;
use App\Traits\Providers\VibraTrait;
use Illuminate\Http\Request;

class VibraController extends Controller
{
    use VibraTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->check()) {
            return view('web.vibra.index', ['gameURL' => self::GenerateGameLaunch()]);
        }

        return redirect(url('/'))->with('error', 'Você precisa logar para iniciar esse jogo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function startGameVibra(Request $request)
    {
        return self::GameLaunch();
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function webhookMethod(Request $request, $parameters)
    {
        return self::WebhookData($request, $parameters);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        if(auth()->check()) {
            $vibra = VibraCasinoGame::where('game_id', $id)->first();
            return view('web.vibra.index', ['gameURL' => self::GenerateGameLaunch($vibra)]);
        }
        return redirect(url('/'))->with('error', 'Você precisa logar para iniciar esse jogo');
    }

}
