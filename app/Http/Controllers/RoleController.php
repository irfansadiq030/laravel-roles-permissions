<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;


class RoleController extends Controller
{
    // This method will show roles page
    public function index()
    {

        $roles = Role::orderBy("name", "ASC")->paginate(5);
        return view('roles.list', ['roles' => $roles]);

    }

    // This method will show create roles page
    public function create()
    {
        $permissions = Permission::orderBy("name", "ASC")->get();

        return view('roles.create', [
            'permissions' => $permissions
        ]);

    }

    // This method will insert a Roles in DB
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => "required|unique:roles|min:3"
        ]);

        if ($validator->passes()) {

            $role = Role::create(["name" => $request->name]);

            if (!empty($request->permission)) {

                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route("roles.index")->with("success", "Role Added Successfully!");

        } else {
            return redirect()->route("roles.create")->withInput()->withErrors($validator);
        }

    }

    // This method will show edit Roles page
    public function edit($id)
    {

        $permission = Permission::findOrFail($id);
        return view("permission.edit", ["permission" => $permission]);
    }

    // This method will update Roles
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

    // This method will delete the Roles
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

        session()->flash('success', 'Permission Deleted Successfully');
        return response()->json([
            'status' => true,
        ]);

    }
}
