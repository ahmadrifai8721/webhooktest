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

Route::get("setWebhook", function () {
    $url = "https://webhook." . env("CPANEL_DOMAIN") . "/me";
    // dd($url);
    return Telegram::setWebhook(["url" => $url]);
});
Route::get("webhookStatus", function () {

    $data = [
        Telegram::getWebhookInfo(),
        Telegram::getWebhookUpdate(),
    ];

    return $data;
});

Route::any("me", function () {

    $update = Telegram::commandsHandler(true);
    $chatID = $update->getChat();

    $teleSend = Telegram::sendMessage([
        'chat_id' => 844478228,
        'text' => "$chatID"
    ]);

    return response()->json(json_encode($teleSend), 200);
});
Route::get("UAPI", function () {
    $cpanel =
        $cpanel = new Cpanel(env("CPANEL_DOMAIN"), env("CPANEL_API_TOKEN"), env("CPANEL_USERNAME"), 'https', env("CPANEL_PORT"));
    // return response($cpanel->callUAPI("VersionControl", "update", [
    //     // "zone" => "koalaterbang.cloud",
    //     // "domain" => "koalaterbang.cloud",
    //     // "system_default" => 0,
    //     "repository_root" => "/home/koab8571/public_html/webhook/",
    // ]), 200);
});
