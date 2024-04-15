<?php

namespace App\Services;

use App\Contracts\UserServiceContract as ContractsUserServiceContract;
use App\Helpers\ImageResize;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class UserService implements ContractsUserServiceContract
{
    public function index(Request $request)
    {
        $users = User::orderBy('id','desc')->paginate(50);
        return $users;
    }

    public function show(int $id) : User
    {
        return User::findOrFail($id);
    }

    public function store(array $data)
    {
        if (isset($data['userAvatar'])) {
            $userAvatar = $data['userAvatar'];
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

        return User::create($data);

    }

    public function update(array $data, int $id)
    {
        $user = User::findOrFail($id);
        if (isset($data['userAvatar'])) {
            $userAvatar = $data['userAvatar'];
            //papaka yaratilayapti
            $userAvatarPath = '/uploads/users/'.now()->format('Y/m/d');
            if (!Storage::exists($userAvatarPath)) {
                Storage::makeDirectory($userAvatarPath, 0755, true, true);
            }

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


            //eski fayllar o'chirilayapti
            // if (Storage::exists('images/file.jpg')) {
            // }
            Storage::delete($user->avatar['large'] ?? '');
            Storage::delete($user->avatar['medium'] ?? '');
            Storage::delete($user->avatar['small'] ?? '');

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

        return $user->update($data);
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        if($user->id == 1){
            return back()->with('warning',"super adminni o'chiraolmaysiz");
        }
        Storage::delete($user->avatar['large'] ?? '');
        Storage::delete($user->avatar['medium'] ?? '');
        Storage::delete($user->avatar['small'] ?? '');
        return $user->delete();
    }

}
