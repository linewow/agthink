/**
 * [think-auth]
 */
Route::post('login', '\agthink\auth\controller\Login::login');
Route::resource('menu', '\agthink\auth\controller\Menu');
Route::resource('user', '\agthink\auth\controller\User');