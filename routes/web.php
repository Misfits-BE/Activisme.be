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
/** TESTING needed */ Route::get('/admin/users/blokkeer/{id}', 'Auth\BanController@store')->name('admin.users.lock');
/** TESTING needed */ Route::get('/admin/users/activeer/{id}', 'Auth\BanController@destroy')->name('admin.users.activate');

// Account instellingen (routes)
/** TESTING needed */ Route::get('/admin/account/instellingen/{type}', 'Auth\AccountSettingsController@index')->name('account.settings');
/** TESTING needed */ Route::patch('/admin/account/instellingen/info', 'Auth\AccountSettingsController@updateInformation')->name('account.settings.info');
/** TESTING needed */ Route::patch('/admin/account/instellingen/beveiliging', 'Auth\AccountSettingsController@updateSecurity')->name('account.settings.security');

// Home routes
/** TESTING needed */ Route::get('/', 'Frontend\HomeController@index')->name('home.front');
/** TESTING needed */ Route::get('/admin/home', 'HomeController@index')->name('home');

// Address book routes
/** TESTING needed */ Route::get('/admin/contacten', 'Backend\ContactsController@index')->name('admin.contacts.index');
/** TESTING needed */ Route::get('/admin/create', 'Backend\ContactsController@create')->name('admin.contacts.create');
/** TESTING needed */ Route::get('/admin/contacten/verwijder/{id}', 'Backend\ContactsController@destroy')->name('admin.contacts.delete');
/** TESTING needed */ Route::get('/admin/contacten/wijzig/{id}', 'Backend\ContactsController@edit')->name('admin.contacts.edit');
/** TESTING needed */ Route::patch('/admin/contacten/wijzig/{id}', 'Backend\ContactsController@update')->name('admin.contacts.update');
/** TESTING needed */ Route::post('/admin/contacten/opslaan', 'Backend\ContactsController@store')->name('admin.contacts.store');

// Frontend
/** TESTING needed */ Route::get('/disclaimer', 'DisclaimerController@index')->name('disclaimer.index');
/** TESTING needed */ Route::get('/visie', 'Frontend\VisieController@index')->name('visie.index');

// Logs routes
/** TESTING needed */ Route::get('/admin/logs', 'LogsController@index')->name('admin.logs.index');
/** TESTING needed */ Route::get('logs/zoek', 'LogsController@search')->name('admin.logs.search');

// User routes
/** TESTING needed */ Route::get('/admin/users', 'UsersController@index')->name('admin.users.index');
/** TESTING needed */ Route::get('/admin/gebruiker/nieuw', 'UsersController@create')->name('admin.users.create');
/** TESTING needed */ Route::get('/admin/gebruiker/verwijder/{id}', 'UsersController@destroy')->name('admin.users.delete');
/** TESTING needed */ Route::post('/admin/gebruiker/opslaan', 'UsersController@store')->name('admin.users.store');

// Crowdfund routes
/** TESTING needed */ Route::get('ondersteun-ons', 'Frontend\CrowdFundController@index')->name('ondersteuning.index');
/** TESTING needed */ Route::get('ondersteun-ons/{plan}', 'Frontend\CrowdFundController@create')->name('ondersteuning.create');
/** TESTING needed */ Route::get('ondersteun-ons/gift/bedankt/{uuid}', 'Frontend\CrowdFundController@show')->name('ondersteuning.bedanking');

// gift routes
/** TESTING needed */ Route::post('/gift/opslaan', 'Backend\CrowdfundController@store')->name('gift.save');

// Newsletter routes (frontend)
/** TESTING needed */ Route::post('nieuwsbrief/inschrijven', 'Frontend\NewsLetterController@store')->name('nieuwsbrief.inschrijven');
/** TESTING needed */ Route::get('nieuwsbrief/uitschrijven/{uuid}', 'Frontend\NewsLetterController@unsubscribe')->name('nieuwsbrief.uitschrijven');

// Newsletter routes (backend) 
/** TESTING needed */ Route::get('admin/nieuwsbrief/index', 'Backend\NewsLetterController@index')->name('admin.nieuwsbrief.index');
/** TESTING needed */ Route::get('admin/nieuwsbrief/nieuws', 'Backend\NewsLetterController@create')->name('admin.nieuwsbrief.create');
/** TESTING needed */ Route::get('admin/nieuwsbrief/{slug}', 'Backend\NewsLetterController@show')->name('admin.nieuwsbrief.show');
/** TESTING needed */ Route::get('admin/nieuwsbrief/verwijder/{slug}', 'Backend\NewsLetterController@destroy')->name('admin.nieuwsbrief.destroy');
/** TESTING needed */ Route::get('admin/nieuwsbrief/wijzig/{slug}', 'Backend\NewsLetterController@edit')->name('admin.nieuwsbrief.edit');
/** TESTING needed */ Route::post('admin/nieuwsbrief/opslaan', 'Backend\NewsLetterController@store')->name('admin.nieuwsbrief.store');
/** TESTING needed */ Route::get('admin/nieuwsbrief/zend/{slug}', 'Backend\NewsLetterController@send')->name('admin.nieuwsbrief.zend');
/** TESTING needed */ Route::patch('admin/nieuwsbrief/{slug}', 'Backend\NewsLetterController@update')->name('admin.nieuwsbrief.update');

// Category Management routes
/** TESTING needed */ Route::get('/admin/categorieen', 'Backend\TagsController@index')->name('admin.categories.index');
/** TESTING needed */ Route::get('/admin/categorieen/nieuw', 'Backend\TagsController@create')->name('admin.categories.create');
/** TESTING needed */ Route::get('/admin/categorieen/wijzigen/{id}', 'Backend\TagsController@edit')->name('admin.categories.edit');
/** TESTING needed */ Route::get('/admin/categorieen/verwijder/{id}', 'Backend\TagsController@destroy')->name('admin.categories.delete');
/** TESTING needed */ Route::post('/admin/categorieen/opslaan', 'Backend\TagsController@store')->name('admin.categories.store');
/** TESTING needed */ Route::patch('/admin/categorieen/wijzig/{id}', 'Backend\TagsController@update')->name('admin.categories.update');

// Category frontend routes
/** TESTING needed */ Route::get('/categorie/{slug}', 'Frontend\CategoryController@show')->name('categories');

// Contact route 
/** TESTING needed */ Route::post('/contact', 'Frontend\ContactController@send')->name('contact.send');

// Bug routes 
/** TESTING needed */ Route::get('/admin/meld-een-probleem', 'Backend\BugController@index')->name('bug.index');
/** TESTING needed */ Route::post('/admin/meld-een-probleem', 'Backend\BugController@store')->name('bug.create');

// Article routes (backend)
/** TESTING needed */ Route::get('/admin/artikels', 'Backend\ArticleController@index')->name('admin.articles.index');
/** TESTING needed */ Route::get('/admin/artikels/nieuw', 'Backend\ArticleController@create')->name('admin.articles.create');
/** TESTING needed */ Route::post('/admin/artikels/store', 'Backend\ArticleController@store')->name('admin.articles.store');
/** TESTING needed */ Route::get('/admin/artikels/wijzig/{id}', 'Backend\ArticleController@edit')->name('admin.articles.edit');
/** TESTING needed */ Route::get('/admin/artikels/verwijder/{id}', 'Backend\ArticleController@delete')->name('admin.articles.delete');
/** TESTING needed */ Route::patch('/admin/artikels/wijzig/{id}', 'Backend\ArticleController@update')->name('admin.articles.update');

// Article routes (frontend)
/** TESTING needed */ Route::get('/nieuws', 'Frontend\ArticleController@index')->name('news.index');
/** TESTING needed */ Route::get('/nieuws/{slug}', 'Frontend\ArticleController@show')->name('news.show');

// Article status routes
/** TESTING needed */ Route::get('admin/article/status/{article}/{status}', 'Backend\ArticleStatusController@update')->name('admin.status.change');

// Calendar routes
/** TESTING needed */ Route::get('/kalender', 'Frontend\CalendarController@index')->name('calendar.index');

/** TESTING needed */ Route::get('/admin/kalender/status/{event}/{status}', 'Backend\CalendarController@status')->name('admin.calendar.status');
/** TESTING needed */ Route::get('/admin/kalender', 'Backend\CalendarController@index')->name('admin.calendar.index');
/** TESTING needed */ Route::get('/admin/kalender/nieuw', 'Backend\CalendarController@create')->name('admin.calendar.create');
/** TESTING needed */ Route::get('/admin/kalender/wijzig/{id}', 'Backend\CalendarController@edit')->name('admin.calendar.edit');
/** TESTING needed */ Route::get('/admin/kalender/verwijder/{id}', 'Backend\CalendarController@destroy')->name('admin.calendar.destroy');
/** TESTING needed */ Route::post('/admin/kalender/opslaan', 'Backend\CalendarController@store')->name('admin.calendar.store');
/** TESTING needed */ Route::patch('/admin/kalender/wijzig/{id}', 'Backend\CalendarController@update')->name('admin.calendar.update');