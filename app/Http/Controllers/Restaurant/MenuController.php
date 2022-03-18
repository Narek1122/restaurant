<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\Restaurant\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuServ;

    public function __construct()
    {
        $this->menuServ = new MenuService();
    }
    public function index()
    {
        $data = $this->menuServ->index();

        return view('restaurant.menu.index',compact('data'));
    }
}
