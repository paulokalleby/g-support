<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard')->name('home.index');

/**
 *  Admin Routes
 */
Route::middleware(['auth'])
        ->namespace('App\Http\Livewire\Admin')
        ->group(function () {

        Route::get('/dashboard',  \Dashboard\DashboardIndex::class)
                ->name('dashboard.index');
        
        Route::get('/suports', Supports\SupportsIndex::class)
                ->name('supports.index')
                ->middleware('can:supports');

        Route::get('/categories', Categories\CategoriesIndex::class)
                ->name('categories.index')
                ->middleware('can:categories');

        Route::get('/places', Places\PlacesIndex::class)
                ->name('places.index')
                ->middleware('can:places');
        
        Route::get('/departments', Departments\DepartmentsIndex::class)
                ->name('departments.index')
                ->middleware('can:departments');

        Route::get('/users', Users\UsersIndex::class)
                ->name('users.index')
                ->middleware('can:users');

        Route::get('/settings', Settings\SettingsIndex::class)
                ->name('settings.index')
                ->middleware('can:settings');

        Route::get('/profile', Profile\ProfileIndex::class)
                ->name('profile.index');
});

/**
 *  Auth Routes
 */

Route::prefix('auth')
        ->namespace('App\Http\Livewire\Auth')
        ->group(function () {

        Route::get('/login', Login::class)
                ->name('auth.login')
                ->middleware('guest');


        Route::get('/register', Register::class)
                ->name('auth.register')
                ->middleware('guest');


        Route::get('/forgot-password', ForgotPassword::class)
                ->name('password.forgot')
                ->middleware('guest');

        Route::get('/reset-password', ResetPassword::class)
                ->name('password.reset')
                ->middleware('guest');

        Route::get('/logout', [Login::class, 'logout'])
                ->name('auth.logout')
                ->middleware('auth');
});
