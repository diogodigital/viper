<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FiversGame;
use App\Models\FiversProvider;
use App\Models\Game;
use App\Models\GameExclusive;
use App\Models\VibraCasinoGame;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $games = Game::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('uuid', 'like', "%$searchTerm%");
        })
        ->whereActive(1)
        ->get();

        $gamesExclusives = GameExclusive::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%")
                ->orWhere('description', 'like', "%$searchTerm%");
        })
        ->whereActive(1)
        ->orderBy('views', 'desc')
        ->get();

        $providers = FiversProvider::with('games')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->whereHas('games', function ($query) use ($searchTerm) {
                $query->where('status', 1)
                    ->where('name', 'like', "%$searchTerm%")
                    ->orderBy('views', 'asc');
            })
            ->orderBy('name', 'desc')
            ->get();

        $gamesVibra = VibraCasinoGame::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('game_name', 'like', "%$searchTerm%");
        })
        ->whereStatus(1)
        ->limit(24)
        ->get();

        return view('web.home.index', [
            'games' => $games,
            'providers' => $providers,
            'gamesExclusives' => $gamesExclusives,
            'gamesVibra' => $gamesVibra,
            'searchTerm' => $searchTerm
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function banned()
    {
        return view('web.banned.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function howWorks()
    {
        return view('web.home.how-works');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function aboutUs()
    {
        return view('web.home.about-us');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function suporte()
    {
        return view('web.home.suporte');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function showGameByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if(!empty($category)) {
            $games = Game::where('category_id', $category->id)->whereActive(1)->paginate();
            $gamesFivers = FiversGame::where('casino_category_id', $category->id)->whereStatus(1)->paginate();

            return view('web.categories.index', compact(['games', 'gamesFivers', 'category']));
        }

        return back();
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
