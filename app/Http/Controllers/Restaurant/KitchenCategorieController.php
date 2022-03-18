<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant\KitchenCategorie;
use Illuminate\Http\Request;
use function redirect;
use function response;
use function view;

class KitchenCategorieController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Admin', ['only' => ['create', 'edit','index']]);
    }

    /**
     * Kitchen Categories page .
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $datas = KitchenCategorie::paginate(5);

        return view('kitchen_categories.index', compact('datas'));
    }

    /**
     * Create Kitchen Categories.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validated = $this->validate($request, [
            'name' => 'required|unique:kitchen_categories,name',
        ]);

        KitchenCategorie::create($validated);

        return redirect()->back()->with('success', 'Category created successfully');

    }

    /**
     * Update Kitchen Categories.
     * @param \Illuminate\Http\Request $request
     * @param Int $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {

        $validated = $this->validate($request, [
            'name' => 'required|unique:kitchen_categories,name',
        ]);

        KitchenCategorie::find($id)->update($validated);

        return response()->json([
            'statues'=> 200
        ]);
    }

    public function destroy($id){
        KitchenCategorie::find($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');;
    }
}
