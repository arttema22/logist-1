<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\RefillingController;
use App\Http\Controllers\trucks\TrucksController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\ReviseController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\billing\DistanceBillingController;
use App\Http\Controllers\billing\RouteBillingController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TlgController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Refilling\FuelSupplierController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

// Маршруты аутентификации
Route::name('user.')
    ->prefix('user')
    ->namespace('User')
    //->middleware(['auth', 'verified'])
    ->group(function () {
        // Маршрут на страницу аутентификации
        Route::get('/login', function () {
            if (Auth::check()) { // Если пользователь уже аутентифицирован, то на приват его
                return redirect(route('home'));
            }
            return view('auth.login'); // На страницу входа
        })->name('login');

        Route::post('/login', [LoginController::class, 'login'])->name('login');

        Route::get('/logout', function () {
            Auth::logout();
            return redirect(route('home'));
        })->name('logout');

        // Маршрут регистрации нового пользователя
        Route::get('/registration', function () {
            if (Auth::check()) { // Если пользователь уже аутентифицирован, то на приват его
                return redirect(route('home'));
            }
            return view('auth.registration');
        })->name('registration');
        // Маршрут записи в базу нового пользователя
        Route::post('/registration', [RegisterController::class, 'save'])->name('save');

        Route::get('', [UserController::class, 'index'])->middleware('auth')->name('list');
        Route::get('/create', [UserController::class, 'create'])->middleware('auth')->name('create');
        Route::post('/store', [UserController::class, 'store'])->middleware('auth')->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('auth')->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->middleware('auth')->name('update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->middleware('auth')->name('destroy');
        Route::get('/recover/{id}', [UserController::class, 'recover'])->middleware('auth')->name('recover');

        Route::get('/roles', [UserController::class, 'role'])->middleware('auth')->name('roles');
        Route::get('/role/update/{id}', [UserController::class, 'role_update'])->middleware('auth')->name('role-update');
        Route::post('/role/update/{id}', [UserController::class, 'role_update_save'])->middleware('auth')->name('role-update-save');
    });

// Группа маршрутов Справочники
Route::name('directory.')
    ->prefix('directory')
    ->namespace('Directory')
    ->middleware(['auth', 'verified'])
    ->group(__DIR__ . '/web/directory.php');

// Группа Тарификация по расстоянию
Route::name('billing.')
    ->prefix('billing')
    ->namespace('Billing')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/distance', [DistanceBillingController::class, 'index'])->name('distance');
        Route::get('/distance/edit/{id}', [DistanceBillingController::class, 'edit'])->name('distance-edit');
        Route::post('/distance/update/{id}', [DistanceBillingController::class, 'update'])->name('distance-update');

        Route::get('/route', [RouteBillingController::class, 'index'])->name('route');
        Route::get('/route/create', [RouteBillingController::class, 'create'])->name('route-create');
        Route::post('/route/store', [RouteBillingController::class, 'store'])->name('route-store');
        Route::get('/route/edit/{id}', [RouteBillingController::class, 'edit'])->name('route-edit');
        Route::post('/route/update/{id}', [RouteBillingController::class, 'update'])->name('route-update');
        Route::get('/route/destroy/{id}', [RouteBillingController::class, 'destroy'])->name('route-destroy');
    });

// Группа Список заправок
Route::name('refilling.')
    ->prefix('refilling')
    ->namespace('Refilling')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [RefillingController::class, 'index'])->name('list');
        Route::get('/archive', [RefillingController::class, 'archive'])->name('archive');
        Route::get('/create', [RefillingController::class, 'create'])->name('create');
        Route::post('/store', [RefillingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RefillingController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [RefillingController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [RefillingController::class, 'destroy'])->name('destroy');
        Route::get('/statistics', [RefillingController::class, 'statistics'])->name('statistics');
        Route::get('/fuelsupplier', [FuelSupplierController::class, 'index'])->name('fuelsupplier');
    });

// Группа Список авто
Route::name('trucks.')
    ->prefix('trucks')
    ->namespace('Trucks')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [TrucksController::class, 'list'])->middleware('auth')->name('list');
        Route::get('/new', [TrucksController::class, 'new'])->middleware('auth')->name('new');
        Route::post('/new', [TrucksController::class, 'new_save'])->middleware('auth')->name('new-save');
        Route::get('/update/{id}', [TrucksController::class, 'update'])->middleware('auth')->name('update');
        Route::post('/update/{id}', [TrucksController::class, 'update_save'])->middleware('auth')->name('update-save');
        Route::get('/delete/{id}', [TrucksController::class, 'delete'])->middleware('auth')->name('delete');
    });

// Группа Список маршрутов
Route::name('routes.')
    ->prefix('routes')
    ->namespace('Routes')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [RoutesController::class, 'index'])->name('list');
        Route::get('/archive', [RoutesController::class, 'archive'])->name('archive');
        Route::get('/create', [RoutesController::class, 'create'])->name('create');
        Route::post('/store', [RoutesController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoutesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [RoutesController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [RoutesController::class, 'destroy'])->name('destroy');
        Route::post('/service-store/{id}', [RoutesController::class, 'service_store'])->name('service-store');
        Route::post('/service-update/{id}', [RoutesController::class, 'service_update'])->name('service-update');
        Route::get('/service-destroy/{id}', [RoutesController::class, 'service_destroy'])->name('service-destroy');
    });

// Группа Список доп услуг
Route::name('services.')
    ->prefix('services')
    ->namespace('Services')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [ServicesController::class, 'list'])->name('list');
        Route::get('/archive', [ServicesController::class, 'list_archive'])->name('list-archive');
        Route::get('/new', [ServicesController::class, 'new'])->name('new');
        Route::post('/new', [ServicesController::class, 'new_save'])->name('new-save');
        Route::get('/update/{id}', [ServicesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ServicesController::class, 'update_save'])->name('update-save');
        Route::get('/delete/{id}', [ServicesController::class, 'delete'])->name('delete');
    });

// Группа Начисления
Route::name('profit.')
    ->prefix('profit')
    ->namespace('Profit')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [ProfitController::class, 'index'])->name('list');
        Route::get('/archive', [ProfitController::class, 'archive'])->name('archive');
        Route::get('/close-all', [ProfitController::class, 'close_all'])->name('close-all');
        Route::get('/close/{id}', [ProfitController::class, 'close'])->name('close');
        Route::post('/store-all', [ProfitController::class, 'store_all'])->name('store-all');
        Route::post('/store/{id}', [ProfitController::class, 'store'])->name('store');
        Route::get('/export/{id}/{date}', [ProfitController::class, 'export'])->name('export');
        Route::get('/archive/export/{id}', [ProfitController::class, 'export_archive'])->name('export-archive');
        Route::get('/export-all', [ProfitController::class, 'export_all'])->name('export-all');

        Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');
        Route::get('pdf/generate', [PDFController::class, 'generatePDF'])->name('pdf.generate');
    });

// Группа Сверка
Route::name('revise.')
    ->prefix('revise')
    ->namespace('Revise')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [ReviseController::class, 'list'])->name('list');
        Route::get('/store', [ReviseController::class, 'store'])->name('store');
    });

// Группа Зарплата
Route::name('salary.')
    ->prefix('salary')
    ->namespace('Salary')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('', [SalaryController::class, 'index'])->name('list');
        Route::get('/archive', [SalaryController::class, 'archive'])->name('archive');
        Route::get('/create', [SalaryController::class, 'create'])->name('create');
        Route::post('/store', [SalaryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SalaryController::class, 'destroy'])->name('destroy');
    });
