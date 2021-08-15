<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\Contact;
use App\Http\Livewire\PostCrud;
use App\Http\Livewire\Diaporama;
use App\Http\Livewire\UploadPhoto;
use App\Http\Livewire\AdherentCrud;
use App\Http\Livewire\ShowAdherent;
use App\Http\Livewire\InfoletterCrud;
use App\Http\Livewire\ShowActivities;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RegistrationCrud;
use App\Http\Livewire\ShowContactPeople;
use App\Http\Livewire\ShowDocumentStatutaires;
use App\Http\Livewire\ContactMessageConfirmation;
use App\Http\Livewire\ShowPost;use App\Http\Livewire\ShowPostList;

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



Route::get('/contact',Contact::class)->name('contact');

Route::get('/who-to-contact',ShowContactPeople::class)->name('who-to-contact');

Route::get('verify-contact-email/{token}',ContactMessageConfirmation::class);

Route::get('/show-activities',ShowActivities::class)->name('show-activities');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/post', PostCrud::class)->name('post')->middleware('auth');

Route::get('/post/{id}',ShowPost::class)->name('post.show')->middleware('auth');

//compatibility with old posts Lire la suite
Route::get('/posts/{id}',ShowPost::class)->name('posts.show')->middleware('auth');

Route::get('/post-list/{year}',ShowPostList::class)->name('post.list')->middleware('auth');

Route::get('/registration/{post_id}',RegistrationCrud::class)->name('registration')->middleware('auth');

//Route::get('/diaporama/show/{post_id}/{dir}','App\Http\Controllers\DiaporamaController@show')->name('diaporama')->where('dir', '(.*)');;

Route::get('/diaporama/show/{post_id}/{dir}',Diaporama::class)->name('diaporama')->where('dir', '(.*)')->middleware('auth');

Route::get('/adherent/',AdherentCrud::class)->name('adherent')->middleware('can:isAtLeastManager');

Route::get('show-adherent',ShowAdherent::class)->name('show-adherent')->middleware('auth');

Route::get('infoletter/',InfoletterCrud::class)->name('infoletter')->middleware('auth');

Route::get('/',Home::class)->name('home');

Route::get('/upload-photo',UploadPhoto::class)->name('upload-photo')->middleware('auth');

Route::get('doc-statut',ShowDocumentStatutaires::class)->name('doc-statut');

Route::get('/download/{file}','App\Http\Controllers\AccessDownloadablesController@download')->name('download')->where('file', '(.*)')->middleware('auth');


Route::get('/display/{file}','App\Http\Controllers\AccessDownloadablesController@display')->name('display')->where('file', '(.*)')->middleware('auth');
