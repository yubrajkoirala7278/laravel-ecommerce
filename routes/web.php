<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ====Auth===============
Auth::routes();
// ====End of Auth=======


// ========Frontend==============
require __DIR__.'/public.php';
// =======End of Frontend========


// ===========Backend============
Route::middleware(['auth.admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        require __DIR__.'/admin.php';
    });
});
// =======end of Backend====


// =====handle wrong url======
Route::redirect('/{any}', '/', 301);
//=======end of handling wrong url===