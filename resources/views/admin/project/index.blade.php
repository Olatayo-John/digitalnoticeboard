@extends('admin.layouts.master')
@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <a href="{{ route('project.create') }}"><button
                                    class="btn btn-primary mb-2 me-4 _effect--ripple waves-effect waves-light">Add
                                    Project</button></a>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div class="row layout-top-spacing_">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing_">
                        <div class="widget-content widget-content-area br-8">
                            <div class="dataTables_wrapper" id="projectTable_wrapper" style="padding:21px">

                                <div class="filterDiv">
                                    <div class="row">
                                        <div class="toolbar col-12 mb-3"></div>
                                    </div>
                                </div>

                                <div class="projectTable row">
                                    @foreach ($projectList as $project)
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <div class="card shadow-none">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="flex-grow-1">
                                                            <div>
                                                                @foreach (config('site.project_status') as $configPStatus)
                                                                    @if ($project->status === $configPStatus['value'])
                                                                        <span
                                                                            class="badge {{ $configPStatus['class'] }} p-1">
                                                                            {{ $configPStatus['name'] }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div class="dropdown">
                                                                <a href="#" role="button" class="dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('project.show', $project->id) }}">
                                                                            View
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('project.edit', $project->id) }}">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <form method="post"
                                                                            action="{{ route('project.destroy', $project->id) }}"
                                                                            class="deleteProjectForm dropdown-item p-0">
                                                                            @csrf @method('delete')
                                                                            <button class="btn- InFormDeleteBtn"
                                                                                formClass="deleteProjectForm">
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        @foreach (config('site.priority') as $configPriority)
                                                            @if ($project->priority === $configPriority['value'])
                                                                <span
                                                                    class="{{ $configPriority['class'] }} font-weight-bolder">
                                                                    {{ $configPriority['name'] }}
                                                                </span>
                                                            @endif
                                                        @endforeach

                                                        <h5 class="font-size-15 mb-1 text-truncate">
                                                            <a href="{{ route('project.show', $project->id) }}"
                                                                class="text-body">
                                                                {{ $project->name }}
                                                            </a>
                                                        </h5>
                                                        <p class="text-muted mb-4 text-truncate">
                                                            <a href="{{ route('client.show', $project->client_id) }}"
                                                                class="text-body">
                                                                {{ $project->client->name }}
                                                            </a>
                                                        </p>
                                                    </div>

                                                    <div class="">
                                                        <div>Start date : {{ $project->start_date }}</div>
                                                        <div>Due date : {{ $project->due_date }}</div>

                                                        <div class="text-end pt-2">
                                                            @if ($project->type === '1')
                                                                Testing
                                                            @elseif ($project->type === '2')
                                                                Production
                                                            @endif
                                                            
                                                            @if ($project->url)
                                                            <div>
                                                                <a href="{{ $project->url }}" target="_blank">
                                                                    <i class="fa-solid fa-link"></i>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div>

                                                        <div class="avatar-group align-items-center pt-2">
                                                            @foreach ($project['members'] as $key => $value)
                                                                <div class="avatar-group-item">
                                                                    <a href="javascript: void(0);" class="d-block"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="{{ $value->name }}">
                                                                        <img src="{{ $value->profile_image ? asset('storage/' . $value->profile_image) : asset('storage/default/no_image.jpg') }}"
                                                                            alt="" class="rounded-circle avatar-sm">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{ $projectList->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <script>
        $(document).ready(function() {
            document.querySelector('div#projectTable_wrapper div.toolbar').innerHTML =
                '<form method="post" action="" class="form-inline_ row">@csrf @method('get') <div class="col"><select class="form-control client_id" name="client_id"><option value="">Client</option>@foreach ($clientList as $clientL)<option value="{{ $clientL->id }}" {{ request('client_id') == $clientL->id ? 'selected' : '' }}>{{ $clientL->name }}</option>@endforeach</select></div><div class="col"><select class="form-control" name="type"><option value="">Type</option>@foreach (config('site.project_type') as $pType)<option value="{{ $pType['value'] }}" {{ request('type') == $pType['value'] ? 'selected' : '' }}>{{ $pType['name'] }}</option>@endforeach</select></div><div class="col"><select class="form-control" name="priority"><option value="">Priority</option>@foreach (config('site.priority') as $pPriority)<option value="{{ $pPriority['value'] }}" {{ request('priority') == $pPriority['value'] ? 'selected' : '' }}>{{ $pPriority['name'] }}</option>@endforeach</select></div><div class="col"><select class="form-control" name="status"><option value="">Status</option>@foreach (config('site.project_status') as $uStatus)<option value="{{ $uStatus['value'] }}" {{ request('status') == $uStatus['value'] ? 'selected' : '' }}>{{ $uStatus['name'] }}</option>@endforeach</select></div><div class="col m-auto"><button class="btn btn-primary btn-sm" type="submit">Filter</button></div></form><hr_>';

                    $('.client_id').select2();
        });
    </script>
@endsection
