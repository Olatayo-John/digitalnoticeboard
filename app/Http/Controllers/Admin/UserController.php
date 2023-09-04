<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\BloodGroup;
use App\Models\Technology;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\users\CreatUserRequest;
use App\Http\Requests\users\UpdateUserRequest;
use App\Http\Requests\users\UpdateUserTechnologyRequest;

class UserController extends Controller
{
    use ImageTrait;

    public function index(Request $request)
    {
        // $users = User::orderByRaw('CAST(id AS UNSIGNED)')->get();
        // return $users = User::filter(request(['is_active','designation','reporting_manager']))->orderBy('id')->toSql();

        $users = User::filter(request(['reporting_manager', 'designation', 'is_active']))->orderBy('id')->get();
        $userList = User::orderBy('name')->get();
        $technologies = Technology::where('status', '1')->orderBy('name')->get();
        $designations = Designation::where('status', '1')->orderBy('name')->get();

        if ($request->expectsJson()) {
            return $users;
        } else {
            $data['title'] = 'Users Management';
            $data['breadcrumbs'] = [
                [
                    'name' => 'Users',
                    'active' => true
                ]
            ];

            $data['users'] = $users;
            $data['technologyList'] = $technologies;
            $data['designationList'] = $designations;
            $data['userList'] = $userList;

            return view('admin.users.index', $data);
        }
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['breadcrumbs'] = [
            [
                'name' => 'Users',
                'link' => route('users.index'),
                'active' => false
            ], [
                'name' => 'Create',
                'active' => true
            ]
        ];

        $data['designationList'] = Designation::where('status', '1')->orderBy('name')->get();
        $data['bloodGroupList'] = BloodGroup::where('status', '1')->orderBy('name')->get();
        $data['userList'] = User::orderBy('name')->get();

        return view('admin.users.add', $data);
    }

    public function store(CreatUserRequest $request)
    {
        $fields = $request->validated();
        // dd($fields);

        //profile
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $path = $img->store('user/profile', 'public');

            $fields['profile_image'] = $path;
        }

        //resume
        if ($request->hasFile('resume')) {
            $img = $request->file('resume');
            $path = $img->store('user/resume', 'public');

            $fields['resume'] = $path;
        }

        // $fields['user_type'] = 3;

        DB::transaction(function () use ($fields) {
            User::create($fields);
        });

        return to_route('users.index')->with('status', 'User created');
    }

    public function show(User $user)
    {
        $data['title'] = 'View';
        $data['breadcrumbs'] = [
            [
                'name' => 'Users',
                'link' => route('users.index'),
                'active' => false
            ], [
                'name' => 'View',
                'active' => true
            ]
        ];

        $data['user'] = $user->load('technologies', 'projects', 'tasks');

        return view('admin.users.view', $data);
    }

    public function edit(User $user)
    {
        $data['title'] = 'Edit User';
        $data['breadcrumbs'] = [
            [
                'name' => 'Users',
                'link' => route('users.index'),
                'active' => false
            ], [
                'name' => 'Edit',
                'active' => true
            ]
        ];

        $data['user'] = $user;
        $data['designationList'] = Designation::where('status', '1')->orderBy('name')->get();
        $data['bloodGroupList'] = BloodGroup::where('status', '1')->orderBy('name')->get();
        $data['userList'] = User::where('id', '!=', $user->id)->orderBy('name')->get();

        // $roles = Role::pluck('name', 'name')->all();
        // $userRole = $user->roles->pluck('name', 'name')->all();
        // return view('admin.users.edit', compact('user', 'roles', 'userRole'));

        return view('admin.users.edit', $data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $updateFields = $request->validated();

        //profile
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $path = $img->store('user/profile', 'public');

            $updateFields['profile_image'] = $path;

            $userProfile = $user->profile_image;
            $this->deleteImage($imgDisk = 'public', $imgPath = $userProfile,);
        }

        //resume
        if ($request->hasFile('resume')) {
            $img = $request->file('resume');
            $path = $img->store('user/resume', 'public');

            $updateFields['resume'] = $path;

            $userResume = $user->resume;
            $this->deleteImage($imgDisk = 'public', $imgPath = $userResume);
        }


        DB::transaction(function () use ($user, $updateFields) {
            $user->update($updateFields);
        });

        return to_route('users.index')->with('status', 'User updated');
    }

    public function destroy(User $user)
    {
        $userProfile = $user->profile_image;
        $userResume = $user->resume;

        DB::transaction(function () use ($user, $userProfile, $userResume) {
            $user->delete();

            $this->deleteImage($imgDisk = 'public', $imgPath = [$userProfile, $userResume], true);
        });

        return to_route('users.index')->with('status', 'User deleted');
    }

    public function get_user_technologies()
    {
        $validated = request()->validate([
            'userId' => ['required', 'string', 'exists:users,id']
        ]);

        $user = User::find($validated['userId']);

        $data['status'] = true;
        $data['user'] = $user->load('technologies');
        $data['technologies'] = Technology::where('status', '1')->orderBy('name')->get();

        return response()->json($data);
    }

    public function update_user_technologies(UpdateUserTechnologyRequest $request)
    {
        $validated = $request->validated();
        $user = User::find($validated['user_id']);

        $user->technologies()->detach();

        foreach ($validated['technology_id'] as $key => $value) {
            $user->technologies()->attach([
                $validated['technology_id'][$key] => [
                    'experience' => $validated['experience'][$key]
                ]
            ]);
        }

        // session(['status' => 'User technology updated']);
        $data['status'] = true;
        $data['msg'] = 'User technology updated';

        return response()->json($data);
    }
}
