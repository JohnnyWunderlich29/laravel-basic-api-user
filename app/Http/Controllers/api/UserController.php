<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function __construct(
        protected User $repository,
    ){
    
    }


    public function index()
    {
        $users = $this->repository->paginate();

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);


        $user = $this->repository->create($data);

        return new UserResource($user);
    }

    public function show(string $id)
    {
        $user = $this->repository->where('id', $id)->firstOrFail();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, string $id)
    {

        $user = $this->repository->where('id', $id)->firstOrFail();
        $data = $request->validated();


        if (isset($data['password']))
        {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $this->repository->where('id', $id)->firstOrFail()->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
