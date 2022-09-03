<?php

use App\Jobs\newCake;
use App\Models\Cake;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function() {

    Route::apiResource('/cakes', 'CakeController');

    Route::post("/interest_list");

    Route::post('/send-email', function() {
        $emails = Email::all();
        foreach ($emails as $email) {
            $cakes = $email->cakes()->get();

            $dataCakes = [];
            foreach ($cakes as $cake) {
                $dataCakes[] = [
                    'nome' => $cake->nome,
                    'peso' => $cake->peso,
                    'valor' => $cake->valor,
                ];
            }

            newCake::dispatch($email['email'], $dataCakes);
        }

        return response()->json(["message" => "Email enviado."]);
    });


});
