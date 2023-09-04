<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\project\CreateProjectRequest;
use App\Http\Requests\project\UpdateProjectRequest;
use App\Http\Requests\project\RemoveProjectMemberRequest;

class ProjectController extends Controller
{

    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = 'Project Management';
        $data['breadcrumbs'] = [
            [
                'name' => 'Projects',
                'active' => true
            ]
        ];

        $data['projectList'] = Project::filter(request(['status', 'priority', 'type', 'client_id']))->orderBy('name')->paginate('10');
        $data['clientList'] = Client::orderBy('name')->get();

        return view('admin.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Project';
        $data['breadcrumbs'] = [
            [
                'name' => 'Projects',
                'link' => route('project.index'),
                'active' => false
            ], [
                'name' => 'Create',
                'active' => true
            ]
        ];

        $data['clientList'] = Client::orderBy('name')->get();
        $data['userList'] = User::where('is_active', '1')->orderBy('name')->get();

        return view('admin.project.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $fields = $request->validated();

        DB::transaction(function () use ($fields) {
            $project = Project::create($fields);

            $project->members()->sync($fields['members']);
        });

        return to_route('project.index')->with('status', 'Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $data['title'] = 'View Project';
        $data['breadcrumbs'] = [
            [
                'name' => 'Projects',
                'link' => route('project.index'),
                'active' => false
            ], [
                'name' => 'View',
                'active' => true
            ]
        ];

        $data['project'] = $project->load('tasks');

        return view('admin.project.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $data['title'] = 'Edit Project';
        $data['breadcrumbs'] = [
            [
                'name' => 'Projects',
                'link' => route('project.index'),
                'active' => false
            ], [
                'name' => 'Edit',
                'active' => true
            ]
        ];

        $data['project'] = $project;
        $data['clientList'] = Client::orderBy('name')->get();
        $data['userList'] = User::where('is_active', '1')->orderBy('name')->get();

        return view('admin.project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $fields = $request->validated();

        DB::transaction(function () use ($fields, $project) {
            $project->update($fields);

            $project->members()->sync($fields['members']);
        });

        return to_route('project.index')->with('status', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //fetch all task images relating to project
        $projectTasks = $project->load('tasks');
        $taskImages = $projectTasks['tasks']->pluck('file')->toArray();

        $TaskImagesArr = array();
        foreach ($taskImages as $key => $value) {
            if ($value) {
                $imgPerTask = explode(',', $value);
                array_push($TaskImagesArr, $imgPerTask);
            }
        }

        $allTaskImagesArr = Arr::collapse($TaskImagesArr); //collapse into single array

        DB::transaction(function () use ($project, $allTaskImagesArr) {
            //deletes project and its task
            $project->delete();

            //deletes task images from our storage
            $this->deleteImage($imgDisk = 'public', $imgPath = $allTaskImagesArr, $isArray = true);
        });

        return to_route('project.index')->with('status', 'Project deleted');
    }

    public function removeMember(RemoveProjectMemberRequest $request)
    {
        $fields = $request->validated();

        $project = Project::find($fields['project_id']);

        DB::transaction(function () use ($fields, $project) {
            $project->members()->detach($fields['member_id']);
        });

        return back()->with('status', 'Member removed');
    }
}
