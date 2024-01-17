<?php

namespace App\Http\Controllers\Backend;

use App\CustomClasses\ImageResize;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\BankBranch;
use App\Models\Permission;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Svg\Tag\Rect;
use Spatie\Permission\Models\Permission as SpatieModelsPermission;
use Spatie\Permission\Models\Role as SpatieModelsRole;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'select2_filter_bank_branch_id' => 'nullable|integer',
            'select2_filter_role_id' => 'nullable|integer',
            'first_name_search' => 'nullable|string|max:255',
            'last_name_search' => 'nullable|string|max:255',
            'middle_name_search' => 'nullable|string|max:255',
            'sex' => 'nullable|integer',
            'birth_date_start' => 'nullable|date',
            'birth_date_end' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bank_branch_id = $request->select2_filter_bank_branch_id;
        $role_id = $request->select2_filter_role_id;
        $sex = $request->sex;
        $first_name = $request->first_name_search;
        $last_name = $request->last_name_search;
        $middle_name = $request->middle_name_search;

        $startDate = $request->birth_date_start;
        $endDate = $request->birth_date_end;



        $usersQuery = User::query();

        if (!is_null($bank_branch_id)) {
            $usersQuery->where('bank_branch_id', $bank_branch_id);
        }

        if (!is_null($role_id)) {
            $usersQuery->where('role_id', $role_id);
        }

        if (!is_null($sex)) {
            $usersQuery->where('sex', $sex);
        }

        if (!is_null($first_name)) {
            $usersQuery->where('first_name', 'like', '%' . $first_name . '%');

        }

        if (!is_null($last_name)) {
            $usersQuery->where('last_name', 'like', '%' . $last_name . '%');
        }

        if (!is_null($middle_name)) {
            $usersQuery->where('middle_name', 'like', '%' . $middle_name . '%');
        }

        if (!is_null($startDate) && !is_null($endDate)) {
            $usersQuery->whereBetween('birth_date', [$startDate, $endDate]);
        }

        if (!is_null($startDate) && is_null($endDate)) {
            $usersQuery->where('birth_date', $startDate);
        }

        if (!is_null($endDate) && is_null($startDate)) {
            $usersQuery->where('birth_date', $endDate);
        }

        $users = $usersQuery->where('id', '!=', auth()->user()->id)->with('role', 'bank_branch')->orderBy('id', 'desc')->paginate(50);
        $usersCount = $users->total();

        $bank_branches = BankBranch::all();

        $roles = Role::all();

        return view('backend.user.index', [
            'users' => $users,
            'bank_branches' => $bank_branches,
            'roles' => $roles,
            'positions' => Position::all(),
            'usersCount' => $usersCount,
            'usersCountByBranch' => $usersCountByBranch ?? [],
        ]);
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request)
    {

        $data = $request->validated();

        $last_name = to_latin($data['last_name']);
        $first_name = to_latin($data['first_name']);

        $data['uuid'] = Str::uuid()->toString();
        $data['username'] = $last_name[0] . '.' . $first_name;
        $data['password'] = bcrypt($data['password']);
        $data['is_active'] = 0;

        $count = 1;
        while (User::where('username', $data['username'])->exists()) {
            $data['username'] = $last_name[0] . '.' . $first_name . $count;
            $count++;
        }

        // $model = User::create($data);

        // if($request->has('file')){
        //     /* ---- documentning nomi olinib hashlanib bazaga yozishgaa tayyorlanaypti --- */
        //     $fileName = sha1($request->file?->getClientOriginalName() . time()) . '.' . $request->file->getClientOriginalExtension();
        //     $data['file'] = $fileName;

        //     /* -------------------------- document saqlanaypti -------------------------- */
        //     $request->file->storeAs('user/' . $model->uuid, $fileName);
        // }

        // if($request->has('avatar')){
        //   /* ---- avatartning nomi olinib hashlanib bazaga yozishgaa tayyorlanaypti --- */
        //     $AvatarName = sha1($request->avatar->getClientOriginalName() . time()) . '.' . $request->avatar->getClientOriginalExtension();
        //     $data['avatar'] = $AvatarName;

        //     // dd($model->uuid);
        //     /* ----------------------- avatar saqlanib kesilyapti ----------------------- */
        //     $request->avatar?->storeAs('user/' . $model->uuid, $AvatarName);

        //     $imageR = new ImageResize(Storage::path('user/' . $model->uuid . '/' . $AvatarName));
        //     $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.height'))
        //         ->save(Storage::path("user/{$model->uuid}/l_{$AvatarName}"));
        //     $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.height'))
        //         ->save(Storage::path("user/{$model->uuid}/m_{$AvatarName}"));
        //     $imageR->resizeToBestFit(config('params.small_image.width'), config('params.small_image.height'))
        //         ->save(Storage::path("user/{$model->uuid}/s_{$AvatarName}"));
        //     /* ----------------------- avatar saqlanib kesilyapti tugadi ----------------------- */
        //     Storage::delete('user/' . $model->uuid . '/' . $AvatarName);

        // }

        // $model->update($data);

        /* ---- documentning nomi olinib hashlanib bazaga yozishgaa tayyorlanaypti --- */
        if ($request->has('file')) {
            $fileName = sha1($request->file->getClientOriginalName() . time()) . '.' . $request->file->getClientOriginalExtension();
            $data['file'] = $fileName;
        }
        /* ---- avatartning nomi olinib hashlanib bazaga yozishgaa tayyorlanaypti --- */
        if ($request->has('avatar')) {
            $AvatarName = sha1($request->avatar->getClientOriginalName() . time()) . '.' . $request->avatar->getClientOriginalExtension();
            $data['avatar'] = $AvatarName;
        }
        $model = User::create($data);
        /* -------------------------- document saqlanaypti -------------------------- */
        if ($request->has('file')) {
            $request->file->storeAs('user/' . $model->uuid, $fileName);
        }
        /* ----------------------- avatar saqlanib kesilyapti ----------------------- */
        if ($request->has('avatar')) {
            $request->avatar->storeAs('user/' . $model->uuid, $AvatarName);

            $imageR = new ImageResize(Storage::path('user/' . $model->uuid . '/' . $AvatarName));
            $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.height'))
                ->save(Storage::path("user/{$model->uuid}/l_{$AvatarName}"));
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.height'))
                ->save(Storage::path("user/{$model->uuid}/m_{$AvatarName}"));
            $imageR->resizeToBestFit(config('params.small_image.width'), config('params.small_image.height'))
                ->save(Storage::path("user/{$model->uuid}/s_{$AvatarName}"));
            /* ----------------------- avatar saqlanib kesilyapti tugadi ----------------------- */
            Storage::delete('user/' . $model->uuid . '/' . $AvatarName);
        }

        return back()->with('success', __('locale.successfully_created'));
    }

    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        // $user_test_enrollment = User::with(['test_enrollment' => function ($query) {
        //     // $query->orderBy('id', 'desc');
        // }])->find($user->uuid)->test_enrollment()->orderBy('id', 'desc')->paginate(50);

        return view('backend.user.show', [
            // 'user_test_enrollment' => $user_test_enrollment,
            'user' => $user,
        ]);
    }

    public function showActionLogs(Request $request, $uuid)
    {

        $user = User::where('uuid', $uuid)->first();
        $action_logs = $user->action_logs()->paginate(100);
        return view('backend.user.show-action-logs', [
            'user' => $user,
            'action_logs' => $action_logs,
        ]);
    }

    public function showCompletedCourse(Request $request, $uuid)
    {
        // $completed_course = $user->completed_course()->paginate(50);

        $user = User::where('uuid', $uuid)->first();

        $completed_course = User::with(['completed_course' => function ($query) {
            // $query->orderBy('id', 'desc');
        }])->find($user->id)->completed_course()->orderBy('id', 'desc')->paginate(50);

        return view('backend.user.show-completed-course', [
            'user' => $user,
            'completed_course' => $completed_course,
        ]);
    }

    public function showCompletedTest(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $user_test_enrollment = User::with(['test_enrollment' => function ($query) {
            // $query->orderBy('id', 'desc');
        }])->find($user->id)->test_enrollment()->orderBy('id', 'desc')->paginate(50);

        return view('backend.user.show-completed-test', [
            'user_test_enrollment' => $user_test_enrollment,
            'user' => $user,
        ]);
    }

    public function edit($uuid)
    {
        $user = User::with('user_permissions:id')->where('uuid', $uuid)->first();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.user.edit', [
            'user' => $user,
            'bank_branches' => BankBranch::all(),
            'roles' => Role::all(),
            'positions' => Position::all(),
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function update(UserRequest $request, $uuid)
    {
        $data = $request->validated();

        $user = User::where('uuid', $uuid)->first();

        if ($user->first_name != $data['first_name'] || $user->last_name != $data['last_name'] || $user->middle_name != $data['middle_name']) {

            $last_name = to_latin($data['last_name']);
            $first_name = to_latin($data['first_name']);

            $data['username'] = $last_name[0] . '.' . $first_name;
            $count = 1;

            // dd($data);

            while (User::where('username', $data['username'])->exists()) {
                $data['username'] = $last_name[0] . '.' . $first_name . $count;
                $count++;
            }
        }


        if ($user->password != $data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        if ($request->hasFile('file')) {
            Storage::delete('user/' . $user->id . '/' . $user->file);
            $fileName = sha1($request->file->getClientOriginalName() . time()) . '.' . $request->file->getClientOriginalExtension();
            $data['file'] = $fileName;
            $request->file->storeAs('user/' . $user->id, $fileName);
        }

        if ($request->hasFile('avatar')) {
            Storage::delete('user/' . $user->id . '/l_' . $user->avatar);
            Storage::delete('user/' . $user->id . '/m_' . $user->avatar);
            Storage::delete('user/' . $user->id . '/s_' . $user->avatar);

            $AvatarName = sha1($request->avatar->getClientOriginalName() . time()) . '.' . $request->avatar->getClientOriginalExtension();
            $data['avatar'] = $AvatarName;
            $request->avatar->storeAs('user/' . $user->id, $AvatarName);

            $imageR = new ImageResize(Storage::path('user/' . $user->id . '/' . $AvatarName));
            $imageR->resizeToBestFit(config('params.large_image.width'), config('params.large_image.height'))
                ->save(Storage::path("user/{$user->id}/l_{$AvatarName}"));
            $imageR->resizeToBestFit(config('params.medium_image.width'), config('params.medium_image.height'))
                ->save(Storage::path("user/{$user->id}/m_{$AvatarName}"));
            $imageR->resizeToBestFit(config('params.small_image.width'), config('params.small_image.height'))
                ->save(Storage::path("user/{$user->id}/s_{$AvatarName}"));

            Storage::delete('user/' . $user->id . '/' . $AvatarName);
        }

        $user->update($data);

        //userga permissionlar berilayapti

        // $permissions = Permission::select('name')->find($data['permission_ids'])->toArray();
        // $permissions = SpatieModelsPermission::find($data['permission_ids'])->pluck('name')->toArray();

        // $permissions = Permission::whereIn('id', $data['permission_ids'])->get();
        // $permissions = Permission::pluck('id', 'id')->all();
        // dd($permissions);

        if ($request->has('permission_ids')) {
            $permissions = SpatieModelsPermission::find($data['permission_ids']);
            $user->syncPermissions($permissions);
        }
        if ($request->has('role_ids')) {
            $permissions = SpatieModelsRole::find($data['role_ids']);
            $user->syncRoles($permissions);
        }


        return redirect()->route('admin.user.index')->with('success', __('locale.successfully_updated'));
    }

    public function destroy($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        if (!(auth()->user()->id == $user->id)) {
            $user->delete();
        }
        return back()->with('success', __('locale.successfully_deleted'));
    }
}
