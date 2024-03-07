<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\Contracts\PostServiceContract;
use App\Services\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
    public function index($request)
    {
        return User::all();
    }


    //     // pick a permission name
    //     // $permission_name = $request->get('permission');
    //     // // lookup all defined permissions, regardless of guard
    //     // $permissions = app(PermissionRegistrar::class)->getPermissions()
    //     // // filter down to just those matching the specified name
    //     //     ->filter(function ($permission) use ($permission_name) {
    //     //         return $permission->name === $permission_name;
    //     //     });
    //     // grant those specific permissions to the user
    //     // $model->givePermissionTo($permissions);
    //     // app()[PermissionRegistrar::class]->forgetCachedPermissions();

    //     // foreach($request->get('permission') as $p){
    //     //     $model->givePermissionTo($p);
    //     // }
    //     // $perm = new ModelHasPermission();
    //     if(!empty($request->get('permission'))){
    //         foreach ($request->get('permission') as $permItem) {
    //         // $perm->permission_id =  $permItem;
    //         // $perm->model_type = 'App\Models\User';
    //         // $perm->model_id =  $model->id;
    //         // $perm->save();
    //         $model->givePermissionTo($permItem);
    //         }
    //     }
    //     if(!empty($request->get('role'))){
    //         $role = $request->get('role');
    //         $model->assignRole([$role]);

    //     }

    //     // $permission = $request->get('permission');
    //     // $model->givePermissionTo([$permission]);




    //     if($model->save()){
    //         return redirect()->route('user.index')->with('success','user muvaffaqiyatli yaratildi');
    //     }

    //    return redirect()->route('user.create')->withInput();

    // }

    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $model = User::findOrFail($id);

    //     $roles = Role::pluck('name','name')->all();
    //     $permissions = Permission::all();
    //     // $user_permission = $model->permissions->pluck('name','name')->all();
    //     $user_role = $model->roles->pluck('name','name')->all();
    //     $user_permission = $model->permissions->all();
    //     // $user_type = UserType::all();
    //     // print_r($user_permission);die;
    //     // print_r($model->roles->pluck('name','name'));die;

    //     return view('backend.user.edit')->with([
    // 	    // 'user_type'=>$user_type,
    //         'model'=>$model,
    //     	'roles'=>$roles,
    //     	'permissions'=>$permissions,
    //     	'user_role'=>$user_role,
    //     	'user_permission'=>$user_permission,
    //     ]);

    // }

    // public function update(Request $request, $id)
    // {
    //     // print_r( implode(',', $request->get('permission')));die;

    //     $model = User::findOrFail($id);
    //     $validator = Validator::make($request->all(),[
    //         'name' =>  ['required', 'string','max:150'],
    //         'email' => ['required', 'string','max:150'],
    //         'user_type' =>  ['required'],
    //         'current_password' => ['nullable', 'string', 'min:8','max:100'],
    //         // 'password' => ['nullable', 'string', 'min:8','max:40', 'confirmed'],
    //         'password' => ['nullable', 'string', 'min:8','max:40'],
    //         'password_confirmation' => ['nullable', 'string', 'min:8','max:40', 'same:password'],
    //         'permission_id.*' =>  'array',
    //         'role_id.*' =>  'array',
    //     ]);

    //     if ($validator->fails()) {
	// 		return redirect()->route('user.edit',$id)->withErrors($validator)->withInput();
	// 	}

    //     $model->name = $request->input('name');
    //     $model->email = $request->input('email');
    //     $model->user_type = $request->get('user_type');

    //     if (!empty($request->get('role')) || !empty($request->get('permission'))) {
    //         DB::table('model_has_roles')->where(['model_id'=>$id])->delete();
    //         DB::table('model_has_permissions')->where(['model_id'=>$id])->delete();

    //         foreach ($request->get('permission') as $permItem) {

    //             $model->givePermissionTo($permItem);
    //         }

    //         // $model->givePermissionTo($request->get('permission'));
    //         $model->assignRole($request->get('role'));


    //     }


    //     if(!empty($request->input('current_password'))) {
    //         if(!FacadesHash::check($request->input('current_password'), $model->password)){
    //             return back()->with('current_password', 'Current password does not match!');
    //         }else{
    //             $model->fill(['password' => FacadesHash::make($request->input('password'))])->save();
    //         }
    //     }

    //    if ($model->update()) {
    //         return redirect()->route('user.index')->with('success','user muvaffaqiyatli tahrirlandi');
    //    }

    //    return redirect()->route('user.edit',$id)->withInput();

    // }



    // if (!empty($request->image)) {
    //     Storage::delete('forum/' . $forum->id . '/' . $forum->image);
    //     $file = $request->image;
    //     $fileName = sha1($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
    //     $file->storeAs('forum/' . $forum->id, $fileName);

    //     $imageR = new ImageResize(Storage::path('forum/' . $forum->id . '/' . $fileName));
    //     $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.height'))
    //     ->save(Storage::path("forum/{$forum->id}/l_{$fileName}"));
    //     $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.height'))
    //     ->save(Storage::path("forum/{$forum->id}/m_{$fileName}"));
    //     $imageR->resizeToBestFit(config('params.small_image.width'), config('params.small_image.height'))
    //     ->save(Storage::path("forum/{$forum->id}/s_{$fileName}"));
    //     Storage::delete('forum/' . $forum->id . '/' . $fileName);

    //     $forum->image = $fileName;
    //     $forum->save();
    // }
}
