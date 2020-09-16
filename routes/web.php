<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

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

Route::get('/email', function ($post_id,$dir) {
    Mail::to('jose.fournier@mailbox.org')->send(new WelcomeMail());
    return 'done';
});

Route::get('/', 'HomeController@index')->name('home-direct');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/filemanager','FilemanagerController@index')->name('filemanager.index');
Route::post('/filemanager/manage','FilemanagerController@manage')->name('filemanager.manage');

Route::post('/filemanager/testajax','FilemanagerController@testajax');

Route::get('/contact','ContactController@index')->name('contact');
Route::post('/contact','ContactController@sendMessage');

Auth::routes(['verify' => true]);
Route::post('captcha-validation', 'CaptchaServiceController@capthcaFormValidate');
Route::get('reload-captcha', 'CaptchaServiceController@reloadCaptcha');

Route::get('/download/display/{file}','DownloadController@display')->name('download.display')->where('file', '(.*)')->middleware('verified');
Route::get('/download/serve/{file}','DownloadController@serve')->name('download.serve')->where('file', '(.*)')->middleware('verified');




Route::resource('posts','PostsController')->middleware('verified');
Route::get('posts/narratives/{year}','PostsController@narratives')->name('posts.narratives')->middleware('verified');

Route::post('/comments','CommentController@store')->name('storeAjax')->middleware('verified');
Route::get('/diaporama/show/{post_id}/{dir}','DiaporamaController@show')->name('diaporama')->middleware('verified');

Route::get('registrations/{post_id}','RegistrationController@index')->name('registration.index')->middleware('verified');
Route::get('registrations/create/{post_id}','RegistrationController@create')->name('registration.create')->middleware('verified');
Route::post('registrations','RegistrationController@store')->name('registration.store')->middleware('verified');
Route::delete('registrations/destroy/{id}','RegistrationController@destroy')->name('registration.destroy')->middleware('verified');
Route::get('registrations/edit/{id}','RegistrationController@edit')->name('registration.edit')->middleware('verified');
Route::put('registrations/{id}','RegistrationController@update')->name('registration.update')->middleware('verified');

Route::get('infoletters','InfoletterController@index')->name('infoletter.index')->middleware('verified');
Route::get('infoletters/create','InfoletterController@create')->name('infoletter.create')->middleware('verified');
Route::get('infoletters/send/{id}','InfoletterController@send')->name('infoletter.send')->middleware('verified');
Route::get('infoletters/view/{id}','InfoletterController@view')->name('infoletter.view')->middleware('verified');
Route::get('infoletters/edit/{id}','InfoletterController@edit')->name('infoletter.edit')->middleware('verified');
Route::post('infoletters','InfoletterController@store')->name('infoletter.store')->middleware('verified');
Route::post('infoletters/sendToOne','InfoletterController@sendToOne')->name('infoletter.sendToOne')->middleware('verified');
Route::put('infoletters','InfoletterController@update')->name('infoletter.update')->middleware('verified');
Route::delete('infoletters/destroy/{id}','InfoletterController@destroy')->name('infoletter.destroy')->middleware('verified');

Route::get('adherents','AdherentController@index')->name('adherent.index')->middleware('verified');
Route::get('adherents/create','AdherentController@create')->name('adherent.create')->middleware('verified');
Route::post('adherents','AdherentController@store')->name('adherent.store')->middleware('verified');
Route::get('adherents/edit/{id}','AdherentController@edit')->name('adherent.edit')->middleware('verified');
Route::put('adherents','AdherentController@update')->name('adherent.update')->middleware('verified');
Route::delete('adherents/destroy/{id}','AdherentController@destroy')->name('adherent.destroy')->middleware('verified');

Route::get('surveys','SurveyController@index')->name('survey.index');
Route::get('survey/create','SurveyController@create')->name('survey.create');
Route::get('surveys/send/{id}','SurveyController@send')->name('survey.send');
Route::get('surveys/view/{id}','SurveyController@view')->name('survey.view');
Route::get('surveys/edit/{id}','SurveyController@edit')->name('survey.edit');
Route::post('surveys','SurveyController@store')->name('survey.store');
Route::post('surveys/sendToOne','SurveyController@sendToOne')->name('survey.sendToOne');
Route::put('surveys','SurveyController@update')->name('survey.update');
Route::delete('surveys/destroy/{id}','SurveyController@destroy')->name('survey.destroy');

Route::get('upload','UploadController@index')->name('upload.index');
Route::post('upload','UploadController@upload')->name('upload.upload');

Route::any('{catchall}',function(){
  return 'aucune route ne correspond à votre url';
});
Auth::routes();




