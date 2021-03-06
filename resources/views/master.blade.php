<!DOCTYPE html>
<html>
<head>
    <title>{{Skipper::setting('admin_title')}} - {{Skipper::setting('admin_description')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_token() ?>"/>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400|Lato:300,400,700,900' rel='stylesheet' type='text/css'>

    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/lib/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/css/bootstrap-toggle.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/js/icheck/icheck.css"
          rel="stylesheet">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ config('skipper.assets_path') }}/css/themes/flat-blue.css">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

    <!-- Skipper CSS -->
    <link rel="stylesheet" href="{{ config('skipper.assets_path') }}/css/skipper.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ config('skipper.assets_path') }}/images/logo-icon.png" type="image/x-icon">

    <!-- CSS Fonts -->
    <link href="{{ config('skipper.assets_path') }}/fonts/skipper/styles.css" rel="stylesheet">
    <script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ config('skipper.assets_path') }}/js/vue.min.js"></script>

    @yield('css')
    @yield('head')

</head>

<body class="flat-blue">

<div id="skipper-loader">
    <img src="{{ config('skipper.assets_path') }}/images/logo-icon.png" alt="Skipper Loader">
</div>

<?php
$user_avatar = Skipper::image(Auth::user()->avatar);
if ((substr(Auth::user()->avatar, 0, 7) == 'http://') || (substr(Auth::user()->avatar, 0, 8) == 'https://')) {
    $user_avatar = Auth::user()->avatar;
}
$menuExpanded = isset($_COOKIE['expandedMenu']) && $_COOKIE['expandedMenu'] == 1;
?>

<div class="app-container @if ($menuExpanded) expanded @endif ">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="hamburger @if ($menuExpanded) is-active @endif ">
                        <span class="hamburger-inner"></span>
                    </div>

                    <ol class="breadcrumb">
                        @if(count(Request::segments()) == 1)
                            <li class="active"><i class="skipper-boat"></i> Dashboard</li>
                        @else
                            <li class="active">
                                <a href="{{ route('skipper.dashboard')}}"><i class="skipper-boat"></i> Dashboard</a>
                            </li>
                        @endif
                        <?php $breadcrumb_url = ''; ?>
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                            @if(Request::segment($i) != config('skipper.routes.prefix') && !is_numeric(Request::segment($i)))

                                @if($i < count(Request::segments()) & $i > 0)
                                    <li class="active"><a
                                                href="{{ $breadcrumb_url }}">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                                    </li>
                                @else
                                    <li>{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</li>
                                @endif

                            @endif
                        @endfor
                    </ol>


                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="skipper-list icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="skipper-x icon"></i>
                    </button>


                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><img src="{{ $user_avatar }}" class="profile-img"> <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-animated">
                            <li class="profile-img">
                                <img src="{{ $user_avatar }}" class="profile-img">
                                <div class="profile-body">
                                    <h5>{{ Auth::user()->name }}</h5>
                                    <h6>{{ Auth::user()->email }}</h6>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('skipper.profile') }}"><i class="skipper-person"></i> Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('skipper.logout') }}"><i class="skipper-power"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('skipper.dashboard') }}">
                            <div class="icon skipper-helm"></div>
                            <div class="title">{{Skipper::setting('admin_title')}}</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="skipper-x icon"></i>
                        </button>
                    </div><!-- .navbar-header -->

                    <div class="panel widget center bgimage"
                         style="background-image:url({{ Skipper::image( Skipper::setting('admin_bg_image'), config('skipper.assets_path') . '/images/bg.jpg' ) }});">
                        <div class="dimmer"></div>
                        <div class="panel-content">
                            <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                            <h4>{{ ucwords(Auth::user()->name) }}</h4>
                            <p>{{ Auth::user()->email }}</p>

                            <a href="{{ route('skipper.profile') }}" class="btn btn-primary">Profile</a>
                            <div style="clear:both"></div>
                        </div>
                    </div>

                    <?= Menu::display('admin', 'admin_menu'); ?>

                        <li class="dropdown">
                            <a data-toggle="collapse" href="#tools-dropdown-element">
                                <span class="icon skipper-tools"></span>
                                <span class="title">Tools</span>
                                <span class="site-menu-arrow"></span>
                            </a>

                            <div id="tools-dropdown-element" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="/{{config('skipper.routes.prefix')}}/menus">
                                                <span class="icon skipper-list"></span>
                                                <span class="title">Menu Builder</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="animsition-link" href="{{ route('skipper.database') }}">
                                                <span class="icon skipper-data"></span>
                                                <span class="title">Database</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('skipper.settings') }}">
                                <span class="icon skipper-settings"></span>
                                <span class="title">Settings</span>
                            </a>
                        </li>
                    </ul>
                    <!-- /.navbar-collapse -->
                    </div>
                </nav>
            </div>
            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    @yield('page_header')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="app-footer">
    <div class="site-footer-right">
        Design with
        <i class="skipper-heart"></i>
         by
        <a href="http://zanjs.com" target="_blank">
         Anla sheng
        </a>
    </div>
</footer>
<!-- Javascript Libs -->

<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/js/jquery.cookie.js"></script>
<!-- Javascript -->

<script type="text/javascript" src="{{ config('skipper.assets_path') }}/js/readmore.min.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/js/app.js"></script>
<script type="text/javascript" src="{{ config('skipper.assets_path') }}/lib/js/toastr.min.js"></script>
<script>
            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@yield('javascript')
</body>
</html>
