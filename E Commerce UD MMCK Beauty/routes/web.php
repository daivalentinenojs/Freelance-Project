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

/*Login Web*/
Route::get('/Login', 'Auth\LoginController@LoginIndex');                                                                    // Done
Route::post('/Login', 'Auth\LoginController@LoginWeb');                                                                     // Done
Route::get('/Logins', 'Auth\LoginController@LoginsWeb');                                                                    // Done
Route::get('/Logout', 'Auth\LoginController@LogoutWeb');                                                                    // Done
Route::get('/Logouts', 'Auth\LoginController@LogoutsWeb');                                                                  // Done

Route::get('/RegisterCustomer','CustomerController@IndexCustomer');                                                         // Done
Route::post('/RegisterCustomer','CustomerController@StoreCustomer');                                                        // Done

/*Dashboard*/
Route::get('/', 'MasterController@Dashboard');                                                                              // Done
Route::get('/Dashboard', 'MasterController@Dashboard');                                                                     // Done

Route::get('/ProductInformation/{ID}', ['uses' => 'ProductController@IndexDetail', 'as' => 'ProductInformation']);          // Done

Route::get('/BrandFilter/{ID}', ['uses' => 'FilterController@IndexBrand', 'as' => 'BrandFilter']);                          // Done
Route::get('/CategoryFilter/{ID}', ['uses' => 'FilterController@IndexCategory', 'as' => 'CategoryFilter']);                 // Done
Route::get('/SubCategoryFilter/{ID}', ['uses' => 'FilterController@IndexSubCategory', 'as' => 'SubCategoryFilter']);        // Done
Route::get('/SaleFilter', ['uses' => 'FilterController@IndexSale', 'as' => 'SaleFilter']);

Route::get('/SearchProduct/{IDA}','ProductController@IndexSearch');                                                         // Done
Route::post('/SearchProduct','ProductController@PostSearch');                                                               // Done

Route::get('/SortProduct/{IDA}/{IDB}/{IDC}/{IDD}','FilterController@IndexSort');                                            // Done
Route::post('/SortProduct','FilterController@PostSort');                                                                    // Done

Route::group(['middleware' => 'Karyawan'], function() {
  /*Master Data*/
  Route::get('/CompanyDescription','CompanyDescriptionController@Index');                                                   // Done
  Route::post('/CompanyDescription','CompanyDescriptionController@Update');                                                 // Done

  Route::get('/SocialMedia','SocialMediaController@Index');                                                                 // Done
  Route::post('/SocialMedia','SocialMediaController@Store');                                                                // Done
  Route::get('/AjaxSocialMedia','SocialMediaController@Ajax');                                                              // Done
  Route::post('/EditSocialMedia','SocialMediaController@Update');                                                           // Done

  Route::get('/Slider','SliderController@Index');                                                                           // Done
  Route::post('/Slider','SliderController@Store');                                                                          // Done
  Route::get('/AjaxSlider','SliderController@Ajax');                                                                        // Done
  Route::post('/EditSlider','SliderController@Update');                                                                     // Done

  Route::get('/Role','RoleController@Index');                                                                               // Done
  Route::post('/Role','RoleController@Store');                                                                              // Done
  Route::get('/AjaxRole','RoleController@Ajax');                                                                            // Done
  Route::post('/EditRole','RoleController@Update');                                                                         // Done

  Route::get('/Customer','CustomerController@Index');                                                                       // Done
  Route::post('/Customer','CustomerController@Store');                                                                      // Done
  Route::get('/AjaxCustomer','CustomerController@Ajax');                                                                    // Done
  Route::post('/EditCustomer','CustomerController@Update');                                                                 // Done

  Route::get('/Employee','EmployeeController@Index');                                                                       // Done
  Route::post('/Employee','EmployeeController@Store');                                                                      // Done
  Route::get('/AjaxEmployee','EmployeeController@Ajax');                                                                    // Done
  Route::post('/EditEmployee','EmployeeController@Update');                                                                 // Done

  Route::get('/Category','CategoryController@Index');                                                                       // Done
  Route::post('/Category','CategoryController@Store');                                                                      // Done
  Route::get('/AjaxCategory','CategoryController@Ajax');                                                                    // Done
  Route::post('/EditCategory','CategoryController@Update');                                                                 // Done

  Route::get('/SubCategory','SubCategoryController@Index');                                                                 // Done
  Route::post('/SubCategory','SubCategoryController@Store');                                                                // Done
  Route::get('/AjaxSubCategory','SubCategoryController@Ajax');                                                              // Done
  Route::post('/EditSubCategory','SubCategoryController@Update');                                                           // Done

  Route::get('/Brand','BrandController@Index');                                                                             // Done
  Route::post('/Brand','BrandController@Store');                                                                            // Done
  Route::get('/AjaxBrand','BrandController@Ajax');                                                                          // Done
  Route::post('/EditBrand','BrandController@Update');                                                                       // Done

  Route::get('/ProductStatus','ProductStatusController@Index');                                                             // Done
  Route::post('/ProductStatus','ProductStatusController@Store');                                                            // Done
  Route::get('/AjaxProductStatus','ProductStatusController@Ajax');                                                          // Done
  Route::post('/EditProductStatus','ProductStatusController@Update');                                                       // Done

  Route::get('/Product','ProductController@Index');                                                                         // Done
  Route::post('/Product','ProductController@Store');                                                                        // Done
  Route::get('/AjaxProduct','ProductController@Ajax');                                                                      // Done
  Route::post('/EditProduct','ProductController@Update');                                                                   // Done

  Route::get('/SalesOrderStatus','SalesOrderStatusController@Index');                                                       // Done
  Route::post('/SalesOrderStatus','SalesOrderStatusController@Store');                                                      // Done
  Route::get('/AjaxSalesOrderStatus','SalesOrderStatusController@Ajax');                                                    // Done
  Route::post('/EditSalesOrderStatus','SalesOrderStatusController@Update');                                                 // Done

  Route::get('/Bank','BankController@Index');                                                                               // Done
  Route::post('/Bank','BankController@Store');                                                                              // Done
  Route::get('/AjaxBank','BankController@Ajax');                                                                            // Done
  Route::post('/EditBank','BankController@Update');                                                                         // Done

  // Route::get('/State','StateController@Index');                                                                          // Done
  // Route::post('/State','StateController@Store');                                                                         // Done
  // Route::post('/EditState','StateController@Update');                                                                    // Done

  // Route::get('/City','CityController@Index');                                                                            // Done
  // Route::post('/City','CityController@Store');                                                                           // Done
  // Route::post('/EditCity','CityController@Update');                                                                      // Done

  Route::get('/Inventory','ProductController@IndexInventory');                                                              // Done
  Route::get('/AjaxInventory','ProductController@AjaxInventory');                                                           // Done
  Route::post('/Inventory','ProductController@UpdateInventory');                                                            // Done

  Route::get('/TransactionEmployee','SalesOrderController@IndexSalesOrderEmployee');                                        // Done
  Route::get('/AjaxTransactionEmployee','SalesOrderController@AjaxSalesOrderEmployee');                                     // Done
  Route::post('/TransactionEmployee','SalesOrderController@UpdateSalesOrderEmployee');                                      // Done

  Route::get('/UpdateEmployee','EmployeeController@IndexUpdateEmployee');                                                   // Done
  Route::post('/UpdateEmployee','EmployeeController@UpdateEmployee');                                                       // Done
});

Route::group(['middleware' => 'Pembeli'], function() {
  Route::post('/AddCart/{ID}', 'ShopingCartController@AddCart');                                                            // Done

  Route::get('/ShoppingCart','ShopingCartController@Index');                                                                // Done
  Route::post('/ShoppingCart','ShopingCartController@Store');                                                               // Done
  Route::get('/CheckOutInformation','ShopingCartController@IndexCheckOut');                                                 // Done

  Route::get('/FromProvince','RajaOngkirController@GetProvince');                                                           // Done
  Route::get('/ToProvince','RajaOngkirController@GetToProvince');                                                           // Done
  Route::get('/GetToProvince/{ID}','RajaOngkirController@GetToProvincePrint');                                              // Done
  Route::get('/FromCity/{ID}','RajaOngkirController@GetCity');                                                              // Done
  Route::get('/ToCity/{ID}','RajaOngkirController@GetToCity');                                                              // Done
  Route::get('/GetToCity/{ID}','RajaOngkirController@GetToCityPrint');                                                      // Done
  Route::get('/Cost/{ID}/{Weight}','RajaOngkirController@GetCost');                                                         // Done

  Route::get('/TransactionCustomer','SalesOrderController@IndexSalesOrderCustomer');                                        // Done
  Route::get('/AjaxTransactionCustomer','SalesOrderController@AjaxSalesOrderCustomer');                                     // Done
  Route::post('/TransactionCustomer','SalesOrderController@UpdateSalesOrderCustomer');                                      // Done

  Route::get('/UpdateCustomer','CustomerController@IndexUpdateCustomer');                                                   // Done
  Route::post('/UpdateCustomer','CustomerController@UpdateCustomer');                                                       // Done
});

Route::get('/{ID}','Auth\LoginController@Error');                                                                           // Done
