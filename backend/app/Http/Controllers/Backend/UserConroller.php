<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageResize;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class UserConroller extends Controller
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

        return view('backend.users.create')->with([

		]);
    }

    public function store(UserRequest $request)
    {

        $data = $request->validated();

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

        if ($userAvatar = $request->file('userAvatar')) {

            $userAvatarPath = '/uploads/users/'.now()->format('Y/m/d');
            // $userAvatarPath = '/uploads/users/'.Str::random(10);
            if (!Storage::exists($userAvatarPath)) {
                Storage::makeDirectory($userAvatarPath, 0755, true, true);
                // File::makeDirectory($directory, 0755, true, true);
            }

            $userAvatarHashName = md5(Str::random(10).time()).'.'.$userAvatar->getClientOriginalExtension();
            $userAvatarLargeHashName =  $userAvatarPath.'/l_'.$userAvatarHashName;
            $userAvatarMeduimHashName = $userAvatarPath.'/m_'.$userAvatarHashName;
            $userAvatarSmallHashName = $userAvatarPath.'/s_'.$userAvatarHashName;

            // $path = Storage::putFileAs(
            //     $userAvatarPath,
            //     $userAvatar,
            //     $userAvatarHashName
            // );
            // $data['avatar'] = "/{$path}";

            $imageR = new ImageResize($userAvatar->getRealPath());
            $imageR->resizeToBestFit(150, 150)->save(Storage::path($userAvatarSmallHashName));
            $imageR->resizeToBestFit(500, 500)->save(Storage::path($userAvatarMeduimHashName));
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($userAvatarLargeHashName));

            $data['avatar'] = [
                'large' => $userAvatarLargeHashName,
                'medium' => $userAvatarSmallHashName,
                'small' => $userAvatarMeduimHashName,
                // 'large' => '/storage'.$userAvatarLargeHashName,
                // 'medium' => '/storage'.$userAvatarSmallHashName,
                // 'small' => '/storage'.$userAvatarMeduimHashName,
            ];
        }

        User::create($data);

        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function edit(User $user)
    {
        $user = User::with('user_permissions:id')->find($user->id);
        $roles = Role::with('permissions')->get();
        // dd($roles);
        $permissions = Permission::all();
        return view('backend.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
		]);
    }

    public function update(UserRequest $request, User $user)
    {

        $data = $request->validated();
        if ($userAvatar = $request->file('userAvatar')) {
            //papaka yaratilayapti
            $userAvatarPath = '/uploads/users/'.now()->format('Y/m/d');
            if (!Storage::exists($userAvatarPath)) {
                Storage::makeDirectory($userAvatarPath, 0755, true, true);
            }

            //eski fayllar o'chirilayapti
            Storage::delete($user->avatar['large']);
            Storage::delete($user->avatar['medium']);
            Storage::delete($user->avatar['small']);

            //fayl nomi va yo'li generatsiya qilinayapti
            $userAvatarHashName = md5(Str::random(10).time()).'.'.$userAvatar->getClientOriginalExtension();
            $userAvatarLargeHashName =  $userAvatarPath.'/l_'.$userAvatarHashName;
            $userAvatarMeduimHashName = $userAvatarPath.'/m_'.$userAvatarHashName;
            $userAvatarSmallHashName = $userAvatarPath.'/s_'.$userAvatarHashName;

            //rasm kesilib yuklanayapti
            $imageR = new ImageResize($userAvatar->getRealPath());
            $imageR->resizeToBestFit(150, 150)->save(Storage::path($userAvatarSmallHashName));
            $imageR->resizeToBestFit(500, 500)->save(Storage::path($userAvatarMeduimHashName));
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($userAvatarLargeHashName));

            //nomlari bazaga saqlanayapti
            $data['avatar'] = [
                'large' =>  $userAvatarLargeHashName,
                'medium' => $userAvatarSmallHashName,
                'small' =>  $userAvatarMeduimHashName,
            ];
        }

        if ($request->has('permission_ids')) {
            $permissions = SpatieModelsPermission::find($data['permission_ids']);
            $user->syncPermissions($permissions);
        }else{
            $user->syncPermissions([]);
        }

        if ($request->has('role_ids')) {
            $permissions = SpatieModelsRole::find($data['role_ids']);
            $user->syncRoles($permissions);
        }else{
            $user->syncRoles([]);
        }

        $user->update($data);

        return redirect()->route('backend.users.index')->with('success','successfully created');
    }

    public function destroy(User $user)
    {
        if($user->id == 1){
            return back()->with('warning',"super adminni o'chiraolmaysiz");
        }
        $user->delete();
        return redirect()->back()->with('success','user muvaffaqiyatli o\'chirildi');
    }

}













