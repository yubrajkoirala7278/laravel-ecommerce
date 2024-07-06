<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ====Auth====
Auth::routes([
    'register'=>false,
]);
// ====End of Auth===


// ========Frontend============
require __DIR__.'/public.php';
// =======End of Frontend=====

// ===========Backend========
Route::prefix('admin')->group(function(){
    require __DIR__.'/admin.php';
});
// =======end of Backend====

