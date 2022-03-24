<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant\Menu;
use App\Models\Restaurant\MenuCategory;
use App\Models\User;
use App\Services\Restaurant\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuServ;

    public function __construct()
    {
        $this->menuServ = new MenuService();
    }
    public function index($id)
    {
        $data = $this->menuServ->index();
        $categories = MenuCategory::get();
        if(request()->ajax()) {

            $customers = Menu::with('category')->where('restaurant_id',$id)->get();

            return datatables()
                ->of($customers)
                ->toJson();
        }

        return view('restaurant.menu.index',compact('data','categories'));
    }

    public function create(Request $request,$id){
        $data = $request->all();
        $data['restaurant_id'] = $id;
        $this->menuServ->create($id,$data);
        return response()->json([
            'success' => true,
            'message' => 'Created'
        ]);

    }

    public function delete($id)
    {
        $this->menuServ->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ]);

    }

    public function edit(Menu $id)
    {
        $categories = MenuCategory::get();
        return view('restaurant.menu.edit',['data' => $id,'categories' => $categories]);
    }

    public function update(Request $request,$id)
    {

        $this->menuServ->update($id,$request->all());

        return redirect()->back()->with(['success' => true]);
    }
}
