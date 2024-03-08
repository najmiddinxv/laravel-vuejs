<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions:id')->orderBy('id','desc')->paginate(50);
		return view('backend.roles.index',[
			'roles'=>$roles,
		]);
    }

    public function create()
    {
        return view('backend.roles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('roles')->where(function ($query) use ($request) {
                    return $query->where('guard_name', $request->guard_name);
                                // ->where('name', $request->name);
                }),
                'string',
                'max:255',
            ],
            'guard_name' => 'required|string|max:255',
		]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        if (Role::create($request->all())) {
            return redirect()->route('backend.roles.index')->with('success','role ' . __('msg.successfully created'));
        }

        return back()->with('error','error')->withInput();
    }

    public function edit($id)
    {
        $role = Role::findorFail($id);
        $permissions = Permission::all();
        return view('backend.roles.edit')->with([
			'role'=>$role,
			'permissions'=>$permissions,
		]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->where(function ($query) use ($request, $id) {
                    return $query->where('guard_name', $request->guard_name)
                        ->where('id', '!=', $id);
                }),
            ],
            'guard_name' => 'required|string|max:255',
			'permission_id' => ['required','array'],
        ]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        $model = Role::findorFail($id);

        $role = SpatieModelsRole::find($id);
        $permission = SpatieModelsPermission::find($request->permission_id);

        if ($model->update($request->all())) {
            $role->syncPermissions($permission);
            return redirect()->route('backend.roles.index')->with('success','role ' . __('msg.successfully updated'));
        }

        return back()->with('error','error')->withInput();
    }

    public function destroy(Request $request, $id)
    {

        $SpatieModelsRole = SpatieModelsRole::find($id);
        if ($request->has('permission_ids')) {
            foreach ($request->permission_ids as $permission_id) {
                $permission = SpatieModelsPermission::find($permission_id);
                $SpatieModelsRole->revokePermissionTo($permission);
            }
        }

        $role = Role::find($id);
        $role->permissions()->detach();

        try {
            DB::table('roles')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting record: ' . $e->getMessage());
        }
        return back()->with('success','role ' . __('successfully deleted'));
    }
}
