<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Setting;
use App\Models\BloodGroup;
use App\Models\ClientType;
use App\Models\Technology;
use App\Models\Designation;
use Illuminate\Support\Arr;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\setting\UpdateSmtpSettingRequest;
use App\Http\Requests\setting\UpdateGeneralSettingRequest;

class SettingController extends Controller
{
    use ImageTrait;
    
    public function index()
    {
        $data['title'] = 'Settings';
        $data['breadcrumbs'] = [
            [
                'name' => 'Settings',
                'active' => true
            ]
        ];

        $data['bloodGroupList'] = BloodGroup::orderBy('name')->get();
        $data['designationList'] = Designation::orderBy('name')->get();
        $data['technologyList'] = Technology::orderBy('name')->get();
        // $data['userList'] = User::where('is_active','1')->orderBy('name')->get();

        $settings = Setting::all();
        $data['keyedSettings'] = Arr::keyBy($settings, 'meta_key');

        return view('admin.setting.index', $data);
    }

    public function update($fields)
    {
        DB::transaction(function () use ($fields) {
            foreach ($fields as $key => $value) {
                Setting::where('meta_key', '=', $key)->update([
                    'meta_value' => $value
                ]);
            }
        });

        return true;
    }

    public function generalUpdate(UpdateGeneralSettingRequest $request)
    {
        $validated = $request->validated();

        //setting logo
        if ($request->hasFile('site_logo')) {
            $siteLogo = $request->file('site_logo');
            $path = $siteLogo->store('settings', 'public');

            $validated['site_logo'] = $path;

            //delete prev logo
            $globalSettings = view()->shared('globalSettings');
            $siteLogo = $globalSettings['site_logo']['meta_value'];
            $this->deleteImage($imgDisk = 'public', $imgPath = $siteLogo);
        }

        $this->update($validated);
        return back()->with('status', 'General Settings updated');
    }

    public function smtpUpdate(UpdateSmtpSettingRequest $request)
    {
        $validated = $request->validated();

        $this->update($validated);
        return back()->with('status', 'SMTP Settings updated');
    }
}
