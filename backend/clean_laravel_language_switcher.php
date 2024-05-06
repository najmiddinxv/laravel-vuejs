<?php


// Set Up Routes: First, define routes for each language in your web.php file.
// Route::get('/{lang?}', 'LocalizationController@index')->name('locale.switch');


// Controller: Create a controller named LocalizationController to handle language switching.
// php artisan make:controller LocalizationController


// In LocalizationController, define the index method:

// namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController #extends Controller
{
    public function index($locale = null)
    {
        if ($locale && in_array($locale, ['en', 'fr', 'es'])) {
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}

// Language Files: Create language files for each language you want to support in the resources/lang directory

// For example, for English (en), create a file en.php:

// resources/lang/en.php
return [
    'welcome' => 'Welcome to our website!',
    // other English translations
];


// For French (fr), create a file fr.php:

// resources/lang/fr.php
return [
    'welcome' => 'Bienvenue sur notre site web!',
    // other French translations
];


// Blade Template: In your Blade template, create a language switcher dropdown.
// <form id="langForm" action="{{ route('locale.switch') }}" method="GET">
//     @csrf
//     <select name="lang" id="langSelector" onchange="this.form.submit()">
//         <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
//         <option value="fr" {{ App::getLocale() == 'fr' ? 'selected' : '' }}>French</option>
//         <!-- Add options for other languages -->
//     </select>
// </form>


// Middleware (optional): You can create a middleware to set the language based on the user's preference or browser settings.

// php artisan make:middleware SetLocale

#namespace App\Http\Middleware;
use Closure;
#use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'fr', 'es'])) {
            App::setLocale($request->lang);
        } elseif (empty(App::getLocale())) {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}


// Register this middleware in the Kernel:

// protected
 $middlewareGroups = [
    'web' => [
        // other middleware
        #\App\Http\Middleware\SetLocale::class,
    ],
];

// Now, when the user selects a language from the dropdown, the lang parameter will be sent to the LocalizationController, and the application's locale will be set accordingly.







