<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:data-all|data-create|data-edit|data-show|data-delete', ['only' => ['index']]);
    //     $this->middleware('permission:data-create|data-all', ['only' => ['create','store']]);
    //     $this->middleware('permission:data-show|data-all', ['only' => ['show']]);
    //     $this->middleware('permission:data-edit|data-all', ['only' => ['edit','update']]);
    //     $this->middleware('permission:data-delete|data-all', ['only' => ['destroy']]);
    // }

    public function index()
    {
        $permissions = Permission::with('roles')->orderBy('id','desc')->paginate(100);
		return view('backend.permissions.index',[
			'permissions'=>$permissions,
		]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('permissions')->where(function ($query) use ($request) {
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

        if (Permission::create($request->all())) {
            return redirect()->route('backend.permissions.index')->with('success','permission ' . __('msg.successfully created'));
        }

        return back()->with('error','error')->withInput();
    }

    public function edit($id)
    {
        $permission = Permission::findorFail($id);
        return view('backend.permissions.edit')->with([
			'permission'=>$permission,
		]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->where(function ($query) use ($request, $id) {
                    return $query->where('guard_name', $request->guard_name)
                        ->where('id', '!=', $id);
                }),
            ],
            'guard_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

        if (Permission::find($id)->update($request->all())) {
            return redirect()->route('backend.permissions.index')->with('success','permission ' . __('msg.successfully updated'));
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $SpatieModelsPermission = SpatieModelsPermission::find($id);
        foreach ($request->role_ids as $role_id) {
            $role = SpatieModelsRole::find($role_id);
            $SpatieModelsPermission->removeRole($role);
        }

        $permission = Permission::find($id);
        $permission->users()->detach();

        try {
            // DB::statement("SET foreign_key_checks=0");
            DB::table('permissions')->where('id', $id)->delete();
            // DB::table('model_has_permissions')->where('permission_id', $permission->id)->delete();
            // DB::statement("SET foreign_key_checks=1");
            return redirect()->back()->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting record: ' . $e->getMessage());
        }
        // Permission::findOrFail($id)->delete();
        return back()->with('success','permission ' . __('successfully deleted'));
    }
}



