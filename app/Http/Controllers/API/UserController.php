<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\BloodGroup;
use App\Models\Designation;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\users\CreatUserRequest;
use App\Http\Requests\users\UpdateUserRequest;
use App\Models\ReportingManager;

class UserController extends Controller
{
    use ImageTrait;

    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->get();
        // dd($users);

        if ($request->expectsJson()) {
            return $users;
        } else {
            return view('admin.users.index', ['title' => 'Users Management ', 'users' => $users]);
        }

        return new UserResource(User::findOrFail($id));
        return UserResource::collection(User::all());
    }

    public function create()
    {
        $data['title'] = 'Add User';
        $data['designationList'] = Designation::where('status','1')->orderBy('name')->get();
        $data['bloodGroupList'] = BloodGroup::where('status','1')->orderBy('name')->get();

        return view('admin.users.add', $data);
    }

    public function store(CreatUserRequest $request)
    {
        $fields = $request->validated();

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

        return to_route('users.index')->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        $data['title'] = 'View';
        $data['user'] = $user;

        return view('admin.users.view', $data);
    }

    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['title'] = 'Edit User';
        $data['designationList'] = Designation::where('status','1')->orderBy('name')->get();
        $data['bloodGroupList'] = BloodGroup::where('status','1')->orderBy('name')->get();

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

        return to_route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $userProfile = $user->profile_image;
        $userResume = $user->resume;

        DB::transaction(function () use ($user, $userProfile, $userResume) {
            $user->delete();

            $this->deleteImage($imgDisk = 'public', $imgPath = [$userProfile, $userResume], true);
        });

        return to_route('users.index')->with('success', 'User deleted successfully');
    }
}
