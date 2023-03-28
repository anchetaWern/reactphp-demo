<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

// ...

Route::get('/upload', FileUploadController::class);