<?php

namespace App\Services\Restaurant;
use App\Models\Restaurant\Menu;

class MenuService
{

    public function index()
    {
        $data = Menu::get();
        return $data;
    }

}
