<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant\FloorPlane;
use App\Services\Restaurant\FloorPlaneService;
use App\Http\Requests\FloorPlaneReq;

class FloorPlanController extends Controller
{
    protected $floorPlanServ;

    public function __construct()
    {
        $this->floorPlanServ = new FloorPlaneService();
        $this->middleware('permission:restaurant', ['only' => ['index','create','store','edit','update']]);
    }

    public function index($id)
    {
        $data = $this->floorPlanServ->getByRestaurantId($id);
        return view('restaurant.floor_plan.index',compact('data'));
    }

    public function create()
    {
        return view('restaurant.floor_plan.create');
    }

    public function store(FloorPlaneReq $request,$id)
    {
        $validated = $request->validated();
        $validated['restaurant_id'] = $id;

        $created = $this->floorPlanServ->store($validated);

        return response()->json([
            'data'=> $created,
            'status' => 200
        ]);
    }

    public function edit($id)
    {
        $data = $this->floorPlanServ->find($id);
        return view('restaurant.floor_plan.edit',compact('data'));

    }

    public function update(Request $request,$id)
    {

        $data = $this->floorPlanServ->update($id,$request->all());

        return response()->json([
            'data'=> $data,
            'status' => 200
        ]);

    }
}
