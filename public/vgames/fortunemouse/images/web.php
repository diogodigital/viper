<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'SiteController@home');
Route::get('/support', 'SiteController@support');
Route::get('/home', 'SiteController@home');
Route::get('/newmenu', 'SiteController@newmenu');
Route::get('/faq', 'SiteController@faq');
Route::get('/games', 'SiteController@games');
Route::get('/admin', 'SiteController@admin');
Route::get('/update', 'SiteController@update');

Route::get('/double', 'SiteController@roulette');
Route::get('/x-double', 'SiteController@doubleplus');
Route::get('/tower', 'SiteController@tower');
Route::get('/crash', 'SiteController@crash');
Route::get('/coinflip', 'SiteController@coinflip');
Route::get('/jackpot', 'SiteController@jackpot');
Route::get('/dice', 'SiteController@dice');
Route::get('/terms', 'SiteController@terms');
Route::get('/recompensas', 'SiteController@rewards');
Route::get('/originais', 'SiteController@originais');
Route::get('/lives', 'SiteController@lives');
Route::get('/cassino', 'SiteController@cassino');
Route::get('/casino/providers/pgsoft', 'SiteController@pgsoft');
Route::get('/casino/providers/spribe', 'SiteController@spribe');
Route::get('/casino/providers/evolution', 'SiteController@evolution');
Route::get('/casino/providers/evoplay', 'SiteController@evoplay');
Route::get('/casino/providers/pragmatic', 'SiteController@pragmatic');
Route::get('/casino/providers/smartsoft', 'SiteController@smartsoft');
Route::get('/casino/providers/bgaming', 'SiteController@bgaming');
Route::get('/casino/providers', 'SiteController@providers');
Route::get('/aovivo', 'SiteController@aovivo');
Route::get('/construction', 'SiteController@construction');


// JOGO PIRATASSS COLOQUE AQUI
Route::get('/pg/tiger', 'JogosController@tigerGame');
Route::get('/pg/mouse', 'JogosController@mouseGame');


Route::get('/user/deposit', 'SiteController@deposit');
Route::get('/user/withdraw', 'SiteController@withdraw');
Route::get('/user/profile', 'SiteController@profile');
Route::get('/user/referrals', 'SiteController@referrals');
Route::get('/ref/{code}', 'SiteController@refcode');

Route::get('auth/login/{email}/{username}/{password}/{name}/{last_name}/{cpf}/{phone}', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');

Route::get('api/transaction-history', 'ApiController@transaction_history');
Route::get('api/betting-history', 'ApiController@betting_history');
Route::get('api/site-inventory', 'ApiController@site_inventory');
Route::get('api/free-coins', 'ApiController@free_coins');
Route::post('api/affiliates-collect', 'ApiController@affiliates_collect');

Route::get('/spribe/{game}', 'SlotsController@spribeGame');

Route::group(['prefix' => '/api', 'middleware' => 'secretKey'], function () {
    Route::group(['prefix' => '/spribe'], function() {
        Route::post('/auth', 'SlotsController@spribeAuth');
        Route::post('/info', 'SlotsController@spribe');
        Route::post('/deposit', 'SlotsController@spribeDeposit');
        Route::post('/withdraw', 'SlotsController@spribeWithdraw');
        Route::post('/playerNotificationCallback', 'SlotsController@spribe');
        
    });
    
});

Route::group(['prefix' => '/api/slots/evolution/'], function() {
 Route::post('/check', 'EvoController@check');
 Route::post('/balance', 'EvoController@balance');
 Route::post('/debit', 'EvoController@debit');
 Route::post('/cancel', 'EvoController@cancel');
 Route::post('/promo_payout', 'EvoController@promo');
});

Route::group(['prefix' => '/webhooks'], function() {
 Route::post('/check', 'WebhookController@checkByTransactionId');
 Route::post('/checkwithdraw', 'WebhookController@checkWithdrawByTransactionId');
});


// BGAMING
Route::group(['prefix' => '/bgaming'], function () {
	Route::post('/play', 'BgamingController@bgaming');
	Route::post('/rollback', 'BgamingController@bgaming');
	Route::get('/start/{game}/{demo}/{client}', 'BgamingController@newGame');
});

// SLOTEGRATOR
Route::get('/slotegrator/generateGame', ['uses' => 'SlotegratorController@generateGame']);
Route::get('/provider/game/{gameuuid}', ['as' => 'games', 'uses' => 'SlotegratorController@startGame']);
Route::get('/slotegrator/registerGame', ['uses' => 'SlotegratorController@registerGame']);
//Route::get('/provider/game/{gameUuid}', ['uses' => 'SlotegratorController@startGameWithUrlOriginal']);
Route::post('/slotegrator/webhooks', ['uses' => 'SlotegratorController@webhooks']);
Route::get('/slotegrator/limit', ['uses' => 'SlotegratorController@limits']);
Route::get('/slotegrator/selfvalidation', ['uses' => 'SlotegratorController@selfvalidation']);

Route::get('/evolution/lobby/{gameuuid}', ['uses' => 'SlotegratorController@startGameLobby']);

Route::get('/login_requery', 'SiteController@login_requery');