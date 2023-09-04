<!--  BEGIN MAIN CONTAINER  -->

    <div class="main-container" id="container">



        <div class="overlay"></div>

        <div class="search-overlay"></div>



        <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">

                    <div class="nav-logo">

                        <div class="nav-item theme-logo">

                            <a href="{{url('admin/dashboard')}}">
                                
                                <img src="{{ $globalSettings['site_logo']['meta_value'] ? asset('storage/'.$globalSettings['site_logo']['meta_value']) : asset('assets/img/hrm_logo.png')}}" class="navbar-logo_" alt="logo">

                            </a>

                        </div>
                        

                        {{-- <div class="nav-item theme-text">

                            <a href="{{url('admin/dashboard')}}" class="nav-link"> {{env('APP_NAME')}} </a>

                        </div> --}}

                    </div>

                    <div class="nav-item sidebar-toggle">

                        <div class="btn-toggle sidebarCollapse">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>

                        </div>

                    </div>

                </div>



                <div class="profile-info">

                    <div class="user-info">

                        <div class="profile-img">

                            <img alt="avatar" src="{{ auth()->user()->profile_image?asset('storage/'.auth()->user()->profile_image):asset('storage/default/no_image.jpg') }}" alt="avatar">

                        </div>

                        <div class="profile-content">

                            <h6 class="">@if (Session::has('userId')) {{{ Session::get('name') }}} @endif</h6>

                            <p class="">Administrator</p>

                        </div>

                    </div>

                </div>

                            
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    <li @if(Route::current()->getName() == 'dashboard') class="menu active" @else class="menu" @endif>

                        <a href="{{route('dashboard')}}" class="dropdown-toggle">

                            <div class="">

                                <span><i class="fa-solid fa-house"></i></span>

                                <span>Dashboard</span>

                            </div>

                        </a>

                    </li>

                    <li class="menu">

                        <a href="{{route('users.index')}}" aria-expanded="false" class="dropdown-toggle">

                            <div class="">

                            <span><i class="fa-solid fa-user-group"></i></span>

                                <span>Users</span>

                            </div>

                        </a>

                    </li>

                    <li class="menu">

                        <a href="{{route('client.index')}}" aria-expanded="false" class="dropdown-toggle">

                            <div class="">

                            <span><i class="fa-solid fa-users"></i></span>

                                <span>Clients</span>

                            </div>

                        </a>

                    </li>

                    <li class="menu">

                        <a href="{{route('project.index')}}" aria-expanded="false" class="dropdown-toggle">

                            <div class="">

                                <span><i class="fa-solid fa-bars-progress"></i></span>

                                <span>Projects</span>

                            </div>

                        </a>

                    </li>

                    <li class="menu">

                        <a href="{{route('task.index')}}" aria-expanded="false" class="dropdown-toggle">

                            <div class="">

                                <span><i class="fa-solid fa-list-check"></i></span>

                                <span>Task</span>

                            </div>

                        </a>

                    </li>

                    <li class="menu">

                        <a href="{{route('setting')}}" aria-expanded="false" class="dropdown-toggle">

                            <div class="">

                            <span><i class="fa-solid fa-gear"></i></span>

                                <span>Settings</span>

                            </div>

                        </a>

                    </li>

                </ul>
            </nav>

        </div>

        <!--  END SIDEBAR  -->