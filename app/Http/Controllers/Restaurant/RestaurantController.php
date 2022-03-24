<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantCreateReq;
use App\Models\Restaurant\Restaurant;
use App\Services\Restaurant\RestaurantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function dd;
use function redirect;
use function view;

class RestaurantController extends Controller
{
    public $restaurantServ;

    public function __construct()
    {
        $this->restaurantServ = new RestaurantService;
        $this->middleware('permission:restaurant', ['only' => ['index','create','store','edit','editData']]);

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




       return redirect()->route('editRestaurant',$res['id'])->with('status',200);

    }

    public function edit($id){
        $data = Restaurant::with('mainImage')
        ->find($id);
        $days = \DB::table('days')->get();

        return view('restaurant.edit',compact('data','days'));
    }

    public function editData(RestaurantCreateReq $request, $id){
        $data = $request->validated();

        $res = $this->restaurantServ->update($id,$data);
        return redirect()->back()->with('status',200);

    }




}
