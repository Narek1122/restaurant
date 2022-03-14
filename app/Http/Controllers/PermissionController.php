<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $perms = Permission::orderBy('id', 'DESC')->paginate(5);
        return view('permissions.index', compact('perms'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request['name']]);

        return redirect()->back()
            ->with('success','Permission created successfully');
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect()->back()
            ->with('success','Permission deleted successfully');
    }
}
