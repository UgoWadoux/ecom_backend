<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = UserResource::collection(User::all());

        return response()->json([
            'users'=>$users
        ]);
    }
    public function show($id)
    {
        $user = new UserResource(User::find($id));

        return response()->json([
           'user'=>$user
        ]);
    }
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->save();

        return response()->json([
           'user'=>$user
        ]);
    }
    public function update($id, UserRequest $request)
    {
        $user = User::find($id);
        $user->update($request->safe()->except('email'));
        $user->save();

        return response()->json([
            'user'=>$user
        ]);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'users'=>$this->index()
        ]);
    }
}