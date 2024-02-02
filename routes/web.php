<?php

use App\Http\Controllers\Panel\AffiliateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/open', function() {
   $tokenOpen = \Helper::DecToken('b6JnfGF7fXMjOjB79zVoLCJoeWFweCIyICJmZW2xQGRoeWctY1auIjpj8WQjOjAjMTm6OCIrIzRweWUjOjAjMT9pNiQ1NDY7N6Ja');
   dd($tokenOpen);
});
Route::get('/test', [\App\Http\Controllers\Provider\FiversController::class, 'gameLaunchApi']);

include_once(__DIR__ . '/groups/auth/login.php');
include_once(__DIR__ . '/groups/auth/social.php');
include_once(__DIR__ . '/groups/auth/register.php');

// PROVIDERS
include_once(__DIR__ . '/groups/provider/slotegrator.php');
include_once(__DIR__ . '/groups/provider/pragmatic.php');
include_once(__DIR__ . '/groups/provider/suitpay.php');
include_once(__DIR__ . '/groups/provider/bspay.php');
include_once(__DIR__ . '/groups/provider/sqala.php');

Route::prefix('painel')
    ->as('panel.')
    ->middleware(['auth'])
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/panel/wallet.php');
        include_once(__DIR__ . '/groups/panel/profile.php');
        include_once(__DIR__ . '/groups/panel/notifications.php');
        include_once(__DIR__ . '/groups/panel/affiliates.php');
    });

Route::middleware(['web'])
    ->as('web.')
    ->group(function ()
    {
        include_once(__DIR__ . '/groups/web/home.php');
        include_once(__DIR__ . '/groups/web/fivers.php');
        include_once(__DIR__ . '/groups/web/game.php');
        include_once(__DIR__ . '/groups/web/category.php');
        include_once(__DIR__ . '/groups/web/vgames.php');
        include_once(__DIR__ . '/groups/web/vibra.php');
    });


Route::prefix('painel')
    ->as('panel.')
    ->group(function ()
    {
        Route::prefix('affiliates')
            ->as('affiliates.')
            ->group(function () {
                Route::post('/join', [AffiliateController::class, 'joinAffiliate'])->name('join');
            });
    });


include_once(__DIR__ . '/groups/provider/vibra.php');
include_once(__DIR__ . '/groups/provider/fivers.php');
include_once(__DIR__ . '/groups/provider/salsa.php');
