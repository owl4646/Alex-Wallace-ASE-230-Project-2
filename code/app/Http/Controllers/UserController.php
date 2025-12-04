
<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return User::with('roles')->get();
    }
    public function show($id){
        return User::with('roles')->findOrFail($id);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }
    public function update(Request $request,$id){
        $user = User::findOrFail($id);
        $data = $request->only('name','email');
        $user->update($data);
        return $user;
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null,204);
    }
    public function profile(Request $request){
        return $request->user()->load('roles');
    }
}
