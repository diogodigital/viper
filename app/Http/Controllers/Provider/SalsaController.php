<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\CasinoGamesSalsa;
use App\Models\Category;
use App\Traits\Providers\SalsaGamesTrait;
use Illuminate\Http\Request;

class SalsaController extends Controller
{
    use SalsaGamesTrait;

    /**
     * @return false|string
     */
    public function getAll()
    {
        $query_games = CasinoGamesSalsa::query();

        if(isset($request->category) && !empty($request->category)) {
            $category = Category::whereSlug($request->category)->first();
            if(!empty($category)) {
                $query_games->where('casino_category_id', $category->id);
            }
        }

        if(isset($request->searchTerm) && !empty($request->searchTerm) && strlen($request->searchTerm) > 2) {
            $query_games->whereLike(['name', 'provider', 'technology'], $request->searchTerm);
        }

        $games = $query_games->orderBy('views', 'desc')->paginate();
        return json_encode(['status' => true, 'games' => $games]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['gamesSalsa'])
            ->whereHas('gamesSalsa', function ($query) {
                $query->where('active', 1)->orderBy('views', 'asc');
            })
            ->orderBy('name', 'desc')
            ->get();

        return response()->json(['categoriesSalsa' => $categories], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        if(auth()->check()) {
            $game = CasinoGamesSalsa::whereActive(1)->where('slug', $slug)->first();

            if(!empty($game)) {
                $game->increment('views', 1); // add mais uma visualização

                ///$game->game_label,
                $gameLabel = 'gpi-validation';

                $token = \Helper::MakeToken([
                    'id' => auth()->user()->id,
                    'game' => $gameLabel,
                ]);

                return response()->json([
                    'game' => $game,
                    'gameUrl' => self::playGameSalsa(
                        $game->game_pn,
                        'CHARGED',
                        'BRL',
                        'BR',
                        $gameLabel
                    ),
                    'token' => $token
                ]);
            }

            return response()->json(['error' => ''], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function webhookMethod(Request $request)
    {
        return self::webhookSalsa($request);
    }
}
