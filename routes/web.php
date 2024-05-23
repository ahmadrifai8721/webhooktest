<?php

use App\Models\LoginSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
})->name("Home");

Route::get("Login", function () {
    return view("LoginWidget");
})->name("login");

Route::get("setWebhook", function () {
    $url = "https://webhook." . env("CPANEL_DOMAIN") . "/me";
    // dd($url);
    return Telegram::setWebhook(["url" => $url]);
});
Route::get("webhookStatus", function () {

    $data = [
        "last_error_date" => date("d/F/Y H:i:s e", Telegram::getWebhookInfo()->last_error_date),
        "last_error_message" => Telegram::getWebhookInfo()->last_error_message,
        "status_code" => 200
    ];

    return response()->json($data, 200);
});

Route::get("webhookLogin", function (Request $request) {

    LoginSession::create([
        'chatId' => $request->input("id"),
        'name' => $request->input('first_name') . " " . $request->input('last_name'),
        'username' => $request->input('username'),
        'auth_date' => $request->input('auth_date'),
        'token' => $request->input('hash'),
    ]);

    return redirect()->route("Home");
})->name("webhookLogin");

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


Route::get("Artisan/{Command}", function ($Command) {

    return Artisan::call($Command);
});
