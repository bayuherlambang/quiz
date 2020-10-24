@inject('request', 'Illuminate\Http\Request')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">

      <span class="brand-text font-weight-light">QUEING</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(!Auth::user()->isAdmin())
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <i class="fas fa-home nav-icon"></i>
                <p>@lang('quickadmin.dashboard')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tests.index') }}" class="nav-link {{ $request->segment(1) == 'tests' ? 'active' : '' }}">
                <i class="fas fa-edit nav-icon"></i>
                <p>@lang('quickadmin.test.new')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('results.index') }}" class="nav-link {{ $request->segment(1) == 'results' ? 'active' : '' }}">
                <i class="fas fa-poll-h nav-icon"></i>
                <p>@lang('quickadmin.results.title')</p>
              </a>
            </li>
            @endif
            @if(Auth::user()->isAdmin())
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link {{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <i class="fas fa-home nav-icon"></i>
                <p>@lang('quickadmin.dashboard')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('results.index') }}" class="nav-link {{ $request->segment(1) == 'results' ? 'active' : '' }}">
                <i class="fas fa-poll-h nav-icon"></i>
                <p>@lang('quickadmin.results.title_admin')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('topics.index') }}" class="nav-link {{ $request->segment(1) == 'topics' ? 'active' : '' }}">
                <i class="fas fa-fw fa-file nav-icon"></i>
                <p>@lang('quickadmin.topics.title')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('questions.index') }}" class="nav-link {{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                <i class="far fa-file-alt nav-icon"></i>
                <p>@lang('quickadmin.questions.title')</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('questions_options.index') }}" class="nav-link {{ $request->segment(1) == 'questions_options' ? 'active' : '' }}">
                <i class="fas fa-list nav-icon"></i>
                <p>@lang('quickadmin.questions-options.title')</p>
              </a>
            </li>

            @if(Auth::user()->name == 'Admin')
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-user"></i>
              <p>
                @lang('quickadmin.user-management.title')
                <span class="fa arrow"></span>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('roles.index') }}" class="nav-link {{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                    <i class="fa fa-briefcase nav-icon"></i>
                    <p>@lang('quickadmin.roles.title')</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('users.index') }}" class="nav-link {{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                    <i class="far fa-user nav-icon"></i>
                    <p>@lang('quickadmin.users.title')</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('user_actions.index') }}" class="nav-link {{ $request->segment(1) == 'user_actions' ? 'active active-sub' : '' }}">
                    <i class="far fa-list nav-icon"></i>
                    <p>@lang('quickadmin.user-actions.title')</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
          @endif
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
