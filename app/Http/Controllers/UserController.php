<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $user = User::all();

        return view('admin.user.index',[
            'user'=>$user
        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $save_user = new User;
        $save_user->name=$request->get('username');
        $save_user->email=$request->get('email');
        $save_user->password=bcrypt('password');
        $save_user->assignRole($request->get('roles') == 'ADMIN' ? 'admin' : 'user');
        $save_user->save();

        return redirect()->route('user.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.index',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->all();

        return view('admin.user.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('role'));

        return redirect()->route( 'user.index');
    }

    public function destroy(string $id)
    {
        $hapus = User::findOrFail($id);
        $hapus->delete();
        $hapus->removeRole('admin','user');

        return redirect()->route('user.index');
    }
}
