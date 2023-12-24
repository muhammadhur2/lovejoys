<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationRequestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\EvaluationRequest;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-key', function () {
    Log::info(env('APP_KEY'));
    return 'Logged the key!';
});

Route::get('/dashboard', function () {
    // Get the ID of the currently authenticated user
    $userId = Auth::id();

    // Fetch only approved evaluation requests for this user
    $requests = EvaluationRequest::where('is_approved', true)
                                 ->where('user_id', $userId)
                                 ->get();

    \Log::debug('Requests: ', $requests->toArray());

    return view('dashboard', compact('requests'));
})->middleware(['auth'])->name('dashboard'); //->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/otp-verify', function () {
    return view('auth.verify-otp');
})->name('otp.verify');

Route::post('/otp-check', [AuthenticatedSessionController::class, 'checkOTP'])->name('otp.check');
Route::post('/otp-resend', [AuthenticatedSessionController::class, 'resendOTP'])->name('otp.resend');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/evaluation-requests', [EvaluationRequestController::class, 'index'])
        ->middleware('admin')
        ->name('evaluation-requests.index');
    Route::get('/request-evaluation', [EvaluationRequestController::class, 'create'])->name('evaluation-requests.create');
    Route::post('/request-evaluation', [EvaluationRequestController::class, 'store'])->name('evaluation-requests.store');
    Route::delete('/evaluation-requests/{evaluationRequest}', [EvaluationRequestController::class, 'destroy'])->name('evaluation-requests.destroy');
    Route::post('/evaluation-requests/{id}/approve', [EvaluationRequestController::class, 'approve'])->name('evaluation-requests.approve');


});

require __DIR__.'/auth.php';
