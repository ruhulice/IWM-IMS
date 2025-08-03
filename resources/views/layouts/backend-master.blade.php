<!DOCTYPE html>
<html lang="IWM-IMS - ADMIN PANEL" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        {{--<title>SMART BHUMI NAKSHA - ADMIN PANEL - @yield('title')</title>--}}
        <title>IWM Integrated Management System (IWM-IMS)</title>

        <meta name="description" content="SMART BHUMI NAKSHA">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/codebase.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/others/style.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/others/toastr.min.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/others/jstree.min.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/others/sweetalert2.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick/slick.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!-- Toastr CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>



        <style>
            .ui-dialog {
                z-index: 999999 !important;
            }
            @media (min-width: 992px) {
                #page-container.sidebar-o {
                    padding-left: 275px;
                }
                #page-container.page-header-fixed.sidebar-o #page-header, #page-container.page-header-glass.sidebar-o #page-header {
                    left: 275px;
                }
                #sidebar {
                    width: 275px;
                }
            }
            .jstree-default>.jstree-striped {
                min-width: 100%;
                display: inline-block;
                background: none;
            }
            .toast-message, .toast-title {
                color: #fff;
                font-weight:500;
            }
            .div-content .form-control {
                display: block;
                width: 100%;
                height: calc(1.428572em + 0.8571428rem + 2px);
                padding: 0.4285714rem 1rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.428572;
                color: #ffffff;
                background-color: #6364643b !important;
                background-clip: padding-box;
                border: 1px solid #d4dae357 !important;
                border-radius: 0.25rem;
                transition: border-color ease-in-out 0.15s;
            }
            .div-content .form-control:focus {
                color: #ffffff;
                background-color: #6364643b !important;
                border-color: #d4dae357 !important;
                outline: 0;
                box-shadow: none;
            }
            .div-content select option {
                margin: 40px;
                background: rgba(0, 0, 0, 0.5);
                color: #fff;
                text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
            }
            #popup-content .table {
                font-size: 12px;
            }

            #popup-content .table th, .table td {
                padding: 2px 5px;
                vertical-align: top;
                border-top: 1px solid #e4e7ed;
                font-size: 12px;
            }
            #PlotDetails{ max-height: 275px;overflow-y: scroll;}
            .project-title{
                font-size: 20px;
                color: green;
            }

            .ol-layerswitcher {
                background-color: rgb(238, 238, 238) !important;
            }
            .layerup {
                display: none !important;
            }
            .ol-layerswitcher-buttons{
                float: left !important;
                margin-top: -1px;
                padding-right: 5px;
            }
            .ol-layerswitcher .layerswitcher-opacity {
                position: relative;
                border: 0px solid #369 !important;
                height: 2px !important;
                width: 120px;
                margin: 5px 1em 10px 7px;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                border-radius: 3px;
                background: #69c;
                background: -webkit-gradient(linear, left top, right top, from(rgba(0,60,136,0)), to(rgba(0,60,136,0.6)));
                background: linear-gradient(to right, rgba(0,60,136,0), rgba(0,60,136,0.6));
                cursor: pointer;
                -webkit-box-shadow: 1px 1px 1px rgb(0 0 0 / 50%);
                box-shadow: 1px 1px 1px rgb(0 0 0 / 50%);
            }
            .ol-layerswitcher .layerswitcher-opacity .layerswitcher-opacity-cursor, .ol-layerswitcher .layerswitcher-opacity .layerswitcher-opacity-cursor:before {
                position: absolute;
                width: 12px !important;
                height: 12px !important;
                top: 50%;
                left: 50%;
                background: rgba(0,60,136,0.5);
                border-radius: 50%;
                -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                z-index: 1;
            }
            .ol-control {
                position: absolute;
                background-color: rgb(209 209 209 / 40%) !important;
                border-radius: 4px;
                padding: 2px;
            }
        .ol-control button {
            display: block;
            margin: 1px;
            padding: 0;
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            font-size: inherit;
            text-align: center;
            height: 1.475em !important;
            width: 1.475em !important;
            line-height: .4em;
            background-color: rgba(0,60,136,.5);
            border: none;
            border-radius: 2px;
        }
        .ol-control.ol-search > button:before {
            content: "";
            position: absolute;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: 0.7em;
            height: 0.7em;
            background-color: transparent;
            border: 0.12em solid currentColor;
            border-radius: 100%;
            top: 0.45em !important;
            left: 0.45em !important;
        }
        .ol-control.ol-search > button:after {
            content: "";
            position: absolute;
            top: 1.2em !important;
            left: 0.99em !important;
            width: 0.45em;
            height: 0.15em;
            background-color: currentColor;
            border-radius: 0.05em;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-box-shadow: -0.18em 0 0 -0.03em;
            box-shadow: -0.18em 0 0 -0.03em;
        }
        .ol-search ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: block;
            clear: both;
            cursor: pointer;
            max-width: 17.9em !important;
            overflow-x: hidden;
            z-index: 1;
            background: #fff;
        }
        .ol-search ul i {
            display: block !important;
            color: #333;
            font-size: 0.85em;
        }
        .ol-search ul li {
            padding: 0.25em 0.5em !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-top: 1px solid #ddd !important;
        }
        .ol-search ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: block;
            clear: both;
            cursor: pointer;
            max-width: 17em;
            overflow-x: hidden;
            z-index: 1;
            background: #fff;
        }
        .ol-search li.copy {
            background: rgba(0,0,0,.5);
            color: #fff;
            display: none !important;
        }

        .remove-revarse:after {
            content: none !important;
        }
        .remove-revarse::before {
            content: none !important;
        }

        .ol-search button.remove-revarse {
            float: none;
            background-image: none;
            display: inline-block;
            vertical-align: bottom;
            position: relative;
            top: 0;
            left: 0;
        }
        .ol-search {
            top: 0.6em !important;
            left: 3em;
        }
        .ol-revers{
            display: none !important;
        }
        .ol-search .search{
            width: 88.7%;
        }
            /*For notification starts*/
            .notification-tab {
                float: left;
            }
            .notification {
                color: darkcyan;
                text-decoration: none;
                /* padding: 5px 10px; */
                position: relative;
                display: inline-block;
                /* border-radius: 2px; */
            }
            .notification i {
                font-size: 22px;
                margin-top: 5px;
                margin-right: 5px;
            }
            .notification .badge {
                position: absolute;
                top: -10px;
                right: -10px;
                padding: 5px 10px;
                border-radius: 50%;
                background-color: red;
                color: white;
            }
            .notification-details-tab {
                position: absolute;
                /*border: 1px solid black;*/
                width: 260px;
                background: white;
                height: 270px;
                border-radius: 20px;
                right: 80px;
                margin-top: 5px;
                box-shadow: 0 0 15px 15px #00000063, 0 0 0 1px #dfdfdf;
                display: none;
            }
            .notification-details-tab .list-group {
                height: 255px;
                overflow-y: auto;
                border-radius: 20px;
            }
            .list-group-item {
                padding: 0.5rem 0.7rem;
                overflow-wrap: anywhere;
                font-size: 12.5px;
                cursor: pointer;
            }
            .notification-details-tab .list-group-item:first-child {
                border-top-left-radius: 20px;
                /*border-top-right-radius: 20px;*/
            }
            .notification-details-tab .seen-shadow {
                background-color: #E4E7ED;
            }
            .notification-details-tab .close-notification {
                bottom: 0;
                position: inherit;
                right: 0;
                font-size: 11px;
                padding: 2px;
                width: 50%;
                border-bottom-right-radius: 20px !important;
                border-radius: 0;
            }
            .notification-details-tab .see-notification {
                bottom: 0;
                position: inherit;
                left: 0;
                font-size: 11px;
                padding: 2px;
                width: 50%;
                border-bottom-left-radius: 20px !important;
                border-radius: 0;
            }
            .modal-backdrop {
                z-index: 1025;
            }
            .modal-header, .modal-footer {
                padding-top: 0 !important;
                padding-bottom: 5px !important;
            }
            .modal-content {
                background: whitesmoke;
                border-radius: 20px;
                box-shadow: 0 0 15px 15px #00000063, 0 0 0 1px #dfdfdf;
                margin-top: 20%;
            }
            .modal-dialog p {
                margin-bottom: 0;
            }
            /* Scrollbar modification */
            .notification-details-tab .list-group::-webkit-scrollbar {
                width: 7px;
            }
            /* Track */
            .notification-details-tab .list-group::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px grey;
                border-radius: 20px;
            }
            /* Handle */
            .notification-details-tab .list-group::-webkit-scrollbar-thumb {
                background: darkgrey;
                border-radius: 20px;
            }
            /* Handle on hover */
            .notification-details-tab .list-group::-webkit-scrollbar-thumb:hover {
                background: #b30000;
            }

            /*For notification ends*/


            .ol-search-type{
                top:0.6rem;
                left:3rem;
                cursor: pointer !important;
                pointer-events: auto !important;
            }
            .ol-search {
            top: 0.5em;
            left: 5em !important;
        }
        .hidden{
            display: none !important;
        }


        .custom-mouse-position{
            width:20% !important;
            float:right !important;
        }

        .fa-globe:before {
            cursor: pointer;
        }

        .selected{
            background-color:orange !important;
        }

        .ol-search ul li.select, .ol-search ul li:hover {
            background-color: rgba(0,60,136,.5);
            color: #fff !important;
            cursor: pointer;
        }

        .ol-search ul li.select > i, .ol-search ul li:hover > i {
            color: #fff !important;
            cursor: pointer;
        }
        .ui-widget-overlay {
            background: #000000;
            opacity: 0.5;
            -ms-filter: Alpha(Opacity=30);
        }
 /* ===== Scrollbar CSS ===== */
    /* Firefox */
    * {
        scrollbar-width: auto;
        scrollbar-color: #a8a8a8 #ffffff;
    }

    /* Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 10px;
    }

    *::-webkit-scrollbar-track {
        background: #ffffff;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #a8a8a8;
        border-radius: 10px;
        border: 2px solid #ffffff;
    }


        .ol-overlaycontainer-stopevent{
            position: initial !important;
        }
        .ol-scale-line {
        background: rgba(0,60,136,.3);
        border-radius: 4px;
        bottom: 8px;
        right: 8px !important;
        left: auto !important;
        padding: 2px;
        position: absolute;
    }
    .ol-control.ol-legend {
        bottom: 0.5em;
        left: 0.5em;
        z-index: 1;
        max-height: 90%;
        max-width: 90%;
        overflow-x: hidden;
        overflow-y: auto;
        background-color: rgba(255,255,255,.6);
    }
    .ol-control.ol-legend > button:first-child:before, .ol-control.ol-legend > button:first-child:after {
        content: "";
        position: absolute;
        top: 0.25em;
        left: 0.2em;
        width: 0.2em;
        height: 0.2em;
        background-color: currentColor;
        -webkit-box-shadow: 0 0.35em, 0 0.7em;
        box-shadow: 0 0.35em, 0 0.7em;
    }
    .ol-control.ol-legend button:first-child:after {
    top: 0.27em;
    left: 0.55em;
    height: 0.15em;
    width: 0.6em;
}
.ol-control.ol-legend > button:first-child:before, .ol-control.ol-legend > button:first-child:after {
    content: "";
    position: absolute;
    top: 0.25em;
    left: 0.2em;
    width: 0.2em;
    height: 0.2em;
    background-color: currentColor;
    -webkit-box-shadow: 0 0.35em, 0 0.7em;
    box-shadow: 0 0.35em, 0 0.7em;
}

.ol-control.ol-legend .ol-legendImg {
    display: block;
}
.ol-control.ol-legend > ul, .ol-control.ol-legend > canvas {
    margin: 2px;
}
.ol-legend > canvas {
    float: left;
}
.ol-viewport canvas {
    all: unset;
}

.ol-control.ol-layerswitcher {
    position: absolute;
    right: 0.5em;
    text-align: left;
    top: 0.6em !important;
    max-height: calc(100% - 6em);
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    overflow: hidden;
}


.select2-container--default .select2-selection--single .select2-selection__arrow,.select2-container .select2-selection--single {
    height: 34px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 34px !important;
}
.div-content .select2-container--default .select2-selection--single {
    background-color: #3a3d42 !important;
    border: 1px solid #d4dae357 !important;
}
.div-content .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #e4e7ed !important;
}

.blockMsg {
    z-index: 1011;
    position: fixed;
    padding: 5px !important;
    margin: 0px;
    width: auto !important;
    top: 40%;
    left: 47% !important;
    text-align: center;
    color: rgb(0, 0, 0);
    border: 1px solid rgb(170, 170, 170) !important;
    background-color: rgb(255, 255, 255);
    cursor: wait;
    border-radius: 5px !important;
}


.blockMsg h1 {
    margin-bottom: 0px !important;
}

.ProductBlock > a{
    cursor: default !important;
}

        </style>

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/themes/corporate.css') }}"> -->
        @yield('css_after')

        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.12.0/css/ol.css" type="text/css"> -->
        <link rel="stylesheet" href="{{ asset('assets/ol/ol.css') }}" type="text/css">
        {{-- <link rel="stylesheet" href="https://unpkg.com/ol-layerswitcher@3.8.3/dist/ol-layerswitcher.css" /> --}}
        <link rel="stylesheet" href="{{ asset('assets/ol/ol-layerswitcher.css') }}" type="text/css">
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="sidebar-o sidebar-inverse enable-page-overlay side-scroll page-header-fixed">
        @include('layouts.partials.ajax_loader')
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" onclick="updateMapSize()" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->

                        <!-- User Info -->
                        <div class="content-header-item">
                            <a class="img-link mr-5" href="javascript:void(0)">
                                @if(Auth()->user()->user_photo)
                                    <img class="img-avatar img-avatar32" src="{{ asset(Auth()->user()->user_photo) }}" alt="Profile Pic">
                                @else
                                    <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="avatar15">
                                @endif
                            </a>
                            <a class="align-middle link-effect text-primary-dark font-w600 text-uppercase" href="javascript:void(0)">{{ Auth()->user()->name }}</a>
                        </div>
                        <!-- END User Info -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        Content..
                    </p>
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" onclick="updateMapSize()" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="font-w700" href="{{ route('dashboard') }}" style="font-size: 20px; padding-right:10px;">
                                    <!-- <i class="fa fa-file-text text-primary"></i> -->
{{--                                    <img class="img-avatar" src="{{ asset('assets/landing/images/logo.png') }}" style="width: 60px; height: 58px;" alt="">--}}
                                    {{-- <img class="img-avatar" src="{{ asset('assets/landing/images/IWMLOGO.jpg') }}" style="width: 60px; height: 58px;" alt=""> --}}
                                    <img class="img-avatar" src="{{ asset('assets/landing/images/IWMLOGO.jpg') }}" style="width: 80px; height: 70px; border: none; padding: 0;" alt="IWM Logo">


                                    {{-- <span class="font-size-xl text-dual-primary-dark">BDMLS </span><span class="font-size-xl text-primary"></span> --}}
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent hidden">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn ">
                            @if(Auth()->user()->user_photo)
                                <img class="img-avatar img-avatar32" src="{{ asset(Auth()->user()->user_photo) }}" alt="Profile Pic">
                            @else
                                <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="avatar15">
                            @endif
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="{{ route('profile.update') }}">
                                @if(Auth()->user()->user_photo)
                                    <img class="img-avatar img-avatar32" src="{{ asset(Auth()->user()->user_photo) }}" alt="Profile Pic">
                                @else
                                    <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="avatar15">
                                @endif
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="{{ route('profile.update') }}">{{ Auth()->user()->name }}</a>
                                </li>
                                <li class="list-inline-item">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                        <i class="si si-drop"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="si si-logout"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        @include('layouts.partials.navbar')
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" onclick="updateMapSize()" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        {{--<button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-search"></i>
                        </button>--}}
                        <!-- END Open Search Section -->

                        <!-- Layout Options (used just for demonstration) -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <div class="btn-group" role="group">
                            {{--<button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </button>--}}
                            <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown">
                                <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Settings</h5>
                                <h6 class="dropdown-header">Color Themes</h6>
                                <div class="row no-gutters text-center mb-5">
                                    <div class="col-2 mb-5">
                                        <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-elegance" data-toggle="theme" data-theme="/assets/css/themes/elegance.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-pulse" data-toggle="theme" data-theme="/assets/css/themes/pulse.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-flat" data-toggle="theme" data-theme="/assets/css/themes/flat.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-corporate" data-toggle="theme" data-theme="/assets/css/themes/corporate.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-2 mb-5">
                                        <a class="text-earth" data-toggle="theme" data-theme="/assets/css/themes/earth.css" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <h6 class="dropdown-header">Header</h6>
                                <div class="row gutters-tiny text-center mb-5">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10" data-toggle="layout" data-action="header_style_classic">Classic Style</button>
                                    </div>
                                </div>
                                <h6 class="dropdown-header">Sidebar</h6>
                                <div class="row gutters-tiny text-center mb-5">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_off">Light</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_on">Dark</button>
                                    </div>
                                </div>
                                <div class="d-none d-xl-block">
                                    <h6 class="dropdown-header">Main Content</h6>
                                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="content_layout_toggle">Toggle Layout</button>
                                </div>
                            </div>
                        </div>
                        <!-- END Layout Options -->
                    </div>
                    <!-- END Left Section -->

                    {{-- <div align="center"> --}}
                    <div class="text-center my-3">
                        <span><b class="project-title">IWM Integrated Management System (IWM-IMS)</b></span>
                    </div>

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <div class="notification-tab">
                            <a href="javascript:void(0);" class="notification">
                                <span><i class="fa fa-bell"></i></span>
                                @if($data['notification_count'] > 0)
                                    <span class="badge notification-count">{{ $data['notification_count'] }}</span>
                                @endif
                            </a>
                            <div class="notification-details-tab">
                                <ul class="list-group">
                                    @foreach($data['notifications'] as $notification)
                                        <li class="list-group-item @if($notification->is_seen != true) seen-shadow @endif" data-toggle="modal" data-target="#notificationModal-{{$notification->id}}" @if($notification->is_seen != true) onclick="SeenNotification({{ $notification->id }})" @endif>
                                            <i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;{{ substr($notification->notification_title, 0, 35) }}
                                        </li>

                                        {{--Notification Modal--}}
                                        <div class="container">
                                            <div class="modal fade" id="notificationModal-{{$notification->id}}" role="dialog">
                                                <div class="modal-dialog" style="z-index: 9999; opacity: 1;">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        {{--<div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>--}}
                                                        <div class="modal-body">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <br>
                                                            <p><strong><u>Notification:</u></strong><br>{{ $notification->notification_title }}</p>
                                                            <p><Strong><u>Details:</u></Strong><br>{{$notification->notification_details}}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if($notification->action == 'feedback-list')
                                                                <a href="{{ url($notification->action) }}" type="button" class="btn btn-info">Feedback Details</a>
                                                            @endif
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Notification Modal--}}
                                    @endforeach
                                </ul>
                                <button class="btn btn-xs btn-danger close-notification">Close</button>
                                <a href="{{ url('/notifications') }}" type="button" class="btn btn-xs btn-info see-notification">
                                    See More
                                </a>
                            </div>
                        </div>
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block text-uppercase">{{ Auth()->user()->name }}</span>
                                <i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                {{--<h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">User</h5>--}}
                                <a class="dropdown-item" href="{{ route('profile.update') }}">
                                    <i class="si si-user mr-5"></i> Profile
                                </a>
                                <!-- END Side Overlay -->

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->

                        <!-- Notifications -->
                        <div class="btn-group" role="group">
                            {{--<button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flag"></i>
                                <span class="badge badge-primary badge-pill">5</span>
                            </button>--}}
                            <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
                                <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notifications</h5>
                                <ul class="list-unstyled my-20">
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-check text-success"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                                                <div class="text-muted font-size-sm font-italic">15 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                                                <div class="text-muted font-size-sm font-italic">50 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-times text-danger"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                                                <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                                                <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                            <div class="ml-5 mr-15">
                                                <i class="fa fa-fw fa-plus text-primary"></i>
                                            </div>
                                            <div class="media-body pr-10">
                                                <p class="mb-0">New purchases! +$250</p>
                                                <div class="text-muted font-size-sm font-italic">1 day ago</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                                    <i class="fa fa-flag mr-5"></i> View All
                                </a>
                            </div>
                        </div>
                        <!-- END Notifications -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        {{--<button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="fa fa-tasks"></i>
                        </button>--}}
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form action="{{ route('dashboard') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                   </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <div class="row">
                    <div id="modalUI" class="col-md-12 col-sm-12">
                    </div>
                    <div id="dialog-win"></div>
                  </div>
                @yield('content')
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-white opacity-0" style="opacity: 1;">
                <div class="content py-20 font-size-xs clearfix" style="padding: 12px 12px 1px; padding-top:0px;">
                    <div class="float-right">
                        Design & developed by <a class="font-w600" href="https://www.iwmbd.org" target="_blank">ICT-IWM</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://www.iwmbd.org/" target="_blank">Copyright</a> © <span class="js-year-copy js-year-copy-enabled">2025 Institute of Water Modelling (IWM). All rights reserved.</span>
                    </div>
                </div>
            </footer>
            {{-- <footer id="page-footer" class="opacity-0">
                <div class="content font-size-xs clearfix">
                    <div class="float-right">
                        Developed with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="https://www.iwmbd.org/" target="_blank">IWM</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://www.iwmbd.org/" target="_blank">IWM-ICT Division</a> &copy; <span class="js-year-copy"></span>
                    </div>
                </div>
            </footer> --}}
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ asset('assets/js/codebase.app.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('assets/js/others/custom.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ asset('assets/js/laravel.app.js') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.12.0/build/ol.js"></script> -->
       
        <script type="text/javascript" src="{{ asset('assets/ol/ol.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/ol/ol-ext.css')}}">

        {{-- <link rel="stylesheet" href="https://openlayers.org/en/latest/legacy/ol.css" /> --}}
        {{-- <script type="text/javascript" src="https://openlayers.org/en/latest/legacy/ol.js"></script> --}}
        {{-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL,Object.assign"></script> --}}
      

        {{-- <link rel="stylesheet" href="https://viglino.github.io/ol-ext/dist/ol-ext.css"> --}}
        <script type="text/javascript" src="{{ asset('assets/ol/ol-ext.js') }}"></script>
        {{-- <script src="http://viglino.github.io/ol-ext/dist/ol-ext.js"></script> --}}
        <script type="text/javascript" src="{{ asset('assets/ol/FontAwesomeDef.js') }}"></script>

        {{-- <script src="https://unpkg.com/ol-layerswitcher@3.8.3"></script> --}}
        {{-- <script src="{{ asset('assets/ol/ol-layerswitcher.js') }}"></script> --}}
        <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/eligrey/FileSaver.js/aa9f4e0e/FileSaver.min.js"></script>
     
        {{-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL,Object.assign"></script> --}}
        {{-- <script src="/assets/js/ol/ol-geocoder.js"></script> --}}
        {{-- <script src="/assets/js/ol/ol-popup.js"></script> --}}
        

        @yield('js_after')
       
       
        <!-- Toastr JS -->
        <script src="{{ asset('assets/js/others/toastr.min.js') }}"></script>

        <script src="{{ asset('assets/js/others/jstree.min.js') }}"></script>

        <script src="{{ asset('assets/js/others/sweetalert2.js') }}"></script>

        <script src="{{ asset('assets/js/others/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/blockui/jquery.blockUI.min.js') }}"></script>
       

        <script>
            // toastr.options.closeButton = true;

            function blockUI(){
                $.blockUI({ message : '<div class="spinner-border text-danger"></div> <span style="font-size: 24px;margin-left: 5px;color: #dd4141;">অপেক্ষা করুন...</span>'});
            }

            function unblockUI(){
                $.unblockUI();
            }
            
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'success') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}","SUCCESS",{progressBar:true});
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}","ERROR",{progressBar:true});
                    break;
            }
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}','ERROR!',{ progressBar: true });
                @endforeach
            @endif
        </script>

        <script>
            $(document).ready(function(){
                //$(document).ajaxStart($.blockUI({ message : '<div class="spinner-border text-danger"></div> <span style="font-size: 24px;margin-left: 5px;color: #dd4141;">Please wait...</span>'})).ajaxStop($.unblockUI);
                $(".notification").click(function(){
                    $(".notification-details-tab").toggle();
                });
                $(".close-notification").click(function(){
                    $(".notification-details-tab").hide();
                });

                $('select').not(".ol-ext-print-dialog select").select2();
            });
        </script>
        <script>
            function SeenNotification(notificationId){
                var baseUrl = window.location.origin;
                var notification_id = notificationId;
                $.ajax({
                    type   : 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url    : baseUrl+"/seen/notification/"+notification_id,
                    data   : {
                        notification_id: notification_id
                    },
                    dataType: "json",
                    success: function (response) {
                        setInterval(function() {
                            $.ajax({
                                url: 'notification/count',
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    $(".notification-count").empty();
                                    $(".notification-count").append(data);
                                }
                            });
                        }, 5000);
                    },
                    error  : function () {
                        //
                    }
                });
            }
        </script>
        <!-- jQuery (required by Toastr) -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script>
                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif

                @if (session('error'))
                    toastr.error("{{ session('error') }}");
                @endif

                @if (session('info'))
                    toastr.info("{{ session('info') }}");
                @endif

                @if (session('warning'))
                    toastr.warning("{{ session('warning') }}");
                @endif
            </script>

    </body>
</html>
