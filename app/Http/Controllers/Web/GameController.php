<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FiversGame;
use App\Models\FiversProvider;
use App\Models\Game;
use App\Models\GameExclusive;
use App\Models\VibraCasinoGame;
use App\Traits\Providers\SlotegratorTrait;
use Illuminate\Http\Request;

class GameController extends Controller
{
    use SlotegratorTrait;

    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->first();
        if(!empty($game)) {
            if(auth()->check()) {

                $token = '';
                $time = time()-34;

                // FORCANDO A PESSOA IR TELA BANIDO
                if(auth()->user()->banned) return redirect()->to('/banned');

                $token = hash('sha256','md5 cassino'.md5(auth()->user()->email.'-'.time()));
                \DB::table('users')->where('email',auth()->user()->email)->update(array('token_time' => $time,'token' => $token,'logged_in' => 0));

                $gameProvider = null;

                if($game->provider_service == 'slotegrator') {
                    $gameProvider = $this->startGameSlotegrator($game->uuid);
                }

                if(!empty($gameProvider) && $gameProvider['status']) {
                    $game->increment('views', 1);

                    return view('web.game.index', [
                        'game' => $game,
                        'gameUrl' => $gameProvider['game_url'],
                    ]);
                }else{
                    return back()->with($gameProvider);
                }
            }else{
                return redirect()->to('/?action=login');
            }
        }

        return back()->with('error', 'Você precisa fazer login para jogar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function underMaintenance()
    {
        return view('web.game.maintenance');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getListGame(Request $request)
    {
        switch ($request->tab) {
            case 'fivers':
                $games = $this->listFivers($request);
                break;
            case 'exclusives':
                $games = $this->listExclusives($request);
                break;
            case 'vibra':
                $games = $this->listVibra($request);
                break;
            default:
                $games = $this->listProvider($request);
                break;
        }

        $search = $request->searchTerm ?? '';
        $tab = $request->tab;

        return view('web.game.list', compact(['games', 'search', 'tab']));
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function listVibra($request)
    {
        $query_games = VibraCasinoGame::query();
        $query_games->whereStatus(1);

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 3) {
            $query_games->whereLike(['game_name', 'game_id'], $request->searchTerm);
        }

        return $query_games->paginate()->appends(request()->query());
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function listFivers($request)
    {
        $provider = FiversProvider::where('code', $request->provider)->first();

        $query_games = FiversGame::query();
        $query_games->whereStatus(1);
        $query_games->where('fivers_provider_id', $provider->id);

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 3) {
            $query_games->whereLike(['game_code', 'game_name'], $request->searchTerm);
        }

        return $query_games->paginate()->appends(request()->query());
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function listExclusives($request)
    {
        $query_games = GameExclusive::query();
        $query_games->whereActive(1);

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 3) {
            $query_games->whereLike(['name', 'uuid'], $request->searchTerm);
        }

        return $query_games->paginate()->appends(request()->query());
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function listProvider($request)
    {
        $query_games = Game::query();
        $query_games->whereActive(1);

        if(isset($request->tab)) {
            switch ($request->tab) {
                case 'popular':
                    $query_games->orderBy('views', 'desc');
                    break;
            }

        }

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 3) {
            $query_games->whereLike(['name', 'provider', 'provider_service'], $request->searchTerm);
        }

        return $query_games->paginate()->appends(request()->query());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
