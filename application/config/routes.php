<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|

|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'landing';
$route['privacy-policy'] = 'landing/privacy_policy';
$route['terms-and-conditions'] = 'landing/terms_and_conditions';
$route['refund-policy'] = 'landing/refund_policy';

$route['admin/sign_up'] = 'admin/login/sign_up';
$route['admin/login'] = 'admin/login';
$route['admin'] = 'admin/login';
$route['super-admin/dashboard'] = 'superadmin/dashboard/index';
$route['super-admin/admin-list'] = 'superadmin/dashboard/admin_list';
$route['super-admin/admin-details/(:num)'] = 'superadmin/dashboard/admin_details/$1';
$route['super-admin/plan'] = 'superadmin/dashboard/plan';
$route['super-admin/plan/update'] = 'superadmin/dashboard/update_plan_catalog';
$route['super-admin/admin-status/(:num)'] = 'superadmin/dashboard/toggle_admin_status/$1';
$route['change_password'] = 'admin/login/change_password';
$route['change_password/update'] = 'admin/login/change_password_update';
$route['reset_password_page'] = 'admin/login/reset_password_page';
$route['reset_password']      = 'admin/login/reset_password';  // API POST
$route['update_password'] = 'admin/login/update_password';
$route['dashboard'] = 'dashboard/index';
$route['admin/stock'] = 'admin/stock';
$route['admin/stock/add'] = 'admin/stock/add';
$route['admin/stock/listing'] = 'admin/stock/listing';
$route['admin/stock/save'] = 'admin/stock/save';
$route['admin/plan'] = 'admin/plan/index';
$route['admin/plan/activate/(:any)'] = 'admin/plan/activate/$1';
$route['admin/plan/create-order'] = 'admin/plan/create_order';
$route['admin/plan/create-qr'] = 'admin/plan/create_qr';
$route['admin/plan/check-qr-status'] = 'admin/plan/check_qr_status';
$route['admin/plan/verify-payment'] = 'admin/plan/verify_payment';
$route['admin/plan/payment-failed'] = 'admin/plan/payment_failed';

$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';

$route['admin/catalog/edit/(:num)'] = 'admin/catalog/edit/$1';
$route['admin/catalog/update/(:num)'] = 'admin/catalog/update/$1';
$route['admin/catalog/delete/(:num)'] = 'admin/catalog/delete/$1';


$route['admin/orders/check_customer_mobile'] = 'admin/orders/check_customer_mobile';
$route['admin/amc'] = 'admin/amc/index';
$route['admin/amc/add'] = 'admin/amc/add';
$route['admin/amc/view/(:num)'] = 'admin/amc/view/$1';
$route['admin/amc/edit/(:num)'] = 'admin/amc/edit/$1';
$route['admin/amc/save'] = 'admin/amc/save';
$route['admin/amc/update/(:num)'] = 'admin/amc/update/$1';
$route['admin/amc/delete/(:num)'] = 'admin/amc/delete/$1';
$route['admin/amc/customer_products/(:num)'] = 'admin/amc/customer_products/$1';
$route['admin/complaint'] = 'admin/complaint/index';
$route['admin/complaint/view/(:num)'] = 'admin/complaint/view/$1';
$route['admin/complaint/update_status/(:num)'] = 'admin/complaint/update_status/$1';
$route['admin/complaint/mark_done/(:num)'] = 'admin/complaint/mark_done/$1';
$route['admin/complaint/update_status/(:num)/(:num)'] = 'admin/complaint/update_status/$1/$2';
$route['admin/complaint/delete/(:num)'] = 'admin/complaint/delete/$1';
$route['admin/catalog/add'] = 'admin/catalog/add';
$route['admin/catalog'] = 'admin/catalog/index';
$route['catalog/generate_qr'] = 'admin/catalog/generate_qr';
$route['catalog/view/(:num)/(:num)'] = 'admin/catalog/view/$1/$2';
$route['catalog/view/(:num)'] = 'admin/catalog/view/$1';
$route['publiccatalog/view/(:num)/(:num)'] = 'publiccatalog/view/$1/$2';
$route['publiccatalog/view/(:num)'] = 'publiccatalog/view/$1';
$route['publiccatalog/product_detail/(:num)'] = 'publiccatalog/product_detail/$1';
$route['profile'] = 'profile/index';
$route['publiccomplaint/form/(:num)'] = 'publiccomplaint/form/$1';
$route['publiccomplaint/save/(:num)'] = 'publiccomplaint/save/$1';
$route['complaint/(:num)'] = 'publiccomplaint/form/$1';
$route['complaint/save/(:num)'] = 'publiccomplaint/save/$1';
$route['order/view/(:num)'] = 'publiccomplaint/order/$1';


$route['admin/emi'] = 'admin/emi/index';
$route['admin/emi/view/(:num)'] = 'admin/emi/view/$1';
$route['admin/emi/mark_paid/(:num)'] = 'admin/emi/mark_paid/$1';

$route['admin/service'] = 'admin/service/index';
$route['admin/service/view/(:num)'] = 'admin/service/view/$1';
$route['admin/service/mark_done/(:num)'] = 'admin/service/mark_done/$1';
$route['delete_account'] = 'landing/delete_account';






















// API ROUTE 
$route['api'] = 'api/api/index';
$route['api/register'] = 'api/auth/register';
$route['api/login'] = 'api/auth/login';
$route['api/forgot-password'] = 'api/auth/forgot_password';
$route['api/me'] = 'api/auth/me';
$route['api/logout'] = 'api/auth/logout';
$route['api/change-password'] = 'api/auth/change_password';
$route['api/category/list'] = 'api/auth/category_list';
$route['api/category/add'] = 'api/auth/add_category';
$route['api/category/edit'] = 'api/auth/edit_category';
$route['api/category/delete'] = 'api/auth/delete_category';
$route['api/category/delete/(:num)'] = 'api/auth/delete_category/$1';
$route['api/product/list'] = 'api/auth/product_list';
$route['api/product/details/(:num)'] = 'api/auth/product_details/$1';
$route['api/product/add'] = 'api/auth/add_product';
$route['api/product/edit'] = 'api/auth/edit_product';
$route['api/product/delete'] = 'api/auth/delete_product';
$route['api/product/delete/(:num)'] = 'api/auth/delete_product/$1';
$route['api/catalog/list'] = 'api/auth/catalog_list';
$route['api/catalog/add'] = 'api/auth/add_catalog';
$route['api/catalog/edit'] = 'api/auth/edit_catalog';
$route['api/catalog/edit/(:num)'] = 'api/auth/edit_catalog/$1';
$route['api/catalog/delete'] = 'api/auth/delete_catalog';
$route['api/catalog/delete/(:num)'] = 'api/auth/delete_catalog/$1';
$route['api/profile/details'] = 'api/auth/profile_details';
$route['api/profile/edit'] = 'api/auth/edit_profile';
$route['api/complaint/list'] = 'api/auth/complaint_list';
$route['api/complaint-details/(:num)'] = 'api/auth/complaint_details/$1';
$route['api/complaint/add'] = 'api/auth/add_complaint';
$route['api/complaint/status'] = 'api/auth/update_complaint_status';
$route['api/complaint/status/(:num)'] = 'api/auth/update_complaint_status/$1';
$route['api/complaint/delete'] = 'api/auth/delete_complaint';
$route['api/complaint/delete/(:num)'] = 'api/auth/delete_complaint/$1';
$route['api/amc/list'] = 'api/auth/amc_list';
$route['api/amc/details/(:num)'] = 'api/auth/amc_details/$1';
$route['api/amc/add'] = 'api/auth/add_amc';
$route['api/amc/update'] = 'api/auth/update_amc';
$route['api/amc/delete/(:num)'] = 'api/auth/delete_amc/$1';
$route['api/amc/edit'] = 'api/auth/edit_amc';
$route['api/amc/delete'] = 'api/auth/delete_amc';
$route['api/amc/delete/(:num)'] = 'api/auth/delete_amc/$1';
$route['api/customer/list'] = 'api/auth/customer_list';
$route['api/customer/details/(:num)'] = 'api/auth/customer_details/$1';
$route['api/customer/edit'] = 'api/auth/edit_customer';
$route['api/customer/edit/(:num)'] = 'api/auth/edit_customer/$1';
$route['api/customer/delete'] = 'api/auth/delete_customer';
$route['api/customer/delete/(:num)'] = 'api/auth/delete_customer/$1';
$route['api/service/list'] = 'api/auth/service_list';
$route['api/service/details/(:num)'] = 'api/auth/service_details/$1';
$route['api/service/update'] = 'api/auth/update_service';
$route['api/service/update/(:num)'] = 'api/auth/update_service/$1';
$route['api/emi/list'] = 'api/auth/emi_list';
$route['api/emi/details/(:num)'] = 'api/auth/emi_details/$1';
$route['api/emi/update'] = 'api/auth/update_emi';
$route['api/emi/update/(:num)'] = 'api/auth/update_emi/$1';
$route['api/dashboard'] = 'api/dashboard/index';
$route['api/plan/save'] = 'api/auth/save_plan';
$route['api/profile'] = 'api/api/profile';
$route['api/add_order'] = 'api/auth/add_order';
$route['api/get_plan'] = 'api/auth/get_plans';
$route['api/buy_plan'] = 'api/auth/buy_plan';
$route['api/callback_plan'] = 'api/auth/verify_payment';

$route['api/save_device_token'] = 'api/auth/save_device_token';
$route['api/get_notification'] = 'api/auth/get_notification';
$route['api/read_notification/(:num)']   = 'api/auth/read_notification/$1';
$route['api/delete_notification/(:num)'] = 'api/auth/delete_notification/$1';
$route['api/get_customer'] = 'api/auth/get_customer';
$route['api/terms_condition'] = 'api/auth/terms_condition';
$route['api/privacy_policy'] = 'api/auth/privacy_policy';
$route['api/refund_policy'] = 'api/auth/refund_policy';
$route['api/delete_account'] = 'api/auth/delete_account';
$route['api/get_profile'] = 'api/auth/get_profile';
$route['api/update_profile'] = 'api/auth/update_profile';
$route['api/forgot_password'] = 'api/auth/forgot_password';
$route['api/test_notification'] = 'api/auth/test_notification';












$route['api/order_details/(:num)'] = 'api/auth/order_details/$1';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
