<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class PermissionController extends Controller
{
    // This method will show permissions page
    public function index(){

    }

    // This method will show create permissions page
    public function create(){

        return view('permission.create');

    }

    // This method will insert a permission in DB
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => "required|unique:permissions|min:3"
        ]);

        if ($validator->passes()) {

        }
        else{
            return redirect()->route("permissions.create")->withInput()->withErrors($validator);
        }

    }

    // This method will show edit permission page
    public function edit(){

    }

    // This method will update permission
    public function update(){

    }

    // This method will delete the permission
    public function destroy(){

    }
}
