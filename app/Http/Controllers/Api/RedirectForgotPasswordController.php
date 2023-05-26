<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectForgotPasswordController extends Controller
{

    public function redirectToPage()
    {
        return redirect()->route('password.request');
    }
}
