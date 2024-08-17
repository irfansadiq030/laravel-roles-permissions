<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionController extends Controller
{
    // This method will show permissions page
    public function index()
    {

        $permissions = Permission::orderBy("created_at", "desc")->paginate(5);
        return view('permission.list', ['permissions' => $permissions]);

    }

    // This method will show create permissions page
    public function create()
    {

        return view('permission.create');

    }

    // This method will insert a permission in DB
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => "required|unique:permissions|min:3"
        ]);

        if ($validator->passes()) {

            Permission::create(["name" => $request->name]);

            return redirect()->route("permissions.index")->with("success", "Permission Added Successfully!");

        } else {
            return redirect()->route("permissions.create")->withInput()->withErrors($validator);
        }

    }

    // This method will show edit permission page
    public function edit($id)
    {

        $permission = Permission::findOrFail($id);
        return view("permission.edit", ["permission" => $permission]);
    }

    // This method will update permission
    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);

        // dd($request);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name'
        ]);

        if ($validator->passes()) {

            $permission->name = $request->name;
            $permission->save();
            return redirect()->route("permissions.index")->with("success", "Permission Updated Successfully!");

        } else {
            return redirect()->route("permissions.edit", $id)->withInput()->withErrors($validator);
        }
    }

    // This method will delete the permission
    public function destroy(Request $request)
    {
        $id = $request->id;
        $permission = Permission::findOrFail($id);

        if ($permission == null) {
            session()->flash("error", "Permission Not Found");

            return response()->json([
                'status' => false,
            ]);
        }

        $permission->delete();

        session()->flash('success','Permission Deleted Successfully');
        return response()->json([
            'status' => true,
        ]);

    }
}
