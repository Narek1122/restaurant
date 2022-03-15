<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantCreateReq;
use App\Models\Image;
use App\Models\Restaurant;
use App\Services\RestaurantService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use LDAP\Result;

class RestaurantController extends Controller
{
    public $restaurantServ;

    public function __construct()
    {
        $this->restaurantServ = new RestaurantService;
    }

    public function index($id = null){

        $paginate = 5;
        $data = Restaurant::with('mainImage')
        ->where('user_id',Auth::user()->id)
        ->where('parent_id',$id)
        ->paginate($paginate);

        return view('restaurant.index',compact('data'));
    }

    public function create(){
        $days = \DB::table('days')->get();
        return view('restaurant.create', compact('days'));
    }

    public function store(RestaurantCreateReq $request, $id = null){

        if($id && isset(Restaurant::find($id)->parent)){
            return redirect()->route('getRestaurant')->with('status','no');
        }
        
        $data = $request->validated();
        

        
        $data['parent_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        
        $res = $this->restaurantServ->store($data);
        
       

       return redirect()->back()->with('status',200);

    }
}
