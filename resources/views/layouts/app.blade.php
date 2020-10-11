<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
      @include('partials.header')
      @include('partials.sidebar')
      <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  @if(isset($siteTitle))
                      <h3 class="page-title">
                          {{ $siteTitle }}
                      </h3>
                  @endif
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              @if (Session::has('message'))
                  <div class="note note-info">
                      <p>{{ Session::get('message') }}</p>
                  </div>
              @endif
              @if ($errors->count() > 0)
                  <div class="note note-danger">
                      <ul class="list-unstyled">
                          @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="row">
                <div class="col-md-12">
                    @yield('content')
                  </div>
              </div>
              <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        @include('partials.footer')
        @include('partials.controlsidebar')
        <!-- /.content-wrapper -->
    </div>
    @include('partials.javascripts')
</body>
</html>
