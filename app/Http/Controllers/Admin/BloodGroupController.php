<?php

namespace App\Http\Controllers\Admin;

use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\bloodGroup\CreateBloodGroupRequest;
use App\Http\Requests\bloodGroup\UpdateBloodGroupRequest;

class BloodGroupController extends Controller
{
    
    public function save(CreateBloodGroupRequest $request){
        $fields= $request->validated();

        DB::transaction(function () use($fields) {
            BloodGroup::create($fields);
        });

        session(['status'=>'Blood Group created']);
        $data['status']=true;

        return response()->json($data);
    }

    public function show(){
        $validated= request()->validate([
            'bloodGroupId'=>['required','integer','exists:blood_groups,id']
        ]);

        $res= BloodGroup::find($validated['bloodGroupId']);

        $data['status']=true;
        $data['bloodGroup']=$res;

        return response()->json($data);
    }

    public function update(UpdateBloodGroupRequest $request){
        $fields= $request->validated();

        $blood_group= BloodGroup::find($fields['id']);

        DB::transaction(function () use($fields,$blood_group) {
            $blood_group->update($fields);
        });

        session(['status'=>'Blood Group updated']);
        $data['status']=true;

        return response()->json($data);

    }

    public function delete(BloodGroup $blood_group){
        DB::transaction(function () use($blood_group) {
            $blood_group->delete();
        });

        return to_route('setting')->with('status','Blood Group deleted');
    }
}
