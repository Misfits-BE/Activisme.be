<?php

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

// Authencation related routes.
Auth::routes();

// Ban routes 
Route::get('/admin/users/blokkeer/{id}', 'Auth\BanController@store')->name('admin.users.lock');
Route::get('/admin/users/activeer/{id}', 'Auth\BanController@destroy')->name('admin.users.activate');

// Account instellingen (routes)
Route::get('/admin/account/instellingen/{type}', 'Auth\AccountSettingsController@index')->name('account.settings');
Route::patch('/admin/account/instellingen/info', 'Auth\AccountSettingsController@updateInformation')->name('account.settings.info');
Route::patch('/admin/account/instellingen/beveiliging', 'Auth\AccountSettingsController@updateSecurity')->name('account.settings.security');

// Home routes
Route::get('/', 'Frontend\HomeController@index')->name('home.front');
Route::get('/admin/home', 'HomeController@index')->name('home');

// Address book routes
Route::get('/admin/contacten', 'Backend\ContactsController@index')->name('admin.contacts.index');
Route::get('/admin/create', 'Backend\ContactsController@create')->name('admin.contacts.create');
Route::get('/admin/contacten/verwijder/{id}', 'Backend\ContactsController@destroy')->name('admin.contacts.delete');
Route::get('/admin/contacten/wijzig/{id}', 'Backend\ContactsController@edit')->name('admin.contacts.edit');
Route::patch('/admin/contacten/wijzig/{id}', 'Backend\ContactsController@update')->name('admin.contacts.update');
Route::post('/admin/contacten/opslaan', 'Backend\ContactsController@store')->name('admin.contacts.store');

// Frontend
Route::get('/disclaimer', 'DisclaimerController@index')->name('disclaimer.index');
Route::get('/visie', 'Frontend\VisieController@index')->name('visie.index');

// Logs routes
Route::get('/admin/logs', 'LogsController@index')->name('admin.logs.index');
Route::get('logs/zoek', 'LogsController@search')->name('admin.logs.search');

// User routes
Route::get('/admin/users', 'UsersController@index')->name('admin.users.index');
Route::get('/admin/gebruiker/nieuw', 'UsersController@create')->name('admin.users.create');
Route::get('/admin/gebruiker/verwijder/{id}', 'UsersController@destroy')->name('admin.users.delete');
Route::post('/admin/gebruiker/opslaan', 'UsersController@store')->name('admin.users.store');

// Crowdfund routes
Route::get('ondersteun-ons', 'Frontend\CrowdFundController@index')->name('ondersteuning.index');
Route::get('ondersteun-ons/{plan}', 'Frontend\CrowdFundController@create')->name('ondersteuning.create');
Route::get('ondersteun-ons/gift/bedankt/{uuid}', 'Frontend\CrowdFundController@show')->name('ondersteuning.bedanking');

// gift routes
Route::post('/gift/opslaan', 'Backend\CrowdfundController@store')->name('gift.save');

// Newsletter routes (frontend)
Route::post('nieuwsbrief/inschrijven', 'Frontend\NewsLetterController@store')->name('nieuwsbrief.inschrijven');
Route::get('nieuwsbrief/uitschrijven/{uuid}', 'Frontend\NewsLetterController@unsubscribe')->name('nieuwsbrief.uitschrijven');

// Newsletter routes (backend) 
Route::get('admin/nieuwsbrief/index', 'Backend\NewsLetterController@index')->name('admin.nieuwsbrief.index');
Route::get('admin/nieuwsbrief/nieuws', 'Backend\NewsLetterController@create')->name('admin.nieuwsbrief.create');

// Contact route 
Route::post('/contact', 'Frontend\ContactController@send')->name('contact.send');

// Bug routes 
Route::get('/admin/meld-een-probleem', 'Backend\BugController@index')->name('bug.index');
Route::post('/admin/meld-een-probleem', 'Backend\BugController@store')->name('bug.create');

// Article routes (backend)
Route::get('/admin/artikels', 'Backend\ArticleController@index')->name('admin.articles.index');
Route::get('/admin/artikels/nieuw', 'Backend\ArticleController@create')->name('admin.articles.create');
Route::post('/admin/artikels/store', 'Backend\ArticleController@store')->name('admin.articles.store');
Route::get('/admin/artikels/wijzig/{id}', 'Backend\ArticleController@edit')->name('admin.articles.edit');
Route::get('/admin/artikels/verwijder/{id}', 'Backend\ArticleController@delete')->name('admin.articles.delete');

// Article routes (frontend)
Route::get('/nieuws', 'Frontend\ArticleController@index')->name('news.index');
Route::get('/nieuws/{slug}', 'Frontend\ArticleController@show')->name('news.show');

// Article status routes
Route::get('admin/article/status/{article}/{status}', 'Backend\ArticleStatusController@update')->name('admin.status.change');

// Calendar routes
Route::get('/kalender', 'Frontend\CalendarController@index')->name('calendar.index');

Route::get('/admin/kalender/status/{event}/{status}', 'Backend\CalendarController@status')->name('admin.calendar.status');
Route::get('/admin/kalender', 'Backend\CalendarController@index')->name('admin.calendar.index');
Route::get('/admin/kalender/nieuw', 'Backend\CalendarController@create')->name('admin.calendar.create');
Route::get('/admin/kalender/verwijder/{id}', 'Backend\CalendarController@destroy')->name('admin.calendar.destroy');
Route::post('/admin/kalender/opslaan', 'Backend\CalendarController@store')->name('admin.calendar.store');