<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\User\Role;
use App\Models\User\User;
use App\Models\User\Permission;
use App\Http\Requests\Web\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class UserConroller extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $users = User::where('id','!=',auth()->user()->id)->orderBy('id','desc')->paginate(50);
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

        if (isset($data['userAvatar'])) {
            $data['avatar'] = $this->fileUploadService->resizeImageUpload($data['userAvatar'], '/uploads/users/'.now()->format('Y/m/d'));
        }
        // $data['avatar'] = $data['userAvatar'] ? $this->fileUploadService->resizeImageAndUpload($data['userAvatar'], '/uploads/users') : null;

        User::create($data);

        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function edit(User $user)
    {
        $user = User::with('user_permissions:id','user_roles:id')->find($user->id);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        //userga berilgan role orqali rolega berilgan permissinlarni aniqlashitirsh uchun ishlatilayapti bu
        //yashil ranga bo'yab alohida ajratib ko'rsatish uchun
        if (!empty($user->user_roles)) {
            $user_role_ids = [];

            foreach ($user->user_roles as $user_role) {
                $user_role_ids[] = $user_role->id;
            }

            $user_role_has_permissions = DB::table('role_has_permissions')->whereIn('role_id', $user_role_ids)->get();
        }

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
        $user = User::findOrFail($id);

        if (isset($data['userAvatar'])) {
            $this->fileUploadService->resizedImageDelete($user->avatar);
            $data['avatar'] = $this->fileUploadService->resizeImageUpload($data['userAvatar'], '/uploads/users/'.now()->format('Y/m/d'));
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if (isset($data['permission_ids'])) {
            $permissions = SpatieModelsPermission::find($data['permission_ids']);
            $user->syncPermissions($permissions);
        }else{
            $user->syncPermissions([]);
        }

        if (isset($data['role_ids'])) {
            $permissions = SpatieModelsRole::find($data['role_ids']);
            $user->syncRoles($permissions);
        }else{
            $user->syncRoles([]);
        }

        $user->update($data);
        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->id == 1){
            return back()->with('warning',"super adminni o'chiraolmaysiz");
        }
        Storage::delete($user->avatar['large'] ?? '');
        Storage::delete($user->avatar['medium'] ?? '');
        Storage::delete($user->avatar['small'] ?? '');
        $user->delete();
        return redirect()->back()->with('success','user muvaffaqiyatli o\'chirildi');
    }

}







// https://laraveldaily.com/post/laravel-file-uploads-save-filename-database-folder-url
//  if ($request->hasFile('avatar')) {
//     $avatar = $request->file('avatar')->store(options: 'avatars');
// }

// $user = User::create([
//     'name' => $request->name,
//     'email' => $request->email,
//     'password' => Hash::make($request->password),
//     'avatar' => $avatar ?? null,  //"avatars/OkWAukq8LBMBO7LXvaP7TS9jE7mT4Rbu3BYlbvCD.jpg"
// // ]);
// <img src="{{ Storage::disk('avatars')->url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" />
// <img src="{{ Storage::disk('s3')->temporaryUrl(Auth::user()->avatar, now()->addMinutes(5)) }}" alt="{{ Auth::user()->name }}" />
// config/filesystems.php:
//        'disks' =>
//     // ...
//     'avatars' => [
//         'driver' => 'local',
//         'root' => storage_path('app/public/avatars'),
//         'url' => env('APP_URL').'/storage/avatars',
//         'visibility' => 'public',
//         'throw' => false,
//     ],
// ],







