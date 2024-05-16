<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(Request $request) {
        // $users = User::paginate(10);
        $users = DB::table('users')
                ->when($request->input('keyword'), function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%");
                })
                ->orderBy('name', 'asc')
                ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    function create() {
        return view('pages.users.create');
    }

    function store(StoreUserRequest $request) {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user){
        return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user){
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->save();

        if($request->phone){
            $user->update(['phone', $request->phone]);
        }
        if($request->password){
            $user->update(['password', Hash::make($request->password)]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
