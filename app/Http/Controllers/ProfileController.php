<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $data['title'] = 'Profile';
        $data['breadcrumbs'] = [
            [
                'name' => 'Profile',
                'active' => true
            ]
        ];

        $data['user'] = User::find(auth()->user()->id);
        $data['bloodGroupList'] = BloodGroup::where('status','1')->orderBy('name')->get();

        return view('profile.index', $data);
    }

    public function update(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $path = $image->store('user/profile', 'public');

            $validated['profile_image'] = $path;

            //delete prev profile
            $this->deleteImage($imgDisk = 'public', $imgPath = auth()->user()->profile);
        }

        DB::transaction(function () use ($user, $validated) {
            $user->update($validated);
        });

        return to_route('profile')->with('status', 'Profile Updated');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'currentPassword'     => 'required',
            'newPassword'     => 'required|min:7|max:10|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'required|same:newPassword',

        ]);

        $currentPassword = Auth::guard('web')->user()->password;
        $userId = Auth::guard('web')->user()->id;

        if (!Hash::check($request->currentPassword, $currentPassword)) {
            return redirect()->back()->with("error", "Old password does not match!");
        }

        DB::table('users')->whereId($userId)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return redirect()->back()->with('status', 'Password updated');
    }
}


// tests
// try to find another server/3rd party to host uploaded files