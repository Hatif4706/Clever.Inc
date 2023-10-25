<?php

use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PoSpkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\TenderVendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\TemplateDocumentController;
use App\Http\Controllers\DocumentTemplate;
use App\Http\Middleware\VerifyVendor;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function() {
    Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::post('/signin', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'new'])->name('new');

    Route::get('/forgot-password', [ResetPasswordController::class, 'forgot'])->name('reset-password.forgot');
    Route::post('/forgot-password', [ResetPasswordController::class, 'send'])->name('reset-password.send');
    Route::get('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'new'])->name('reset-password.new');
});

Route::middleware('auth')->group(function() {

    // Redirect ------------------------------------------------------------
    Route::get('/', function() {

        /** @var App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('Vendor')) {
            return redirect()->route('tenders.index');
        }

        if ($user->hasRole('Logistik|Chief Logistik|Finance|HLM')) {
            return redirect()->route('projects.index');
        }

        return redirect()->route('users.index');
    });

    // Users & Vendors -----------------------------------------------------
    Route::middleware('role:Account Manager|CAM')->group(function() {
        Route::resource('users', UserController::class);
        Route::resource('/vendors', VendorController::class)->except('create', 'store');
        Route::patch('/vendors/{vendor}/verification', [VendorController::class, 'verify'])->name('vendors.verification');
    });

    // Projects ------------------------------------------------------------
    Route::resource('projects', ProjectController::class)->except('index', 'show')->middleware('can:manage project');
    Route::resource('projects', ProjectController::class)->only('index', 'show')->middleware('can:see project');

    Route::prefix('/projects/{project}')->name('projects.')->group(function() {

        Route::get('/report', [ProjectController::class, 'report'])->name('report')->middleware('can:see report');

        Route::middleware('can:manage project')->group(function () {
            Route::get('/need-closing', [ProjectController::class, 'needClosing'])->name('need-closing');
            Route::patch('/closing', [ProjectController::class, 'closing'])->name('closing');
            Route::patch('/complete', [ProjectController::class, 'complete'])->name('complete');
        });

        Route::prefix('/payment')->name('payment.')->middleware('can:see payment')->group(function() {
            Route::get('/', [PaymentController::class, 'show'])->name('show');
            Route::middleware('can:create payment')->group(function() {
                Route::get('/create', [PaymentController::class, 'create'])->name('create');
                Route::post('/store', [PaymentController::class, 'store'])->name('store');
            });
        });

        Route::prefix('/po-spk')->name('po-spk.')->middleware('can:see po spk')->group(function() {
            Route::get('/', [PoSpkController::class, 'show'])->name('show');
            Route::middleware('can:need po spk')->group(function() {
                Route::get('/need', [PoSpkController::class, 'need'])->name('need');
                Route::patch('/need', [PoSpkController::class, 'require'])->name('require');
            });
            Route::middleware('can:create po spk')->group(function() {
                Route::get('/create', [PoSpkController::class, 'create'])->name('create');
                Route::post('/create', [PoSpkController::class, 'store'])->name('store');
            });
            Route::patch('/approve', [PoSpkController::class, 'approve'])->name('approve')->middleware('can:approve po spk');
        });
    });

    // Tenders ------------------------------------------------------------
    Route::resource('tenders', TenderController::class)->except('index', 'show')->middleware('can:manage tender');
    Route::resource('tenders', TenderController::class)->only('index', 'show')->middleware('can:see tender');

    Route::prefix('/histories')->name('histories.')->middleware('role:Vendor')->group(function() {
        Route::get('/', [TenderVendorController::class, 'histories'])->name('index');
        Route::get('/{tenderVendor}', [TenderVendorController::class, 'history'])->name('show');
    });

    Route::prefix('/tenders/{tender}')->name('tenders.')->group(function() {
        Route::middleware(VerifyVendor::class)->group(function() {
            Route::get('/join', [TenderVendorController::class, 'join'])->name('join');
            Route::post('/join', [TenderVendorController::class, 'enter'])->name('vendors.create');
        });

        Route::middleware('can:manage tender')->group(function() {
            Route::get('/vendors', [TenderVendorController::class, 'index'])->name('vendors.index');
            Route::get('/vendors/{tenderVendor}', [TenderVendorController::class, 'show'])->name('vendors.show');
        });

        Route::prefix('/evaluations')->name('evaluations.')->middleware('can:manage tender')->group(function() {
            Route::get('/', [EvaluationController::class, 'index'])->name('index');
            Route::get('/create', [EvaluationController::class, 'create'])->name('create');
            Route::post('/create', [EvaluationController::class, 'store'])->name('store');
            Route::get('/{evaluation}', [EvaluationController::class, 'show'])->name('show');
            Route::patch('/approve/{evaluation}', [EvaluationController::class, 'approve'])->name('approve')->middleware('role:CAM');
        });
    });



    // Templates ------------------------------------------------------------
    Route::prefix('templates')->group(function(){
        Route::get('/', [TemplateController::class, 'index'])->name('templates');
        Route::get('/addtemplate', [TemplateController::class, 'create'])->name('templates.add');
        Route::post('/addtemplate',[TemplateController::class, 'store'])->name('templates.save');
        Route::get('/detail/{id}', [TemplateController::class, 'detail'])->name('templates.detail');
        Route::delete('/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');

        Route::middleware(['checkDocumentOwner'])->group(function () {
            Route::get('/edit/{id}', [TemplateController::class, 'edit'])->name('templates.edit');
            Route::put('/update/{id}', [TemplateController::class, 'update'])->name('templates.update');
        });
        
        // Route::get('/edit/{id}', [TemplateController::class, 'edit'])->name('templates.edit');
        // Route::put('/update/{id}', [TemplateController::class, 'update'])->name('templates.update');

        
    });

    // Profile ------------------------------------------------------------
    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::get('/vendor', [ProfileController::class, 'vendor'])->name('profile.vendor');
        Route::get('/password', [ProfileController::class, 'password'])->name('profile.password');
        Route::put('/', [ProfileController::class, 'update']);
        Route::put('/vendor', [ProfileController::class, 'updateVendor']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);
    });

    // Notifications ------------------------------------------------------
    Route::resource('notifications', NotificationController::class)->only(['index', 'show']);
    Route::patch('/notifications', [NotificationController::class, 'markAllAsRead']);

    // Signout ------------------------------------------------------------
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
});

// Document preview
Route::get('/preview/{src}', fn($src) => view('preview')->with('src', $src))->where('src', '.*');
