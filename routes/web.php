<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
});
/*
|--------------------------------------------------------------------------
| PASS APPROVE / REJECT (ADMIN)
|--------------------------------------------------------------------------
*/
Route::post('/admin/pass/{id}/approve', 'AdminController@approvePass')
    ->name('pass.approve');

Route::post('/admin/pass/{id}/reject', 'AdminController@rejectPass')
    ->name('pass.reject');
Route::post('/admin/login', 'AdminController@loginCheck');  

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/
Route::get('/reg', 'Buspass123@registerForm')->name('register.form');
Route::post('/form', 'Buspass123@formData')->name('register.store');

/*
|--------------------------------------------------------------------------
| LOGIN / LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/login', 'Buspass123@loginForm')->name('login.form');
Route::post('/login', 'Buspass123@loginCheck')->name('login.check');

Route::get('/dashbord', 'Buspass123@dashboard')->name('dashbord');
Route::get('/logout', 'Buspass123@logout')->name('logout');

Route::post('/admin/pass/status/{id}', 'AdminController@updateStatus')
     ->name('admin.pass.status');

/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/
Route::get('/contact', 'Buspass123@contact')->name('contact');
Route::post('/contact/submit', 'Buspass123@submit')->name('contact.submit');

/*
|--------------------------------------------------------------------------
| STATIC PAGES (OLD – SAFE)
|--------------------------------------------------------------------------
*/
Route::view('/about', 'about');
Route::view('/help', 'help');
Route::view('/terms', 'terms');
Route::view('/privacy', 'privacy');
Route::view('/bussearch', 'bussearch');
Route::view('/pay', 'pay');
Route::view('/renew', 'renew');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::get('/profile', 'Buspass123@profileForm');
Route::post('/profile', 'Buspass123@profileSave');

/*
|--------------------------------------------------------------------------
| STUDENT PASS
|--------------------------------------------------------------------------
*/
Route::get('/studpass', 'Buspass123@showForm')->name('student.pass.form');
Route::post('/studpass', 'Buspass123@saveForm')->name('book.save');

Route::get('/book', 'Buspass123@bookForm')->name('book.form');

/*
|--------------------------------------------------------------------------
| PASSENGER PASS
|--------------------------------------------------------------------------
*/
Route::get('/passengerpass', 'Buspass123@passengerForm');
Route::post('/passengerpass', 'Buspass123@savePassenger')->name('passengerpass.store');

/*
|--------------------------------------------------------------------------
| APPLY / MY PASSES
|--------------------------------------------------------------------------
*/
Route::get('/apply', 'Buspass123@applyPass')->name('apply.pass');
Route::get('/apply-pass', 'Buspass123@applyPass');        // OLD support
Route::get('/student-pass', 'Buspass123@showForm');       // OLD support
Route::get('/passenger-pass', 'Buspass123@passengerForm'); // OLD support

Route::get('/my-passes', 'Buspass123@myPasses')->name('my.passes');
// Route::view('/mypass', 'mypass'); // OLD view (safe)
Route::get('/my-passes', 'Buspass123@myPasses')->name('my.passes');

/*
|--------------------------------------------------------------------------
| PASS VIEW (IMPORTANT – FIXED)
|--------------------------------------------------------------------------
*/
Route::get('/pass/{id}', 'Buspass123@showPass')->name('pass.show');
Route::post('/renewal/find', 'Buspass123@findByIcard')->name('renew.find');
Route::post('/renewal/update', 'Buspass123@renewUpdate')->name('renew.update');
Route::delete('/admin/user/{id}', 'Buspass123@deleteUser')
     ->name('admin.user.delete');


/*
|--------------------------------------------------------------------------
| PAYMENT
|--------------------------------------------------------------------------
*/
Route::get('/payment', 'Buspass123@payindex')->name('payment.page');
Route::post('/save-payment', 'Buspass123@paystore')->name('save.payment');

/*
|--------------------------------------------------------------------------
| ADMIN (OLD + NEW SAFE)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', 'AdminController@loginCheck')->name('admin.login.check');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

Route::match(['get','post'], '/admin', 'AdminController@dashboard')
    ->name('admin.dashboard');

// Admin Routes Management
Route::post('/admin/routes/store', 'AdminController@routeStore')->name('admin.routes.store');
Route::get('/admin/routes/edit/{id}', 'AdminController@routeEdit')->name('admin.routes.edit');
Route::post('/admin/routes/update/{id}', 'AdminController@routeUpdate')->name('admin.routes.update');
Route::get('/admin/routes/delete/{id}', 'AdminController@routeDelete')->name('admin.routes.delete');

/*
|--------------------------------------------------------------------------
| AJAX ROUTES (OLD – KEPT)
|--------------------------------------------------------------------------
*/
Route::get('/get-to/{from}', function($from){
    return \App\Busroute::where('from', $from)->get();
});

Route::get('/get-price/{from}/{to}', function($from, $to){
    $route = \App\Busroute::where('from',$from)
                          ->where('to',$to)
                          ->first();

    if (!$route) {
        return response()->json(['price' => null]);
    }

    $type = request()->get('type');

    return response()->json([
        'price' => $type == "Express"
            ? $route->express_student_price
            : $route->local_student_price
    ]);
});
