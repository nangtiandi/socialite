<?php

use App\Models\User;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/login/google',[LoginController::class,'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback',[LoginController::class,'handleGoogleCallback']);

Route::get('/login/github',[LoginController::class,'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback',[LoginController::class,'handleGithubCallback']);

Route::get('/login/facebook',[LoginController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback',[LoginController::class,'handleFacebookCallback']);



//Route::get('/login/github', function () {
//    return Socialite::driver('github')->redirect();
//});
//
//Route::get('/login/github/callback', function () {
//    $githubUser = Socialite::driver('github')->user();
////    create a new user our database
//    $user = User::firstOrCreate(
//        [
//            'provider_id' => $githubUser->getId(),
//        ],
//        [
//            'name' => $githubUser->getName(),
//            'email' => $githubUser->getEmail(),
//        ]
//    );
//  *********************  Another Way login **********************
//    $user = User::where('provider_id', $githubUser->getId())->first();
//
//    if (! $user){
//        $user = User::create([
//            'name' => $githubUser->getName(),
//            'email' => $githubUser->getEmail(),
//            'provider_id' => $githubUser->getId(),
//        ]);
//    }
//    login the user in
//    auth()->login($user,true);
////    return to dashboard
//    return redirect('home');
//
//});
Route::post('register',['AuthController','register']);
Route::get('/sendmail',function(){
    $data = [
        "code" => rand(100000,900000)
    ];
    Mail::to('nangdi00@gmail.com')->send(new VerificationMail($data));
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
