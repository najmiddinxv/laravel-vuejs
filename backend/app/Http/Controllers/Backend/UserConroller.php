<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\DB;

class UserConroller extends Controller
{
    public function __construct(private UserServiceContract $userService) {}

    public function index()
    {
        $users = $this->userService->index();
        return view('backend.users.index',[
			'users' => $users,
		]);
    }

    public function show(User $user)
    {
        return view('backend.users.show',[
			'user' => $user,
		]);
    }

    public function create()
    {
        return view('backend.users.create')->with([]);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $this->userService->store($data);
        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function edit(User $user)
    {
        $user = User::with('user_permissions:id','user_roles:id')->find($user->id);

        if (!empty($user->user_roles)) {
            $user_role_ids = [];

            foreach ($user->user_roles as $user_role) {
                $user_role_ids[] = $user_role->id;
            }

            $user_role_has_permissions = DB::table('role_has_permissions')->whereIn('role_id', $user_role_ids)->get();
        }

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('backend.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'user_role_has_permissions' => $user_role_has_permissions ?? [],
		]);
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $this->userService->update($data,$id);
        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function destroy($id)
    {
        $this->userService->destroy($id);
        return redirect()->back()->with('success','user muvaffaqiyatli o\'chirildi');
    }

}













