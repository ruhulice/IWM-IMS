@extends('layouts.backend-master')
@section('title', 'Home')
@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <span class="breadcrumb-item"><i class="fa fa-home"></i> <b>Home</b></span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="col-md-8 offset-md-2">
            <div class="row invisible" data-toggle="appear">
                <!-- Row #1 -->
                <div class="col-6 col-xl-3">
                    <a class="block block-link-pop text-right bg-earth" href="/home">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-home fa-3x text-earth-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white"><span></span>&nbsp;</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Home</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-pop text-right bg-primary" href="/documents-dashboard">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="si si-folder-alt fa-3x text-primary-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white">&nbsp;</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op"></div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-pop text-right bg-elegance" href="javascript:void(0)">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="fa fa-file fa-3x text-elegance-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white">&nbsp;</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">USERS</div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-xl-3">
                    <a class="block block-link-pop text-right bg-corporate" href="/admin/users">
                        <div class="block-content block-content-full clearfix border-black-op-b border-3x">
                            <div class="float-left mt-10 d-none d-sm-block">
                                <i class="fa fa-cogs fa-3x text-corporate-light"></i>
                            </div>
                            <div class="font-size-h3 font-w600 text-white">&nbsp;</div>
                            <div class="font-size-sm font-w600 text-uppercase text-white-op">Settings</div>
                        </div>
                    </a>
                </div>
                <!-- END Row #1 -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/chartjs/Chart.bundle.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_pages_dashboard.min.js') }}"></script>
@endsection
