<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingSAController extends Controller
{
    public function index()
    {



        return view('structAdmin.accounting' );
     }

}
