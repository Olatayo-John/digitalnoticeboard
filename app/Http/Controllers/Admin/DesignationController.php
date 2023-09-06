<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\designation\CreateDesignationRequest;
use App\Http\Requests\designation\UpdateDesignationRequest;

class DesignationController extends Controller
{

    public function save(CreateDesignationRequest $request)
    {
        $fields = $request->validated();

        DB::transaction(function () use ($fields) {
            Designation::create($fields);
        });

        session(['status'=>'Designation created']);
        $data['status']=true;

        return response()->json($data);
    }

    public function show()
    {
        $validated = request()->validate([
            'designationId' => ['required', 'integer', 'exists:designations,id']
        ]);

        $res = Designation::find($validated['designationId']);

        $data['status'] = true;
        $data['designation'] = $res;

        return response()->json($data);
    }

    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $fields = $request->validated();

        $designation= Designation::find($fields['id']);

        DB::transaction(function () use ($fields, $designation) {
            $designation->update($fields);
        });

        session(['status'=>'Designation updated']);
        $data['status'] = true;

        return response()->json($data);
    }

    public function delete(Designation $designation)
    {
        DB::transaction(function () use ($designation) {
            $designation->delete();
        });

        return to_route('setting')->with('status','Designation deleted');
    }
}
