@inject('request', 'Illuminate\Http\Request')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('tests.index') }}" class="nav-link {{ $request->segment(1) == 'tests' ? 'active' : '' }}">
                <i class="fas fa-edit nav-icon"></i>
                <span class="title">@lang('quickadmin.test.new')</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('results.index') }}" class="nav-link {{ $request->segment(1) == 'results' ? 'active' : '' }}">
                <i class="fas fa-poll-h nav-icon"></i>
                <span class="title">@lang('quickadmin.results.title')</span>
              </a>
            </li>
            @if(Auth::user()->isAdmin())
            <li class="nav-item">
              <a href="{{ route('topics.index') }}" class="nav-link {{ $request->segment(1) == 'topics' ? 'active' : '' }}">
                <i class="fas fa-fw fa-file"></i>
                <span class="title">@lang('quickadmin.topics.title')</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('questions.index') }}" class="nav-link {{ $request->segment(1) == 'questions' ? 'active' : '' }}">
                <i class="far fa-file-alt nav-icon"></i>
                <span class="title">@lang('quickadmin.questions.title')</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('questions_options.index') }}" class="nav-link {{ $request->segment(1) == 'questions_options' ? 'active' : '' }}">
                <i class="fas fa-list nav-icon"></i>
                <span class="title">@lang('quickadmin.questions-options.title')</span>
              </a>
            </li>
            <!--------
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
                -------->
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
