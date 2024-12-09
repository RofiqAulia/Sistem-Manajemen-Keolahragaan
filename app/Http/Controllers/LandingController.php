<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AtletModel;

class LandingController extends Controller
{
    public function index()
    {
        $user = user::all();

        $atlet = AtletModel::all();

        return view('landing.index', [
            'user' => $user,
            'atlet' => $atlet,
        ]);
    }
}
