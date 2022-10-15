<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    $company_bs = "Baktify started from our love for music and album, we create Baktify to spread the love in our music community, we started off from street near Rawa Belong street and now we have the most diverse collection of albums and musics. We won't stop until music spreads all over the world";
    $company_ceo = "Conny Blue, CEO Baktify";
    $inquirers = collect([]);
    for ($i = 0; $i < 4; $i++) {
        $inquirers->add([
            "image" => "https://avatars.dicebear.com/api/micah/custom-seed.svg",
            "name" => "Sales Inquirer",
            "email" => "sales@baktify.com",
            "phone" => "+62 1231 1231",
        ]);
    }
    $locations = collect([]);
    for ($i = 0; $i < 4; $i++) {
        $locations->add([
            "city" => "Jakarta",
            "address" => "Jl. Rawa Belong No. 420",
            "postal_code" => "11420"
        ]);
    }

    return view('about', [
        "company_bs" => $company_bs,
        "company_ceo" => $company_ceo,
        "inquirers" => $inquirers,
        "locations" => $locations
    ]);
})->name('about');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
