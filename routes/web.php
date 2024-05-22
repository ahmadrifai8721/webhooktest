<?php

use Illuminate\Support\Facades\Route;
use MHasnainJafri\Cpanel\Cpanel;
use Telegram\Bot\Laravel\Facades\Telegram;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get("me", function () {
    // $cpanel =
    //     $cpanel = new Cpanel(env("CPANEL_DOMAIN"), env("CPANEL_API_TOKEN"), env("CPANEL_USERNAME"), 'https', env("CPANEL_PORT"));
    // return response($cpanel->callUAPI("ResourceUsage", "get_usages", [
    //     // "zone" => "koalaterbang.cloud",
    //     // "domain" => "koalaterbang.cloud",
    //     // "system_default" => 0
    // ]));
    // getdomain - Get Domain List
    // getppp - Get PPP List
    // getserver - Get Server List
    // getserverip - Get IP Server List
    // getserverstatus - Get Status Server
    // login - Login To System
    // logout - Logout from system
    $update = Telegram::commandsHandler(true);

    return $update;
});
