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
//        Checking for authorization
        $this->authorize('viewAny', User::class);

        $users = UserResource::collection(User::all());

        return response()->json([
            'users' => $users
        ]);
    }

    public function show($id)
    {
//        Checking for authorization
        $this->authorize('view', User::class);

        $user = new UserResource(User::find($id));

        return response()->json([
            'user' => $user
        ]);
    }

    public function store(UserRequest $request)
    {
//        Checking for authorization
        $this->authorize('create', User::class);

        $user = User::create($request->all());
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    public function update($id, UserRequest $request)
    {
//        Checking for authorization
        $this->authorize('update', User::class);

        $user = User::find($id);
        $user->update($request->safe()->except('email'));
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
//        Checking for authorization
        $this->authorize('delete', User::class);

        $user = User::find($id);
        $user->delete();

        return response()->json([
            'users' => $this->index()
        ]);
    }
}
