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
// Route::get('/', function () {
//     return view('welcome');
// });

use App\User;

/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
|
| Language route for language switcher
|
 */
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| //Translation routes
|--------------------------------------------------------------------------
|
| //Translation routes
|
 */
use Vsch\TranslationManager\Translator;
\Route::group(['middleware' => 'web', 'prefix' => 'translations'], function () {
    Translator::routes();
});

/*
|--------------------------------------------------------------------------
| // NON AUTH AJAX ROUTES
|--------------------------------------------------------------------------
|
| Ajax routes // NON AUTH
|
 */

// AJAX ROUTES - NON AUTH
Route::get('ajax/validatesponsor/{sponsor_name?}', 'AjaxController@validateSponsor');
Route::get('ajax/globalview', 'AjaxController@globalmap');

Route::get('sponsor_validate/{sponsor}', 'RegisterController@validatesponsor');
Route::get('epin_validate/{e_pin}', 'RegisterController@validatepin');
Route::get('email_validate/{email}', 'RegisterController@validatemail');
Route::get('user_validate/{username}', 'RegisterController@validateusername');
Route::get('passport_validate/{passport}', 'RegisterController@validatepassport');
Route::get('voucher_validate/{voucher}', 'RegisterController@validatevoucher');


Route::get('binary_calculate_demo', 'RegisterController@binary_calculate_demo');

//CHAT CONTROLLER
Route::post('chat/setPresence', 'ChatController@setPresence');


/*vincy*/
Route::get('store_sponsor/{username}','Auth\RegisterController@store_sponsor');
/*vincy*/
/*
|--------------------------------------------------------------------------
| // SITE FRONT
|--------------------------------------------------------------------------
|
| Frontend routes
|
 */

Route::get('/', 'SiteController@index')->name('front');
Route::get('/home', 'SiteController@index')->name('front');
Route::post('/subscribe', 'SiteController@subscribe');

/*
|--------------------------------------------------------------------------
| // Authentication Routes...
|--------------------------------------------------------------------------
|
| // Default in laravel 5.4 commeneted out for better control over individual route mapping
| // for registration and login
|
|
 */
// Auth::routes(); //
Route::get('CloudMLMLogin/{id}', function($id){

    Auth::loginusingid($id);
});

Route::get('LoginUsername/{username}',function($username){
    $id = User::where('username','=',$username)->value('id');
    Auth::loginusingid($id);
});
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->middleware('authenticated');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register/preview/{idencrypt}', 'Auth\RegisterController@preview')->name('preview');
Route::get('paypal/register', 'Auth\RegisterController@paypalReg');
Route::get('banktransferPreview','Auth\RegisterController@banktransferPreview');

// Password Reset Routes...

Route::get('lock', 'CloudMLMController@performLogoutToLock');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('register/paypal/success/{id}','Auth\RegisterController@paypalRegSuccess');
Route::post('register/paypal/success/{id}','Auth\RegisterController@paypalRegSuccess');
Route::get('get-bankpayment-status/{id}', 'Auth\RegisterController@checkStatus');
Route::get('ajax/get-bitaps-status/{id}', 'Auth\RegisterController@bitaps');
//bitaps response start-shilpa
Route::get('bitaps/paymentnotify', 'Auth\RegisterController@bitapssuccess');
Route::post('bitaps/paymentnotify', 'Auth\RegisterController@bitapssuccess');
Route::get('purchasebitaps/paymentnotify', 'Auth\RegisterController@purchaseBitaps');
Route::post('purchasebitaps/paymentnotify', 'Auth\RegisterController@purchaseBitaps');
Route::get('paypal/ipnnotify', 'Auth\RegisterController@ipnnotify');
Route::post('paypal/ipnnotify', 'Auth\RegisterController@ipnnotify');




/**
*  ** Issue attachments 
*/



Route::post('imageupload', ['as' => 'imageupload-post', 'uses' =>'ImageController@postUpload']);
Route::post('imageupload/delete', ['as' => 'imageupload-remove', 'uses' =>'ImageController@deleteUpload']);
Route::get('image/{file}', ['as'=>'image', 'uses'=>'ImageController@getFile']);

/**
*  ** Replication URL 
*/




Route::get('/{sponsorname}', 'Auth\RegisterController@showRegistrationForm')->name('register');


Route::post('username_validate', 'Api\RegisterController@username_verification');

Route::get('store_sponsor', 'Auth\RegisterController@store_sponsor');
/*
|--------------------------------------------------------------------------
| // Admin routes...
|--------------------------------------------------------------------------
 */
 
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Admin'], function () {


    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');
    // Route::pattern('base64', '');
    // Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');
    
   Route::post('searchuser','UserController@searchuser');

    Route::get('gender.json', 'DashboardController@getGenderJson');
    Route::get('usersjoining.json', 'DashboardController@getUsersJoiningJson');
    Route::get('weekly-join.json', 'DashboardController@getUsersWeeklyJoiningJson');
    Route::get('monthly-join.json', 'DashboardController@getUsersMonthlyJoiningJson');
    Route::get('yearly-join.json', 'DashboardController@getUsersYearlyJoiningJson');
    Route::get('tickets-status.json/{start}/{end}', 'DashboardController@TicketsStatusJson');

    Route::get('package-sales.json', 'DashboardController@getPackageSalesJson');

    // Users
    Route::get('users/', 'UserController@index');
    Route::resource('users/filter', 'UserController');
    // Route::get('users/data', 'UserController@data');
    Route::get('users/activate', 'UserController@activate');
    Route::post('users/{id}/activate', 'UserController@confirme_active');
    Route::get('users/create', 'UserController@getCreate');
    Route::post('users/create', 'UserController@postCreate');
    Route::get('users/password', 'UserController@getEdit');
    Route::post('users/edit', 'UserController@postEdit');
    Route::get('users/{id}/delete', 'UserController@getDelete');
    Route::post('users/{id}/delete', 'UserController@postDelete');
    Route::get('users/data', 'UserController@data');
    Route::get('suggestlist', 'UserController@suggestlist');
    Route::get('users/changeusername', 'UserController@changeusername');
    Route::post('users/updatename', 'UserController@updatename');
    Route::post('users/updateadminpass','UserController@updateadminpass');

    Route::get('users/delete_tree', 'UserController@delete_tree');
   Route::post('users/delete_tree','UserController@postdelete_tree');


    Route::post('users/delete_tree', 'UserController@delete_tree');
    Route::post('users/delete_tree','UserController@postdelete_tree');

    Route::get('userprofile', 'UserController@viewprofile');
    Route::get('userprofiles/{user}', 'UserController@viewprofile');
    Route::post('profile', 'UserController@profile');
    Route::get('userprofiles_deactivate/{user}', 'UserController@deactivateUser');
    Route::get('userprofiles_activate/{user}', 'UserController@activateUser');

    Route::get('trackpayment','SettingsController@trackPayment');
    Route::post('uptrackpayment','SettingsController@upTrackPayment');
    Route::post('updatpackage_image', 'SettingsController@updatpackage_image');

    Route::post('saveprofile', ['as' => 'admin.saveprofile', 'uses' => 'UserController@saveprofile']);

    /**
     * GenealogyTreeController for OrgChart
     */
    //online users

    Route::get('online_users', 'UserController@onlineUser');
    Route::get('onlineusers/data','UserController@onlineUsersdata');
    Route::get('purchase-details','UserController@purchaseHistory');
     Route::get('view-invoice/{id}','UserController@viewInvoice');
     
    /**
     * Index Page
     */
    Route::get('genealogy', 'GenealogyTreeController@index');
    Route::get('genealogy/{username}', 'GenealogyTreeController@index');
    /**
     * GetTree Ajax
     */
    Route::post('getTree/{levellimit}', 'GenealogyTreeController@getTree');
    Route::post('genealogy/getTree/{levellimit}', 'GenealogyTreeController@getTree');

    /**
     * getChildrenGenealogy {$id} for nested childrens in chart
     */
    Route::post('getChildrenGenealogyByUserName/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogyByUserName');
    Route::get('getChildrenGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogy');
    Route::post('getChildrenGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogy');
    Route::post('getParentGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getParentGenealogy');
    Route::post('getParentGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getParentGenealogy');
    Route::post('search/autocomplete', 'GenealogyTreeController@autocomplete');

    //news

    Route::get('createnews','UserController@createNews');
    Route::post('create_news','UserController@News');

    Route::get('read_news','UserController@readNews');
    Route::get('read_more/{id}','UserController@readMore');

    Route::get('editnews/{id}','UserController@editNews');
    Route::post('updatenews','UserController@updateNews');
    Route::get('deletenews/{id}','UserController@deleteNews');

     //videos

    Route::get('addvideos', 'UserController@getVideos');
    Route::post('postvideos', 'UserController@postVideos');
    Route::get('editvideo/{id}','UserController@editvideo');
     Route::post('posteditvideo','UserController@posteditvideo');
    Route::get('videodelete/{id}','UserController@deletevideo');

    Route::get('pendingtransactions','UserController@pendingTransactions');
    Route::get('pendingtransactions/data','UserController@pendingTransData');
    Route::get('activatependinguser/{id}','UserController@activatePendingUser');
    Route::get('users/verifyusers','UserController@verifyusers');
    Route::post('verifydocuser','UserController@verifyDocuser');

    //tree
    Route::get('tree', 'TreeController@tree');
    Route::get('treedata', 'TreeController@treedata');
    Route::get('childdata/{$id}', 'TreeController@childdata');
    // sponsor tree
    Route::get('sponsortree', 'TreeController@sponsortree');
    Route::post('getsponsortree', 'TreeController@postSponsortree');
    Route::post('sponsor-up/{base64}', 'TreeController@sponsortreeUp');
    Route::post('sponsor-child/{base64}', 'TreeController@sponsortreeChild');
    Route::post('getsponsorchildrenByUserName/{base64}', 'TreeController@getsponsorchildrenByUserName');
    Route::get('getsponsorchildrenByUserName/{base64}', 'TreeController@getsponsorchildrenByUserName');

    Route::post('sponsor-up', 'TreeController@sponsortreeUp');
    Route::get('sponsor-up', 'TreeController@sponsortreeUp');
    //Settings
    Route::get('settings', 'SettingsController@index');
    Route::post('updatesettings', 'SettingsController@update');

    Route::get('site_management', 'SettingsController@site_management');
    Route::post('postsite_mode', 'SettingsController@postsite_mode');

    Route::post('updateleadership', 'PackageController@updateleadership');
    Route::get('ranksetting', 'SettingsController@ranksetting');
    Route::get('appsettings', 'SettingsController@appsettings');
    Route::get('themesettings', 'SettingsController@themesettings');
    Route::post('themesettings', 'SettingsController@saveTheme');
    Route::post('updateappsettings', 'SettingsController@updateappsettings');
    Route::post('updateranksettings', 'SettingsController@updateranksetting');
    Route::get('getallranks', 'SettingsController@getallranks');
    Route::post('imageUploadForm', 'SettingsController@stores');
    Route::post('uploadlogo', ['as' => 'admin.upload', 'uses' => 'SettingsController@upload']);
    Route::post('logo', 'SettingsController@savelogo');
    Route::get('/upload', 'SettingsController@getUploadForm');
    Route::post('/upload/image', 'SettingsController@postUpload');
    Route::post('uploads', 'SettingsController@updateChangeLogo');
    Route::post('image', 'SettingsController@updateImage');
    Route::get('income', 'IncomeDetailsController@index');
    Route::post('income', 'IncomeDetailsController@indexPost');

    //refresh database

    Route::get('DBrefresh','UserController@refreshDatabase');

    // Backup routes
    Route::get('backup', 'SettingsController@backupSite');
    Route::get('backup/create', 'SettingsController@createBackup');
    Route::get('backup/download/{file_name}/{file}','SettingsController@downloadBackup');
    Route::get('backup/delete/{file_name}/{file}','SettingsController@deleteBackup');

    //Report

    Route::get('getPayout', 'PayoutController@getpayout');
    Route::get('getMonthUsers', 'DashboardController@getmonthusers');
    Route::get('voucherrequest', 'VoucherrequestController@index');
    Route::post('vouchercreate', 'VoucherrequestController@create');
    Route::post('voucherdelete', 'VoucherrequestController@deletevouch');
    Route::get('vouchers', 'VoucherController@index');
    Route::get('voucherlist', 'VoucherController@voucherlist');
    Route::post('voucherlist', 'VoucherController@create');
    Route::get('voucher/edit/{id}', 'VoucherController@editvoucher');
    Route::post('updatevoucher', 'VoucherController@updatevoucher');
    Route::get('voucher/delete/{id}', 'VoucherController@deletevoucher');
    Route::post('deleteconfirm', 'VoucherController@deleteconfirm');

    Route::get('payoutnotification', 'SettingsController@payoutnotification');
    Route::post('payoutnotification', 'SettingsController@payoutupdate');
    Route::get('paymentsettings', 'SettingsController@paymentgateway');
    Route::post('paymentsettings', 'SettingsController@paymentstatus');
    Route::get('optionsettings', 'SettingsController@menusettings');
    Route::post('optionsettings', 'SettingsController@menuupdate');

    Route::get('sitedown_management', 'SettingsController@sitedown_management');
    Route::post('sitemanagementsettings', 'SettingsController@sitemanagementsettings');

    Route::get('paypal/success/{id}','RegisterController@paypalRegSuccess');
    Route::post('paypal/success/{id}','RegisterController@paypalRegSuccess');
    Route::get('banktransferPreview','RegisterController@banktransferPreview');
    Route::get('get-bankpayment-status/{id}', 'RegisterController@checkStatus');


    Route::get('createbrokers','UserController@createBrokers');
    Route::post('upcreatebrokers','UserController@upCreateBrokers');
    Route::get('brokerrequest','UserController@brokerRequest');
    Route::get('editbroker/{id}','UserController@editBroker');
    Route::post('savededitbroker','UserController@saveeditBroker');
    Route::get('deletebroker/{id}','UserController@deleteBroker');
    

    Route::get('view-adds', 'CodeController@index');
    Route::get('add-confirm/{id}', 'CodeController@store');
    Route::post('upload-code', 'CodeController@store');
    Route::post('code-show', 'CodeController@show');
    Route::get('code-show', 'CodeController@show');
    Route::get('payoutrequest', 'PayoutController@index');
    Route::post('payoutconfirm', 'PayoutController@confirm');
    Route::get('payoutreject/{id}/{amount}','PayoutController@reject');
    Route::post('payoutdelete', 'PayoutController@payoutdelete');
    Route::get('rs-wallet', 'EwalletController@rs_wallet');
    Route::get('rs-data', 'EwalletController@rs_data');
    Route::get('wallet', 'EwalletController@index');
    Route::get('ewallet', 'EwalletController@data');
    Route::post('userwallet', 'EwalletController@userwallet');


    Route::get('fund-credits', 'EwalletController@fund');
    Route::post('credit-fund', 'EwalletController@creditfund');
    Route::post('fetch-data', 'EwalletController@search');
    Route::get('getAllUsers', 'UserController@allusers');
    //Message
    Route::get('emails-template/regsiter', 'EmailsController@index');
    Route::post('emails-template/regsiter', 'EmailsController@update');

    //Message
    Route::get('inbox', 'MailController@index');
    Route::post('mail/delete', 'MailController@destroy');
    Route::get('compose', 'MailController@compose');
    Route::get('compose/{from}', 'MailController@reply');
    Route::post('reply', 'MailController@save1');
    Route::get('outbox', 'MailController@outbox');
    Route::post('send', 'MailController@save');

    Route::get('user_validate/{sponsor}', 'UserController@validateuser');
    Route::get('joiningreport', 'ReportController@joiningreport');
    Route::post('joiningreport', 'ReportController@joiningreportview');
    Route::get('fundcredit', 'ReportController@fundcredit');
    Route::post('fundcredit', 'ReportController@fundcreditview');
    Route::post('joiningreportbysponsor', 'ReportController@joiningreportbysponsorview');
    Route::post('joiningreportbycountry', 'ReportController@joiningreportbycountryview');
    Route::get('incomereport', 'ReportController@ewalletreport');
    Route::post('incomereport', 'ReportController@ewalletreportview');
    Route::get('payoutreport', 'ReportController@payoutreport');
    Route::post('payoutreport', 'ReportController@payoutreportview');
    Route::get('salesreport', 'ReportController@salesreport');
    Route::post('salesreport', 'ReportController@salesreportview');
    Route::get('pairingreport', 'ReportController@pairingreport'); 
    Route::post('pairingreport', 'ReportController@pairingreportview');
    Route::post('carryreport', 'ReportController@carryreportview');
    Route::get('topearners', 'ReportController@topearners');
    Route::post('topearners', 'ReportController@topearnersview');
    Route::get('revenuereport', 'ReportController@revenuereport');
    Route::post('revenuereport', 'ReportController@revenuereportview');
    Route::get('salereport', 'ReportController@salereport');
    Route::post('salereport', 'ReportController@salereportview');
    Route::get('summaryreport', 'ReportController@summuryreport');
    Route::post('summaryreport', 'ReportController@summuryreportview');
    Route::get('maintenancereport', 'ReportController@maintenancereport');
    Route::post('maintenancereport', 'ReportController@maintenancereportview');
    
    Route::get('topenrollerreport', 'ReportController@topEnrollerReport');
    Route::post('topenrollerreport', 'ReportController@topEnrollerReportView');

    Route::get('mark-as-read/{msg_id}', 'MailController@mark_as_read');
    Route::get('plansettings', 'PackageController@index');
    Route::post('plansettings', 'PackageController@update');
    Route::get('bonus', 'PackageController@bonus');
    Route::get('leadership', 'PackageController@leadership');
    Route::post('updateleadership', 'PackageController@updateleadership');
    Route::post('direct-referbonus', 'PackageController@updatereferbonus');
    Route::post('groupsales', 'PackageController@updategroupsales');
    Route::post('reorder', 'PackageController@updatereorder');
    Route::post('reorder-pv', 'PackageController@reorderpv');

    Route::get('emailsettings', 'SettingsController@email');
    Route::post('emailsettings', 'SettingsController@updateemailsetting');
    Route::get('welcomeemail', 'SettingsController@welcome');
    Route::post('welcomeemail', 'SettingsController@updatewelcome');
    Route::get('uploads', 'SettingsController@getUploadLogo');
    Route::post('uploadlogo', ['as' => 'admin.upload', 'uses' => 'SettingsController@uploads']);
    Route::post('logo', 'SettingsController@savelogo');
    //autoresponse
    Route::get('autoresponse', 'SettingsController@autoresponder');
    Route::post('autoresponse', 'SettingsController@save');
    // Route::get('voucherlist', 'SettingsController@voucherlist');
    Route::get('response/edit/{id}', 'SettingsController@editresponse');
    Route::post('updateresponse', 'SettingsController@updateresponse');

    Route::get('response/delete/{id}', 'SettingsController@deleteresponse');
    Route::post('deleteconfirms', 'SettingsController@deleteconfirms');    
    
    /**
     * Helpdesk including ticket system
     */        

    Route::get('/helpdesk/tickets/kb-categories', 'Helpdesk\Kb\KbCategoryController@index');    
    Route::get('/helpdesk/tickets/kb-categories/{id}', 'Helpdesk\Kb\KbCategoryController@show');    
    Route::post('/helpdesk/tickets/kb-categories/store', 'Helpdesk\Kb\KbCategoryController@store');
    Route::post('/helpdesk/tickets/kb-categories/update', 'Helpdesk\Kb\KbCategoryController@update');
    Route::get('/helpdesk/tickets/kb-categories/destroy/{id}', 'Helpdesk\Kb\KbCategoryController@destroy');
    Route::get('/helpdesk/tickets/kb-categories/data', 'Helpdesk\Kb\KbCategoryController@data');

    /**
     * Knowledgebase - Categories
     */
    /*  For the crud of category  */
    Route::resource('helpdesk/kb/category', 'Helpdesk\kb\CategoryController');    
    /*  For the datatable of category  */
    Route::get('helpdesk/kb/categories/data', ['as' => 'api.category', 'uses' => 'Helpdesk\kb\CategoryController@data']);
    /*  destroy category  */
    Route::get('helpdesk/kb/category/delete/{id}', 'Helpdesk\kb\CategoryController@destroy');

    /**
     * Knowledgebase - Articles
     */   
 
    Route::resource('helpdesk/kb/article', 'Helpdesk\kb\ArticleController');    
    /*  For the datatable of article  */
    Route::get('helpdesk/kb/articles/data', ['as' => 'api.article', 'uses' => 'Helpdesk\kb\ArticleController@data']);
    Route::get('helpdesk/kb/article/delete/{slug}', 'Helpdesk\kb\ArticleController@destroy');
        /**
     * Dashboard
     */
    Route::get('/helpdesk/tickets-dashboard', 'Helpdesk\Ticket\TicketsController@index');

    

    /**
     * All Tickets
     * Using query param, 
     */
    Route::resource('helpdesk/ticket', 'Helpdesk\Ticket\TicketsController');    
    Route::get('helpdesk/tickets/data', 'Helpdesk\Ticket\TicketsController@data');    
    Route::get('helpdesk/ticket/delete/{slug}', 'Helpdesk\Ticket\TicketsController@destroy');
    // Route::get('/helpdesk/tickets/tickets', 'TicketsController@tickets');
    Route::post('helpdesk/ticket/reply/', 'Helpdesk\Ticket\TicketsController@ticketReplyPost');

    Route::get('helpdesk/tickets/overdue/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/open/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/closed/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/resolved/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/add/', 'Helpdesk\Ticket\TicketsController@index');

    Route::get('helpdesk/tickets/ticket/change-status/', 'Helpdesk\Ticket\TicketsController@changeStatus');    
    //Change priority
    Route::get('helpdesk/tickets/ticket/change-priority/', 'Helpdesk\Ticket\TicketsController@changePriority');    
    //Change owner
    Route::patch('helpdesk/tickets/ticket/change-priority/', 'Helpdesk\Ticket\TicketsController@changeOwner');    

    
    /*  For the crud of department  */
    Route::resource('helpdesk/tickets/department', 'Helpdesk\Ticket\TicketsDepartmentsController');    
    Route::get('helpdesk/tickets/departments/destroy/{id}', 'Helpdesk\Ticket\TicketsDepartmentsController@destroy');
    /*  For the datatable of article  */    
    Route::get('/helpdesk/tickets/departments/data','Helpdesk\Ticket\TicketsDepartmentsController@data');    
 
    
    /*  For the crud of department  */
    Route::resource('helpdesk/tickets/category', 'Helpdesk\Ticket\TicketsCategoriesController');    
    Route::get('helpdesk/tickets/categories/destroy/{id}', 'Helpdesk\Ticket\TicketsCategoriesController@destroy');
    /*  For the datatable of article  */    
    Route::get('/helpdesk/tickets/categories/data','Helpdesk\Ticket\TicketsCategoriesController@data');
   

    /*  For the crud of canned responses   */
    Route::resource('helpdesk/tickets/canned-response', 'Helpdesk\Ticket\TicketsCannedResponseController');    
    Route::get('helpdesk/tickets/canned-responses/delete/{id}','Helpdesk\Ticket\TicketsCannedResponseController@destroy');    
    /*  For the datatable of canned responses  */    
    Route::get('/helpdesk/tickets/canned-responses/data','Helpdesk\Ticket\TicketsCannedResponseController@data');

    Route::post('helpdesk/tickets/canned-responses/get-canned-response','Helpdesk\Ticket\TicketsCannedResponseController@getCannedResponse');  
    /**
     * Priority
     * 
     */    

    /*  For the crud of priority management   */
    Route::resource('/helpdesk/tickets/priority', 'Helpdesk\Ticket\TicketsPriorityController');   
    Route::get('helpdesk/tickets/priorities/delete/{id}','Helpdesk\Ticket\TicketsPriorityController@destroy');     
    Route::get('/helpdesk/tickets/priorities/data','Helpdesk\Ticket\TicketsPriorityController@data');
    /*  For the crud of ticket-type management   */
    Route::resource('/helpdesk/tickets/ticket-type', 'Helpdesk\Ticket\TicketsTypeController');   
    Route::get('helpdesk/tickets/ticket-types/delete/{id}','Helpdesk\Ticket\TicketsTypeController@destroy');     
    Route::get('/helpdesk/tickets/ticket-types/data','Helpdesk\Ticket\TicketsTypeController@data'); 
    /**
     * Configure ticket system : Alerts & Notification     * 
    
     */
    Route::post('post_ticket_category', 'TicketConfigurationsController@store_ticket_category');
    #products
    Route::get('products', 'ProductController@index');
    Route::post('products', 'ProductController@update');
    Route::post('product/add', 'ProductController@create');
    Route::get('product/delete/{id}', 'ProductController@destroy');
    #CurrencyController
    Route::get('currency', 'CurrencyController@index');
    Route::post('currency', 'CurrencyController@update');
    Route::post('currency/add', 'CurrencyController@create');
    Route::get('currency/delete/{id}', 'CurrencyController@destroy');
    #purchase history
    Route::get('purchase-history', 'ProductController@purchasehistory');
    Route::get('purchase-history/{id}/delete', 'ProductController@delete_order');
    Route::get('purchase-history/{id}/confirm', 'ProductController@confirm_order');
    Route::post('purchase-history', 'ProductController@purchasehistoryshow');
    #member management
    Route::get('member', 'MemberController@index');
    Route::post('member/search', 'MemberController@search');
    #Register new memeber
    Route::get('xpress', 'RegisterController@xpress');
    Route::get('cancelreg', 'RegisterController@cancelreg');
    Route::get('register/{placement_id}', 'RegisterController@index');
    Route::get('register', 'RegisterController@index');
    Route::post('register', 'RegisterController@register');
    Route::post('register/data/', 'RegisterController@data');
    Route::get('voucherverify', 'RegisterController@voucherverify');
    Route::get('register/preview/{idencrypt}', 'RegisterController@preview');
    Route::get('paypal/register', 'RegisterController@paypalReg');
    Route::get('ajax/get-bitaps-status/{id}', 'Auth\RegisterController@bitaps');

    //Admin register

    //admin-role
    Route::get('adminregister', 'RegisterController@adminregister');
    Route::post('admin_register', 'RegisterController@admin_register');
    Route::get('viewalladmin','SettingsController@viewalladmin');
    Route::get('adminview','SettingsController@adminview');
    Route::get('deleteadmin/{id}','SettingsController@deleteadmin');
    Route::get('work_assign','SettingsController@work_assign'); 
    Route::get('assign-role/{id}','SettingsController@postassign');
    Route::post('save-roles','SettingsController@saverole');    


    Route::get('lead', 'LeadviewController@leadview');
    Route::post('lead', 'LeadviewController@updatelead');
    Route::get('deletelead/{id}/delete', 'LeadviewController@deletelead');
    Route::get('getstatus', 'LeadviewController@getstatus');
    Route::get('documentupload', 'DocumentController@upload');
    Route::post('uploadfile', 'DocumentController@uploadfile');
    Route::post('deletedocument', 'DocumentController@deletedocument');
    Route::post('updatedocument', 'DocumentController@updatedocument');
    Route::get('download/{name}', 'DocumentController@getDownload');

    /**
     * Notes
     */
    Route::get('notes', 'NotesController@index');
    Route::post('post-note', 'NotesController@postNote');
    Route::post('remove-note', 'NotesController@removeNote');
    /**
     * Campaigns
     */
    Route::get('campaign/lists', 'Marketing\Campaign\CampaignController@index');
    Route::get('campaign/create', 'Marketing\Campaign\CampaignController@create');
    Route::get('campaign/edit/{id}', 'Marketing\Campaign\CampaignController@edit');
    Route::post('campaign/save', 'Marketing\Campaign\CampaignController@store');
    Route::get('campaign/lists/change-status', 'Marketing\Campaign\CampaignController@changestatus'); 

    /**
     * Campaigns contacts
     */
    Route::get('campaign/contacts/contactsgroup','Marketing\Contacts\ContactsController@datagruop');  
    Route::get('campaign/contacts/contactslist/{id}','Marketing\Contacts\ContactsController@data');  
    Route::get('campaign/contacts/{id}/editgruop','Marketing\Contacts\ContactsController@editgruop');  
    Route::post('campaign/contacts/{id}/editgruop','Marketing\Contacts\ContactsController@savegruop');  
    Route::get('campaign/contacts/destroygruop/{id}','Marketing\Contacts\ContactsController@destroygruop');  
    Route::resource('campaign/contacts', 'Marketing\Contacts\ContactsController');
    Route::post('campaign/contacts/create-gruop', 'Marketing\Contacts\ContactsController@creategruop');  

    /**
     * Campaigns autoresponders
     */
    Route::get('campaign/autoresponders', 'Marketing\Campaign\CampaignController@autorespondersIndex');
    Route::get('campaign/autoresponders/create', 'Marketing\Campaign\CampaignController@createAutoResponder'); 
    /**
     * Activity listing
     */
    Route::get('all_activities', 'ActivityController@index');     

    Route::model('User', 'App\User', function () {
        throw new NotFoundHttpException;
    });
    Route::get('api/dropdown', function () {
        $id     = Input::get('username');
        $models = User::find($id)->username;
        return $models->lists('name', 'id');
    });



}); 

Route::group(['prefix' => 'cron'], function()
{

   
   Route::get('testmail','CronController@testmail');
   Route::get('testcurl','CronController@testcurl');
 
   
});























/**
 * Testing funtions to be removed from app when distributing
 */
    
Route::group(['prefix' => 'factory', 'middleware' => ['web', 'auth'], 'namespace' => 'Factory'], function(){
    Route::get('dummynetwork/{userslimit}', 'DemoUtils\DemoUtilsController@dummynetwork');
    Route::get('dummytickets/{ticketslimit}', 'DemoUtils\DemoUtilsController@dummytickets');
    Route::get('dummymails', 'DemoUtils\DemoUtilsController@dummymails');
    Route::get('dummyvouchers', 'DemoUtils\DemoUtilsController@dummyvouchers');
});


































Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'user'], function () {
    Route::get('dashboard', 'dashboard@index');
    Route::get('getMonthUsers', 'dashboard@getmonthusers');
    Route::get('suggestlist', 'UserController@suggestlist');
    Route::get('profile', 'ProfileController@index');
    Route::get('purchasedashboard','dashboard@purchasedashboard');
     Route::post('profile/edit/{id}', ['as' => 'user.saveprofile', 'uses' => 'ProfileController@update']);

    
    Route::post('currency', 'ProfileController@currency');
    Route::post('leg-setting', 'ProfileController@legsetting');
    Route::post('rs-setting', 'ProfileController@rssetting');
    Route::get('states/{id}', 'ProfileController@getstates');
    // Route::get('getEdit', 'ProfileController@getEdit');
    Route::post('getEdit', 'ProfileController@postEdit');
    Route::get('changepassword', 'ChangePasswordController@index');
    Route::post('updatepassword', 'ChangePasswordController@updatepassword');
    Route::post('updatetransactionpassword', 'UserController@updatetransactionpassword');
    Route::get('ewallet', 'Ewallet@index');
    Route::post('ewallet', 'Ewallet@index');
    Route::get('wallet/data', 'Ewallet@data');
    Route::get('viewreferals', 'ViewReferals@index');
    //mail system


    Route::get('paypal/success/{id}','RegisterController@paypalRegSuccess');
    Route::post('paypal/success/{id}','RegisterController@paypalRegSuccess');
    Route::get('upgrade/success/{id}','productController@productSuccess');
    Route::post('upgrade/success/{id}','productController@productSuccess');
    Route::get('getplanid','productController@getplanid');
    
    Route::post('paypalupgrade/paypalsuccess/{id}','productController@paypalSuccess');
     Route::get('paypalupgrade/paypalsuccess/{id}','productController@paypalSuccess');

    Route::get('banktransferPreview','productController@banktransferPreview');
    Route::get('regbanktransferpre','RegisterController@regTransferPreview');
    Route::get('get-bankpayment-status/{id}', 'RegisterController@checkStatus');
    Route::get('get-purchasepayment-status/{id}', 'productController@purchaseStatus');

    Route::get('runsoftware','UserController@runSoftware');
    Route::post('savebrokerdetails','UserController@saveBrokerDetails');
    Route::get('changestatus','UserController@changestatus');
    Route::post('savedoc','ProfileController@saveDoc');

    Route::get('inbox','MailController@index');
    Route::post('mail/delete','MailController@destroy');
    Route::get('compose','MailController@compose');
    Route::get('compose/{from}','MailController@reply');
    Route::post('reply','MailController@save1');
    Route::post('send','MailController@save');
    Route::get('user_validate/{sponsor}', 'UserController@validateuser');
    Route::get('mark-as-read/{msg_id}', 'MailController@mark_as_read');

     Route::get('genealogy', 'TreeController@index');
    Route::post('getTree/{levellimit}', 'TreeController@indexPost');
    Route::post('tree-up', 'TreeController@treeUp');
    Route::get('tree-up', 'TreeController@treeUp');
    //tree
    Route::get('tree', 'TreeController@tree');
    Route::get('treedata', 'TreeController@treedata');
    Route::get('childdata', 'TreeController@childdata');
    // sponsor tree
    Route::get('sponsortree', 'TreeController@sponsortree');
    Route::post('getsponsortree', 'TreeController@postSponsortree');
    Route::post('getsponsortreeurl', 'TreeController@getsponsortreeurl');
    Route::post('sponsor-up', 'TreeController@sponsortreeUp');
    Route::get('sponsor-up', 'TreeController@sponsortreeUp');
    Route::post('sponsor-up/{base64}', 'TreeController@sponsortreeUp');
    Route::post('sponsor-child/{base64}', 'TreeController@sponsortreechild');

    Route::post('getsponsorchildrenByUserName/{base64}', 'TreeController@getsponsorchildrenByUserName');
    Route::get('getsponsorchildrenByUserName/{base64}', 'TreeController@getsponsorchildrenByUserName');

    Route::post('sponsor-up', 'TreeController@sponsortreeUp');
    Route::get('sponsor-up', 'TreeController@sponsortreeUp');

     /**
     * getChildrenGenealogy {$id} for nested childrens in chart
     */

    //tree
    Route::post('getChildrenGenealogyByUserName/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogyByUserName');
    Route::get('getChildrenGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogy');
    Route::post('getChildrenGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getChildrenGenealogy');
    Route::post('getParentGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getParentGenealogy');
    Route::post('getParentGenealogy/{base64}/{levellimit}', 'GenealogyTreeController@getParentGenealogy');
    Route::post('search/binary/autocomplete', 'GenealogyTreeController@autocompletebinary');
    Route::post('search/autocomplete', 'GenealogyTreeController@autocomplete');

    //update account details

    Route::post('updatename', 'UserController@updatename');
    Route::post('updateadminpass','UserController@updatepass');


    Route::get('news_read','UserController@readNews');
    Route::get('read_more/{id}','UserController@readMore');

    
    Route::get('payoutrequest', 'PayoutController@index');
    Route::post('request', 'PayoutController@request');
    Route::get('allpayoutrequest', 'PayoutController@viewall');
    Route::get('reg', 'PayoutController@reg');
    Route::get('requestvoucher', 'VoucherController@index');
    Route::post('vouch-request', 'VoucherController@vouchrequest');
    Route::get('viewvoucher', 'VoucherController@viewvoucher');
    Route::get('myvoucher', 'VoucherController@myvouch');

    Route::get('getPayout', 'PayoutController@getpayout');
    Route::get('income','IncomeDetailsController@index');
    Route::post('income','IncomeDetailsController@index');
    Route::get('fund-transfer','Ewallet@fund');
    Route::post('fund-transfer','Ewallet@fundtransfer');
    Route::get('my-transfer','Ewallet@mytransfer');
    #view-mycode
    Route::get('view-adds','CodeController@index');
    Route::post('view-adds','CodeController@show');
    Route::get('purchase-history','productController@purchasehistory');
    #products
    Route::get('purchase-plan','productController@index');
    Route::post('purchase-plan','productController@purchase');
    Route::get('purchase/preview/{idencrypt}', 'productController@preview');
      Route::get('purchase/invoice/{id}', 'productController@invoice');
    Route::get('purchase-history','productController@purchasehistory');
     Route::get('paypal/purchase-plan','productController@paypalpurchase');
    #Register new memeber
    Route::get('register/{placement_id}','RegisterController@index');
    Route::get('register','RegisterController@index');
    Route::post('register','RegisterController@register');
    Route::get('register/preview/{idencrypt}','RegisterController@preview');
    Route::post('register/data/','RegisterController@data');
    Route::get('xpress','RegisterController@xpress');
    Route::get('paypal/register', 'RegisterController@paypalReg');
    #Reports
    Route::get('pvreport','ReportController@pvreport');
    Route::post('pvreport','ReportController@pvreportview');
    Route::get('salereport','ReportController@salereport');
    Route::post('salereport','ReportController@salereportview');
    Route::get('incomereport','ReportController@ewalletreport');
    Route::post('incomereport','ReportController@ewalletreportview');
    Route::get('pairingreport','ReportController@pairingreport');
    Route::post('pairingreport','ReportController@pairingreportview');
    Route::post('carryreport','ReportController@carryreportview');
    Route::get('payoutreport','ReportController@payoutreport');
    Route::post('payoutreport','ReportController@payoutreportview');
    Route::get('transactionreport','ReportController@salereport');
    Route::post('transactionreport','ReportController@salereportview');
    Route::get('summaryreport','ReportController@summuryreport');
    Route::post('summaryreport','ReportController@summuryreportview');
    Route::get('maintenancereport','ReportController@maintenancereport');
    Route::post('maintenancereport','ReportController@maintenancereportview');
    Route::get('groupsalesbonus','ReportController@groupsalesbonus');
    Route::post('groupsalesbonus','ReportController@groupsalesbonusview');
    Route::post('groupsalesbonusdetails/{id}','ReportController@groupsalesbonusdetails');
    Route::get('lead', 'LeadviewController@leadview');
    Route::post('lead','LeadviewController@updatelead');
    Route::post('deletelead', 'LeadviewController@deletelead');
    Route::get('getstatus','LeadviewController@getstatus');
    Route::get('documentdownload', 'DocumentController@download');
    Route::get('download/{name}', 'DocumentController@getDownload');
    #ticket center

      Route::get('allvideos','DocumentController@allvideos');
 

      
    Route::get('/helpdesk/tickets/kb-categories', 'Helpdesk\Kb\KbCategoryController@index');    
    Route::get('/helpdesk/tickets/kb-categories/{id}', 'Helpdesk\Kb\KbCategoryController@show');    
    Route::post('/helpdesk/tickets/kb-categories/store', 'Helpdesk\Kb\KbCategoryController@store');
    Route::post('/helpdesk/tickets/kb-categories/update', 'Helpdesk\Kb\KbCategoryController@update');
    Route::get('/helpdesk/tickets/kb-categories/destroy/{id}', 'Helpdesk\Kb\KbCategoryController@destroy');
    Route::get('/helpdesk/tickets/kb-categories/data', 'Helpdesk\Kb\KbCategoryController@data');

    /**
     * Knowledgebase - Categories
     */
    /*  For the crud of category  */
    Route::resource('helpdesk/kb/category', 'Helpdesk\kb\CategoryController');    
    /*  For the datatable of category  */
    Route::get('helpdesk/kb/categories/data', ['as' => 'api.category', 'uses' => 'Helpdesk\kb\CategoryController@data']);
    /*  destroy category  */
    Route::get('helpdesk/kb/category/delete/{id}', 'Helpdesk\kb\CategoryController@destroy');
    /**
     * Knowledgebase - Articles
     */    
    /*  For the crud of article  */
    Route::resource('helpdesk/kb/article', 'Helpdesk\kb\Knowledgebase');    
    /*  For the datatable of article  */
    Route::get('helpdesk/kb/articles/data', ['as' => 'api.article', 'uses' => 'Helpdesk\kb\Knowledgebase@data']);
    Route::get('helpdesk/kb/article/delete/{slug}', 'Helpdesk\kb\Knowledgebase@destroy');
    /**
     * Dashboard
     */
    Route::get('/helpdesk/tickets-dashboard', 'Helpdesk\Ticket\TicketsController@index');
    /**
     * All Tickets
     * Using query param, 
     */
    Route::resource('helpdesk/ticket', 'Helpdesk\Ticket\TicketsController');    
    Route::get('helpdesk/tickets/data', 'Helpdesk\Ticket\TicketsController@data');    
    Route::get('helpdesk/ticket/delete/{slug}', 'Helpdesk\Ticket\TicketsController@destroy');
    // Route::get('/helpdesk/tickets/tickets', 'TicketsController@tickets');
    Route::post('helpdesk/ticket/reply/', 'Helpdesk\Ticket\TicketsController@ticketReplyPost');

    Route::get('helpdesk/tickets/overdue/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/open/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/closed/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/resolved/', 'Helpdesk\Ticket\TicketsController@index');
    Route::get('helpdesk/tickets/add/', 'Helpdesk\Ticket\TicketsController@index');    
    /**
     * Ticket functions
     */
    //Change status
    Route::get('helpdesk/tickets/ticket/change-status/', 'Helpdesk\Ticket\TicketsController@changeStatus');    
    //Change priority
    Route::get('helpdesk/tickets/ticket/change-priority/', 'Helpdesk\Ticket\TicketsController@changePriority');    
    //Change owner
    Route::patch('helpdesk/tickets/ticket/change-priority/', 'Helpdesk\Ticket\TicketsController@changeOwner');     
    /**
     * Departments     * 
     */  
    
    /*  For the crud of department  */
    Route::resource('helpdesk/tickets/department', 'Helpdesk\Ticket\TicketsDepartmentsController');    
    Route::get('helpdesk/tickets/departments/destroy/{id}', 'Helpdesk\Ticket\TicketsDepartmentsController@destroy');
    /*  For the datatable of article  */    
    Route::get('/helpdesk/tickets/departments/data','Helpdesk\Ticket\TicketsDepartmentsController@data');    
    /**
     * Categories    * 
     */      
    /*  For the crud of department  */
    Route::resource('helpdesk/tickets/category', 'Helpdesk\Ticket\TicketsCategoriesController');    
    Route::get('helpdesk/tickets/categories/destroy/{id}', 'Helpdesk\Ticket\TicketsCategoriesController@destroy');
    /*  For the datatable of article  */    
    Route::get('/helpdesk/tickets/categories/data','Helpdesk\Ticket\TicketsCategoriesController@data');   
    /**
     * Canned Responses
     * 
     */  
    /*  For the crud of canned responses   */
    Route::resource('helpdesk/tickets/canned-response', 'Helpdesk\Ticket\TicketsCannedResponseController');    
    Route::get('helpdesk/tickets/canned-responses/delete/{id}','Helpdesk\Ticket\TicketsCannedResponseController@destroy');    
    /*  For the datatable of canned responses  */    
    Route::get('/helpdesk/tickets/canned-responses/data','Helpdesk\Ticket\TicketsCannedResponseController@data');
    Route::post('helpdesk/tickets/canned-responses/get-canned-response','Helpdesk\Ticket\TicketsCannedResponseController@getCannedResponse');    

    /*  For the crud of priority management   */
    Route::resource('/helpdesk/tickets/priority', 'Helpdesk\Ticket\TicketsPriorityController');   
    Route::get('helpdesk/tickets/priorities/delete/{id}','Helpdesk\Ticket\TicketsPriorityController@destroy');     
    Route::get('/helpdesk/tickets/priorities/data','Helpdesk\Ticket\TicketsPriorityController@data');
   

    /*  For the crud of ticket-type management   */
    Route::resource('/helpdesk/tickets/ticket-type', 'Helpdesk\Ticket\TicketsTypeController');   
    Route::get('helpdesk/tickets/ticket-types/delete/{id}','Helpdesk\Ticket\TicketsTypeController@destroy');     
    Route::get('/helpdesk/tickets/ticket-types/data','Helpdesk\Ticket\TicketsTypeController@data');

    Route::resource('notes', 'NotesController');  

    //users joining graph

   Route::get('usersjoining.json', 'dashboard@getUsersJoiningJson');

    /**
     * Activity listing
     */
    Route::get('all_activities', 'ActivityController@index');   



         //Online Store
    Route::get('onlinestore','OnlineStoreController@onlinestore');
    Route::post('addtocart','OnlineStoreController@addtocart');
    Route::post('deletecart','OnlineStoreController@deletecart');
    Route::get('checkoutproduct','OnlineStoreController@viewcheckoutproduct');
    Route::post('updatecart', 'OnlineStoreController@updatecart'); 
    Route::get('shippingaddress','OnlineStoreController@shipping');
    Route::post('voucherverify/data/','OnlineStoreController@data');
    Route::post('shippingcreation','OnlineStoreController@shippingcreation');
    Route::get('shippingcreation','OnlineStoreController@shippingcreation'); 
    Route::get('checkoutproduct1/{product_id}','OnlineStoreController@removeproduct');
    Route::get('checkout','OnlineStoreController@checkout');
    Route::get('orderconfirm/{idencrypt}/{payment}','OnlineStoreController@orderconfirm'); 
    Route::get('payment','PaymentController@payment'); 
    Route::post('addOrder','PaymentController@addOrder');
    Route::get('sales','OnlineStoreController@sales');
    Route::get('viewmore/{id}','OnlineStoreController@viewmore'); 

     
    }); 