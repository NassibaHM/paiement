<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
Route::middleware('check.user.type')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/branches', [BrancheController::class, 'index'])->name('branches.index');
Route::get('/branches/create', [BrancheController::class, 'create'])->name('branches.create');
Route::post('/branches', [BrancheController::class, 'store'])->name('branches.store');
Route::get('/branches/{branche}/edit', [BrancheController::class, 'edit'])->name('branches.edit');
Route::put('/branches/{branche}', [BrancheController::class, 'update'])->name('branches.update');
Route::delete('/branches/{id}', [BrancheController::class, 'destroy'])->name('branches.destroy');
Route::post('/branches/{id}/add-specialite', [BrancheController::class, 'addSpecialite'])->name('branches.addSpecialite');
Route::post('/branches/{id}/remove-specialite', [BrancheController::class, 'removeSpecialite'])->name('branches.removeSpecialite');

Route::get('/specialites', [SpecialiteController::class, 'index'])->name('specialites.index');
Route::get('/specialites/create', [SpecialiteController::class, 'create'])->name('specialites.create');
Route::post('/specialites', [SpecialiteController::class, 'store'])->name('specialites.store');
Route::get('/specialites/{id}/edit', [SpecialiteController::class, 'edit'])->name('specialites.edit');
Route::put('/specialites/{id}', [SpecialiteController::class, 'update'])->name('specialites.update');
Route::delete('/specialites/{id}', [SpecialiteController::class, 'destroy'])->name('specialites.destroy');

Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiants/{etudiants_id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{etudiants_id}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{etudiants_id}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
Route::get('/etudiants/search', [EtudiantController::class, 'search'])->name('etudiants.search');
Route::get('/specialites/{branche}',[EtudiantController::class, 'getSpecialites'] )->name('specialites.byBranche');

Route::resource('branches.specialites', SpecialiteController::class);

Route::resource('paiements', PaiementController::class);
Route::get('paiements/{id}/telecharger-recu', [PaiementController::class, 'telechargerRecu'])->name('paiements.telechargerRecu');
// Route::get('paiements/{id}/imprimer-recu', [PaiementController::class, 'imprimerRecu'])->name('paiements.imprimerRecu');
Route::get('paiements', [PaiementController::class, 'index'])->name('paiements.index');
Route::get('paiements/{id}/telecharger-recu', [PaiementController::class, 'telechargerRecu'])->name('paiements.telechargerRecu');
Route::get('etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::resource('etudiants', EtudiantController::class);
Route::middleware(['auth', 'user.auth'  ])->group(function () {
    Route::resource('User', UserController::class);

});
});

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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
//Route::post('logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
