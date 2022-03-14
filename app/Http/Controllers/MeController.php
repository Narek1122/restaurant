<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     *  Profile page.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        return view('me.index');
    }

    /**
     * Change password page .
     *
     * @return \Illuminate\Http\Response
     */

    public function changePassword(){
        return view('me.change_password');
    }
}
