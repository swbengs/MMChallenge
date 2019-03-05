<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function show($api_token)
    {
        return 202;
    }

    public function mark(Request $request, $api_token)
    {
        return 203;
    }
}
