<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
    <title>Warehouse | Dashboard</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
      WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

    <!--end::Web font -->
	@include('layout.admin.stylesheet')
	@yield('stylesheet')
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

      @include('layout.admin.top_header')

      <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
       
        @include('layout.admin.navigation_menu')
        
        @yield('body')
      </div>

      <!-- end:: Body -->

      @include('layout.admin.footer')
    </div>

    <!-- end:: Page -->

    <!-- end::Scroll Top -->

    @include('layout.admin.script')
    @yield('script')

  </body>
</html>