@extends('authentication.login-master')
@section('title', 'Login')
@section('content')
    <style>
        .bg-gd-dusk.main-page-login {
            {{--background: url({{ asset('assets/media/loginbg.jpg') }}) no-repeat !important;   --}}
            background-size: cover !important;
            background: linear-gradient(135deg, cadetblue 0%, cadetblue 100%) !important;
        }
        .login-form{
            border: 1px solid #ddddddc2;
            border-radius: 3px;
            background: white;
        }
        .form-material {
            position: relative;
            padding-top: 20px !important;
        }
        .login-form {
            border: 1px solid #ddddddc2;
            border-radius: 3px;
            /* box-shadow: rgba(255,255,0,0); */
            /* box-shadow: 5px 5px 5px 5px #358ccb9e, 0 0 0 1px #dfdfdf; */
            box-shadow: 0px 0px 15px 15px #00000063, 0 0 0 1px #dfdfdf;
        }
        @media (max-width:650px) {
            .main-title{
                 font-size: 18px !important;
            }
        }
    </style>
	<!-- Page Content -->
    <div class="bg-gd-dusk main-page-login">
        <div class="hero-static content content-full bg-white invisible" data-toggle="appear" style="background:transparent !important; width:100% !important; max-width:100% !important">
            <!-- Header -->
            
            <!-- END Header -->
            {{--<h2 class="h4 font-w700 mt-30 mb-10 main-title" style="font-size: 48px;
            padding-top: 1.5rem;
            text-align: center;
            color: #7e7e7e;">
                ????? ? ???? ??????? ????? ??????? ???? ????? ???????
            </h2>--}}

            <div class="text-center" style="height:100px">
                {{-- <img src="{{ asset('assets/landing/images/project_name_bn.png') }}" alt="Logo" width="77%"> --}}
            </div>

            <!-- Sign In Form --> 
            <div class="row justify-content-center px-10">
                <div class="col-sm-8 col-md-4 col-xl-3 login-form">
                    <div class="py-10 px-5 text-center">
                        <a class="font-w700" target="_blank">
                            <span class="logo-lg">
                                <a href="{{ url('/') }}">
                                    {{--<img src="{{ asset('assets/media/logo/logo-1.png') }}" alt="Logo" width="160px">--}}
                                    <img src="{{ asset('assets/landing/images/IWMLOGO.jpg') }}" alt="Logo" width="180px">
                                </a>
                            </span>

                            {{--<div class="text-center">
                                <br>
                                ভূমি নকশা - অ্যাডমিন প্যানেল
                            </div>--}}
                        </a>
                        {{--<h2 class="h4 font-w700 mt-30 mb-10" style="font-size:14px;">
                            {{ "???? ? ???? ??????? ????? ??????? ???? ????? ???????, ???? ??????????" }}
                        </h2>--}}
                    </div>
                    @if (session()->has('errorcredentials'))
                        <div class="text-center has-error">
                            <span class="help-block" style="color:#EF5452">
                                <strong>{!! session()->get('errorcredentials') !!}</strong>
                            </span>
                        </div>
                    @endif
                    @if($errors)
                        <div class="text-center has-error">
                            @foreach($errors->all() as $error)
                                <span class="help-block" style="color:#EF5452">
                                    <strong>{!! $error !!}</strong>
                                </span><br>
                            @endforeach
                        </div>
                    @endif
                    <form class="js-validation-signin" action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="text" class="form-control" id="username" name="username" >
                                    <label for="username">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="password" class="form-control" id="password" name="password" >
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>
                        <input type="checkbox" id="showPass" onclick="ShowMyPassword()"> <label for="showPass">Show Password</label>
                        <br><br/>
                        <div class="form-group row gutters-tiny">
                            <div class="col-12 mb-10">
                                <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                    <i class="si si-login mr-10"></i> Sign In
                                </button>
                            </div>
                            <div class="col-12 mb-10" style="text-align: center">
                                <a href="/"> <i class="fa fa-arrow-left"></i> Back to landing page</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Sign In Form -->
        </div>
    </div>
    <!-- END Page Content -->

    <script>
        function ShowMyPassword() {
            var x = document.getElementById("password");
            //var y = document.getElementById("user_code");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

            /*if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }*/
        }
    </script>

@endsection
