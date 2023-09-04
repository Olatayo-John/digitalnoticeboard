<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\task\CreateTaskRequest;
use App\Http\Requests\task\UpdateTaskRequest;
use App\Http\Requests\task\RemoveTaskImageRequest;

class TaskController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Task Management';
        $data['breadcrumbs'] = [
            [
                'name' => 'Tasks',
                'active' => true
            ]
        ];

        $data['taskList'] = Task::filter(request(['project_id', 'assigned_to', 'assigned_by', 'priority', 'status']))->orderBy('name')->get();
        $data['projectList'] = Project::orderBy('name')->get();
        $data['userList'] = User::orderBy('name')->get();

        return view('admin.task.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Task';
        $data['breadcrumbs'] = [
            [
                'name' => 'Tasks',
                'link' => route('task.index'),
                'active' => false
            ], [
                'name' => 'Create',
                'active' => true
            ]
        ];

        $data['projectList'] = Project::orderBy('name')->get();
        $data['userList'] = User::orderBy('name')->get();

        return view('admin.task.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $fields = $request->validated();

        if ($request->hasFile('file')) {
            $allPath = "";

            $images = $request->file('file');
            foreach ($images as $image) {
                $path = $image->store('project/task', 'public');

                $allPath .= $path . ",";
            }

            $fields['file'] = $allPath; //append old and new
        }

        DB::transaction(function () use ($fields) {
            Task::create($fields);
        });

        return to_route('task.index')->with('status', 'Task created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $data['title'] = 'View Task';
        $data['breadcrumbs'] = [
            [
                'name' => 'Tasks',
                'link' => route('task.index'),
                'active' => false
            ], [
                'name' => 'View',
                'active' => true
            ]
        ];

        $data['task'] = $task;

        return view('admin.task.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $data['title'] = 'Edit Task';
        $data['breadcrumbs'] = [
            [
                'name' => 'Tasks',
                'link' => route('task.index'),
                'active' => false
            ], [
                'name' => 'Edit',
                'active' => true
            ]
        ];

        $data['task'] = $task;
        $data['projectList'] = Project::orderBy('name')->get();
        $data['userList'] = User::orderBy('name')->get();

        return view('admin.task.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $fields = $request->validated();

        if ($request->hasFile('file')) {
            $allPath = "";
            $prevFiles = $task->file;

            $images = $request->file('file');
            foreach ($images as $image) {
                $path = $image->store('project/task', 'public');

                $allPath .= $path . ",";
            }

            $fields['file'] = $prevFiles . $allPath; //append old and new
        }

        DB::transaction(function () use ($fields, $task) {
            $task->update($fields);
        });

        return to_route('task.index')->with('status', 'Task updated');
        // return back()->with('status', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $taskFile = explode(',', $task->file);

        DB::transaction(function () use ($task, $taskFile) {
            $task->delete();

            $this->deleteImage($imgDisk = 'public', $imgPath = $taskFile, $isArray = true);
        });

        return to_route('task.index')->with('status', 'Task deleted');
    }

    public function removeImage(RemoveTaskImageRequest $request)
    {
        return true;
        $fields = $request->validated();

        $task = Task::find($fields['task_id']);
        $taskFiles = explode(',', $task->file);
        $updatedTaskFiles = array();

        foreach ($taskFiles as $key => $value) {
            if ($value !== $fields['image']) {
                array_push($updatedTaskFiles, $value);
            }
        }

        DB::transaction(function () use ($fields,$updatedTaskFiles, $task) {
            $task->update([
                'file' => implode(',', $updatedTaskFiles)
            ]);

            $this->deleteImage($imgDisk = 'public', $imgPath = $fields['image']);
        });

        return back()->with('status', 'File removed');
    }
}
