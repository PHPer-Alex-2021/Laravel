<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function adminIndex()
    {
        return view('Admin.Index.index');
    }

    public function dashboard($type)
    {
        if($type==1){
            return view('Admin.Index.index');
        }
        return view('Admin.Index.dashboard');
    }
}
