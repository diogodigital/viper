<?php

namespace  App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FiversGame;
use App\Models\FiversProvider;
use App\Traits\Providers\FiversTrait;
use Illuminate\Http\Request;

class FiversController extends Controller
{
    use FiversTrait;

    /**
     * @return false|string
     */
    public function getAll()
    {
        $query_games = FiversGame::query();
        $query_games->where('status', 1);

        if(isset($request->provider) && !empty($request->provider)) {
            $provider = FiversProvider::whereCode($request->provider)->first();
            if(!empty($provider)) {
                $query_games->where('fivers_provider_id', $provider->id);
            }
        }

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 2) {
            $query_games->whereLike(['game_code', 'game_name'], $request->searchTerm);
        }

        $games = $query_games->orderBy('views', 'desc')->paginate();
        return json_encode(['status' => true, 'games' => $games]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = FiversProvider::with(['games'])
            ->whereHas('games', function ($query) {
                $query->where('status', 1)
                    ->orderBy('views', 'asc')
                    ->limit(12);
            })
            ->orderBy('name', 'desc')
            ->get();

        return response()->json(['providers' => $providers], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->check()) {
            $fiver = FiversGame::with(['provider'])->where('game_code', $id)->where('status', 1)->first();
            if(!empty($fiver)) {
                $launch = self::gameLaunch($fiver->provider->code, $fiver->game_code, 'pt', auth()->id());

                if(isset($launch['status']) && $launch['status'] == 1) {
                    return view('web.fivers.index', [
                        'game' =>$fiver,
                        'gameUrl' => $launch['launch_url'],
                    ]);
                }
                return redirect(route('web.game.maintenance.index'));
            }

            return back()->with('error', 'Jogo não encontrado');
        }
        return back()->with('error', 'Faça login pra continuar');
    }

    /**
     * Update the specified resource in storage.
     */
    public function webhookMethod(Request $request)
    {
        return self::webhooks($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
