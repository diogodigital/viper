<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('clear', function () {
    \Artisan::call('optimize:clear');
//    \Artisan::call('config:cache');
//    \Artisan::call('cache:clear');
//    \Artisan::call('config:clear');
//    \Artisan::call('view:clear');
//    \Artisan::call('route:clear');

    echo 'Tudo apagado com sucesso';
})->describe('Apagar geral');
