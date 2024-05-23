<?php

use Illuminate\Http\Request;
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

Route::get("webhookLogin", function (Request $request) {
    return $request;
});

Route::any("me", function () {

    $update = Telegram::commandsHandler(true);
    // $chatID = $update->getChat()->getId();
    // $getMessage = $update->getMessage();

    // $teleSend = Telegram::sendMessage([
    //     'chat_id' => $chatID,
    //     'text' => "$getMessage"
    // ]);

    // return response()->json(json_encode($teleSend), 200);
    return response(200);
});
Route::get("UAPI", function () {
    $cpanel =
        $cpanel = new Cpanel(env("CPANEL_DOMAIN"), env("CPANEL_API_TOKEN"), env("CPANEL_USERNAME"), 'https', env("CPANEL_PORT"));
    return response($cpanel->callUAPI("VersionControlDeployment", "create", [
        // "zone" => "koalaterbang.cloud",
        // "domain" => "koalaterbang.cloud",
        // "system_default" => 0,
        "repository_root" => "/home/koab8571/public_html/webhook/",
    ]), 200);
});
