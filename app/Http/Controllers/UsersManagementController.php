<?php

namespace App\Http\Controllers;

use App\Models\UsersManagement;
use Illuminate\Http\Request;

class UsersManagementController extends Controller
{
    public function store(Request $request)
    {
        $validate = $this->validateUser($request);        

        UsersManagement::create($validate);

        return back();
    }

    public function edit($id)
    {
        return UsersManagement::where('id', $id)->first();
    }
    public function update(Request $request)
    {   
        $users = UsersManagement::find($request->id);

        $users->update($request->all());

        return back();
    }
    public function destroy($id)
    {
        UsersManagement::where('id', $id)->delete();

        return back();
    }


    private function validateUser(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'birthdate' => ['required'],
            'address' => ['required'],
            'age' => ['required']
        ]);

        return $validated;
    }
}
