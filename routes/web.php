    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
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
    return view('home');
});
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/test',[\App\Http\Controllers\SessionsController::class,'index'])->middleware('auth')
    ->name('test');

Route::get('/login',[\App\Http\Controllers\LoginController::class,'index']);
Route::get('/register', [\App\Http\Controllers\RegisterController::class,'index'],
);
Route::post('/drop', [\App\Http\Controllers\SessionsController::class,'drop']);
Route::post('/dropuser', [\App\Http\Controllers\SessionsController::class,'dropuser']);
Route::get('/logout', [\App\Http\Controllers\LogoutController::class,'logout']) -> name('logout');
Route::get('/list_session', [\App\Http\Controllers\SessionsController::class,'turfSessions']) -> name('list_session');
Route::get('list-all-sessions',[\App\Http\Controllers\SessionsController::class,'listAllSessions']);
Route::post('/new_session', [\App\Http\Controllers\SessionsController::class,'store']) -> name('new_session');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'store']) -> name('login');
Route::get('userlist',[\App\Http\Controllers\SessionsController::class,'user_list']);
Route::get('all-sessions',[\App\Http\Controllers\SessionsController::class,'AllSessions']);
//Route::get('/', function () {
//    return view('welcome');
//});
Route::post('/adminRegister', [AdminController::class,'store']) -> name('register');