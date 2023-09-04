<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\technology\CreateTechnologyRequest;
use App\Http\Requests\technology\UpdateTechnologyRequest;

class TechnologyController extends Controller
{
    public function list()
    {
        $data['technologies'] = Technology::where('status', '1')->orderBy('name')->get();

        // return $data;
        return response()->json($data);
    }

    public function save(CreateTechnologyRequest $request)
    {
        $fields = $request->validated();

        DB::transaction(function () use ($fields) {
            Technology::create($fields);
        });

        session(['status' => 'Technology created']);
        $data['status'] = true;

        return response()->json($data);
    }

    public function show()
    {
        $validated = request()->validate([
            'technologyId' => ['required', 'integer', 'exists:technologies,id']
        ]);

        $res = Technology::find($validated['technologyId']);

        $data['status'] = true;
        $data['technology'] = $res;

        return response()->json($data);
    }

    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $fields = $request->validated();

        $technology = Technology::find($fields['id']);

        DB::transaction(function () use ($fields, $technology) {
            $technology->update($fields);
        });

        session(['status' => 'Technology updated']);
        $data['status'] = true;

        return response()->json($data);
    }

    public function delete(Technology $technology)
    {
        DB::transaction(function () use ($technology) {
            $technology->delete();
        });

        return to_route('setting')->with('status', 'Technology deleted');
    }
}
