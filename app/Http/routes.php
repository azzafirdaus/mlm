<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

/*
|--------------------------------------------------------------------------
| Auth Module
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'auth'), function(){

    Route::get('cashierlogin', function(){
        return View::make('auth.cashier-login');
    });
    Route::post('cashierlogin', 'CashierController@login');
    Route::get('cashierlogout', 'CashierController@logout');

    Route::get('adminlogin', function(){
        return View::make('auth.admin-login');
    });
    Route::post('adminlogin', 'AdminController@login');
    Route::get('adminlogout', 'AdminController@logout');
});

/*
|--------------------------------------------------------------------------
| Cashier Module
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'cashier'), function(){
    // main page for the cashier section
    Route::get('/', 'CashierController@menu');

    Route::post('opentransaction', 'CashierController@open');

    Route::get('open', function(){
        return View::make('cashier.menu-close')
        	->with('success', 'Transaksi berhasil dibuka');
    });

	Route::post('closetransaction', 'CashierController@close');

	Route::get('close', function(){
        return View::make('cashier.menu')
        	->with('success', 'Transaksi berhasil ditutup');
    });

    Route::get('topup', 'CashierController@topup');
    Route::post('topup', 'CashierController@topupShow');
    
    Route::post('topup/print', function(){
        return View::make('cashier.menu-close')
        	->with('success', 'Top up berhasil dilakukan');
    });

    Route::get('saldo', 'CashierController@saldo');
    Route::post('saldo', 'CashierController@cekSaldo');

	Route::get('kaki', 'CashierController@kaki');
    Route::post('kaki', 'CashierController@cekKaki');

    Route::get('tarik', 'CashierController@tarik');
    Route::post('tarik', 'CashierController@tarikSaldo');

    Route::post('tarik/print', function(){
        return View::make('cashier.menu-close')
        	->with('success', 'Tarik tunai berhasil dilakukan');
    });

    Route::get('register', 'CashierController@register');
    Route::post('register', 'CashierController@registerProcess');

    Route::post('register/print', function(){
        return View::make('cashier.menu-close')
        	->with('success', 'Registrasi kartu berhasil dilakukan');
    });
});

/*
|--------------------------------------------------------------------------
| Player Module
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'player'), function(){
    // main page for the player section
    Route::get('/',  function(){
        return View::make('player.menu');
    });

    Route::get('saldo', 'PlayerController@saldo');
    Route::post('saldo', 'PlayerController@cekSaldo');

    Route::get('kaki', 'PlayerController@kaki');
    Route::post('kaki', 'PlayerController@cekKaki');

    Route::group(array('prefix' => 'daftar'), function(){
        //page daftar
        Route::get('/', 'PlayerController@daftar');

        Route::get('kepala', 'PlayerController@daftarKepala');
        Route::post('kepala', 'PlayerController@submitKepala');

        Route::get('kaki', 'PlayerController@daftarKaki');
        Route::post('kaki', 'PlayerController@submitKaki');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Module
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin'), function(){
    // main page for the admin section
    Route::get('/', 'AdminController@dashboard');
    
    Route::group(array('prefix' => 'laporan'), function(){
        // main page for the admin/laporan section
        Route::get('/', 'AdminController@laporan');
        
        Route::get('topup', 'AdminController@topup');
        Route::post('topup', 'AdminController@topupTanggal');
        
        Route::get('register', 'AdminController@register');
        Route::post('register', 'AdminController@registerTanggal');
        
        Route::get('tarik', 'AdminController@tarik');
        Route::post('tarik', 'AdminController@tarikTanggal');

        Route::get('kasir', 'AdminController@kasir');
        Route::get('setoran', 'AdminController@setoran');
        
    });

    Route::group(array('prefix' => 'pengguna'), function(){
        // main page for the admin/pengguna section
        Route::get('/', 'AdminController@pengguna');

        Route::get('create', function(){
            return View::make('admin.pages.pengguna.create')
                ->with('activePage', 'pengguna');
        });

        Route::post('create', 'AdminController@penggunaCreate');
        Route::get('delete', 'AdminController@penggunaDelete');
        Route::get('update', 'AdminController@penggunaUpdate');
        Route::post('update', 'AdminController@penggunaUpdateData');
    });
    
    Route::group(array('prefix' => 'fasilitas'), function(){
        // main page for the admin/fasilitas section
        Route::get('/', 'AdminController@fasilitas');
        Route::post('update', 'AdminController@fasilitasUpdateData');
        Route::get('update', 'AdminController@fasilitasUpdate');
        Route::get('delete', 'AdminController@fasilitasDelete');
    });

    Route::get('kaki', 'AdminController@kaki');
    Route::post('kaki', 'AdminController@kakiTanggal');
    Route::get('disable', 'AdminController@disable');
});