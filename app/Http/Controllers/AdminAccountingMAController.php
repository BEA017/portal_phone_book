<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAccountingMAController extends Controller
{
    public function index()
    {
        $userCards = DB::table('Users as u')
            ->select(  'u.id',  'u.name', 'u.role', 'u.email', 'ma.structName', 'u.password' )
            ->join('main_structs as ma', 'u.struct_id', '=', 'ma.id')
            ->get();
        return view('mainAdmin.adminAdmAccounting', compact('userCards'));
    }
}

