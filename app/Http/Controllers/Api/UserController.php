<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request,)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->checkUserAuthorization($user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->checkUserAuthorization($user);

        $validated = $request->validated();

        $user->update($validated);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->checkUserAuthorization($user);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted.',
        ], 200);
    }

    public function checkUserAuthorization($user)
    {
        if (!$user) {
            throw new HttpResponseException(
                response()->json(['error' => 'User doest not exist'])
            );
        }
        if (Auth::user()->id !== $user->id) {;
            throw new HttpResponseException(
                response()->json(['error' => 'Unauthorized'])
            );
        }
    }
}
