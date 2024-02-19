<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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


Route::group(['middleware' => ['auth','is_deleted']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/edit/{id}', [userController::class, 'editSingle'])->name('editSingle');
    Route::post('/edit/{id}', [userController::class, 'updateSingle'])->name('updateSingle');

    Route::group([
        'prefix' => 'user',
        'middleware' => 'is_admin',
        ],
        function () {
        Route::get('/list', [userController::class, 'index'])->name('list');
        Route::get('/add', [userController::class, 'create'])->name('add');
        Route::post('/add', [userController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [userController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [userController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [userController::class, 'destroy'])->name('delete');
    });
    Route::prefix('touest')->group(function () {
        Route::get('properte/arrive', [App\Http\Controllers\SurveysController::class, 'index'])->name('touestpropertea');
        Route::get('properte/depart', [App\Http\Controllers\SurveysController::class, 'indexd'])->name('touestproperted');
        Route::get('passenger/arrive', [App\Http\Controllers\PassagerArriveController::class, 'index'])->name('touestpassengera');
        Route::get('passenger/depart', [App\Http\Controllers\SurveydepartController::class, 'index'])->name('touestpassengerd');
    });
    Route::prefix('tone')->group(function () {
        Route::get('properte/arrive', [App\Http\Controllers\SurveysController::class, 'indexo'])->name('tonepropertea');
        Route::get('properte/depart', [App\Http\Controllers\SurveysController::class, 'indexdo'])->name('toneproperted');
        Route::get('passenger/arrive', [App\Http\Controllers\PassagerArriveController::class, 'indexo'])->name('tonepassengera');
        Route::get('passenger/depart', [App\Http\Controllers\SurveydepartController::class, 'indexo'])->name('tonepassengerd');
    });

});


// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

// $this->middleware

// Route::get('/analytics', function() {
//     // $category_name = '';
//     // $data = [
//     //     'category_name' => 'dashboard',
//     //     'page_name' => 'analytics',
//     //     'has_scrollspy' => 0,
//     //     'scrollspy_offset' => '',
//     //     'alt_menu' => 0,
//     // ];
//     // $pageName = 'analytics';
//     // return view('dashboard')->with($data);
//     return view('layouts.auth');
// });

// Route::get('/sales', function() {
//     // $category_name = '';
//     $data = [
//         'category_name' => 'dashboard',
//         'page_name' => 'sales',
//         'has_scrollspy' => 0,
//         'scrollspy_offset' => '',
//         'alt_menu' => 0,
//     ];
//     // $pageName = 'sales';
//     return view('dashboard2')->with($data);
// });


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/register', function () {
    return redirect('register');
});
Route::get('/password/reset', function () {
    return redirect('/login');
});

Route::get('/', function () {
    return redirect('/home');
});
