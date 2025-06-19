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

Route::get('/', 'HomeController@home');
Route::post('public-message', 'ContactController@messageStore')->name('public-message.store');

Auth::routes();
Route::get('hub-register', 'HubController@registerHub')->name('hub.register');
Route::get('hub-identy-img/{id}', 'HubController@downloadIdentyImg')->name('hub-identy-img');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pricing', 'HomeController@pricing')->name('pricing');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::middleware('auth')->group(function () {

    Route::resource('user', 'UserController');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('manage/{id}', 'DashboardController@userManage')->name('user.manage');

    Route::get('/home-components', 'HomeController@homeComponents')->name('home-components');

    Route::get('/optimize-cache', 'HomeController@optimizeCache')->name('home-optimizeCache');
    
    Route::resource('role', 'RoleController');

    Route::resource('merchants', 'MerchantController');
    Route::get('merchant-requests', 'MerchantController@merchantRequest')->name('merchant-requests');
    Route::get('merchant-inactive', 'MerchantController@merchantInactive')->name('merchants.inactive');
    Route::get('get-merchants-admin', 'MerchantController@getIndexAdmin')->name('get-merchants-admin');
    Route::get('merchant-active/{id}', 'MerchantController@merchantActive')->name('merchant.active');

    Route::resource('special-merchants', 'SpecialMerchantController');

    Route::resource('agents', 'HubController');
    Route::get('agent-requests', 'HubController@agentRequest')->name('agent-requests');
    Route::get('agent-inactive', 'HubController@agentInactive')->name('agents.inactive');
    Route::get('get-agents-admin', 'HubController@getIndexAdmin')->name('get-agents-admin');
    Route::get('agent-active/{id}', 'HubController@agentActive')->name('agent.active');
    Route::get('manage-agent/{id}', 'HubController@userManage')->name('manage.agent');
    Route::post('agent-tag', 'HubController@assign')->name('agent.tag');
    Route::post('manage-agents-admin', 'HubController@manageDelivery')->name('manage-agents-admin');
    Route::get('all-deliveries-agent', 'HubController@indexAll')->name('all.deliveries.agent');
    Route::get('get-all-deliveries-agent', 'HubController@getAll')->name('get-all-deliveries-agent');

    Route::resource('special-agents', 'SpecialAgentController');

    Route::resource('customers', 'CustomerController');
    Route::get('customers-requests', 'CustomerController@merchantRequest')->name('customers-requests');
    Route::get('customers-active/{id}', 'CustomerController@merchantActive')->name('customers.active');

    Route::resource('admin-services', 'ServiceController');

    Route::resource('admin-client', 'ClientController');

    Route::resource('admin-inter-city-rates', 'InterCityRateController');
    Route::resource('admin-rate-info', 'AddRateInfoController');

    Route::resource('admin-about', 'AboutUsController');
    Route::resource('admin-about-card', 'AboutUsCardController');

    Route::resource('districts', 'DistrictController');

    Route::resource('areas', 'AreaController');



    Route::resource('deliveries', 'DeliveryController');
    Route::get('print/delivery-info/{id}', 'DeliveryController@printInfoDelivery')->name('deliveries.info.print');
    Route::get('print/pickup-info/{id}', 'DeliveryController@printInfoPickup')->name('deliveries.pickup.print');
    Route::get('deliveries-admin', 'DeliveryController@indexAdmin')->name('deliveries-admin');
    Route::get('all-deliveries-admin', 'DeliveryController@indexAll')->name('all.deliveries');
    Route::get('get-deliveries-admin', 'DeliveryController@getIndexAdmin')->name('get-deliveries-admin');
    Route::get('get-deliveries-agent', 'DeliveryController@getIndexAgent')->name('get-deliveries-agent');
    Route::get('get-all-deliveries-admin', 'DeliveryController@getAll')->name('get-all-deliveries-admin');
    Route::post('manage-deliveries-admin', 'DeliveryController@manageDelivery')->name('manage-deliveries-admin');
    Route::post('get-delivery-info', 'DeliveryController@getDeliveryInfo')->name('get-delivery-info');
    Route::post('admin-delivered', 'DeliveryController@delivered')->name('admin.delivered');
    Route::post('admin-pickup', 'DeliveryController@pickup')->name('admin.pickup');
    Route::post('admin-cancel', 'DeliveryController@cancel')->name('admin.cancel');
    Route::post('admin-hold', 'DeliveryController@hold')->name('admin.hold');
    Route::post('admin-no-status', 'DeliveryController@noStatus')->name('admin.no.status');
    Route::post('admin-paid', 'DeliveryController@paid')->name('admin.paid');
    Route::post('admin-unpaid', 'DeliveryController@unPaid')->name('admin.unpaid');
    Route::post('deliveries-delete', 'DeliveryController@delete')->name('deliveries.delete');

    Route::get('admin-delivery-statuses', 'DeliveryController@statuses')->name('admin.statuses');

    Route::get('invoices', 'InvoiceController@index')->name('invoices.index');
    Route::get('get-invoices', 'InvoiceController@getInvoice')->name('get.invoices');
    Route::get('invoice/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');
    Route::get('invoice/{id}', 'InvoiceController@show')->name('invoice.show');
    Route::post('delivery/invoice', 'InvoiceController@getInvoiceInfo')->name('delivery.invoice');
    Route::post('delivery/invoice/agent', 'InvoiceController@getInvoiceInfoAgent')->name('delivery.invoice.agent');
    Route::get('invoice/pdf-export/{id}', 'InvoiceController@export')->name('export.pdf');

    Route::resource('payment-requests', 'PaymentRequestsController');
    Route::get('get-payment-requests', 'PaymentRequestsController@getRequest');
    Route::post('admin.request.solve', 'PaymentRequestsController@solveRequest')->name('admin.request.solve');
    Route::post('admin.request.pending', 'PaymentRequestsController@pendingRequest')->name('admin.request.pending');

    Route::resource('authority-teams', 'AuthorityTeamController');

    Route::get('admin-contact', 'ContactController@index')->name('admin-contact');
    Route::post('admin-email-store', 'ContactController@emailStore')->name('admin-email.store');
    Route::post('admin-phone-store', 'ContactController@phoneStore')->name('admin-phone.store');
    Route::post('admin-address-store', 'ContactController@addressStore')->name('admin-address.store');
    Route::delete('admin-email-delete/{id}', 'ContactController@emailDestroy')->name('admin-email.destroy');
    Route::delete('admin-phone-delete/{id}', 'ContactController@phoneDestroy')->name('admin-phone.destroy');
    Route::delete('admin-address-delete/{id}', 'ContactController@addressDestroy')->name('admin-address.destroy');
    Route::get('admin-email-edit/{id}', 'ContactController@emailEdit')->name('admin-email.edit');
    Route::get('admin-phone-edit/{id}', 'ContactController@phoneEdit')->name('admin-phone.edit');
    Route::get('admin-address-edit/{id}', 'ContactController@addressEdit')->name('admin-address.edit');
    Route::put('admin-email-update/{id}', 'ContactController@emailUpdate')->name('admin-email.update');
    Route::put('admin-phone-update/{id}', 'ContactController@phoneUpdate')->name('admin-phone.update');
    Route::put('admin-address-update/{id}', 'ContactController@addressUpdate')->name('admin-address.update');

    Route::get('messages', 'PublicMessageController@index')->name('messages');

});
