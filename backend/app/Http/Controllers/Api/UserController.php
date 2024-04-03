<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService){}

    public function index(Request $request)
    {
        $users = UserResource::collection($this->userService->index($request));
        return sendResponse(message:'user list', data:$users);
    }

    public function show(int $id)
    {
        $user = $this->userService->show($id);
        return sendResponse(message:'user item', data:$user);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $this->userService->store($data);
        return sendResponse(code:201, message:'user created successfully');
    }

    public function destroy(int $id)
    {
        $this->userService->destroy($id);
        return sendResponse(code:204, message:'user deleted successfully');
    }

}
