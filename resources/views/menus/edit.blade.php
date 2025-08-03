@extends('layouts.backend-master')

@section('title', 'Edit Menu')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/css/user_management.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <span class="breadcrumb-item">User Manager</span>
                <a class="breadcrumb-item" href="{{ route('admin.menus.index') }}"> Menus</a>
                <span class="breadcrumb-item active">Edit Menu</span>
            </nav>
        </div>
    </div>
    <!-- END Breadcrumb -->

    <!-- Page Content -->
    <div class="content menu-contain">
        <!-- Menus Edit -->
        <div class="row">
            <div class="col-md-12">
                <!-- Menus Edit Labels -->
                <div class="block">
                    <form action="{{ route('admin.menus.update',$menu->id) }}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Menu</h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-danger" href="{{ route('admin.menus.index') }}">Cancel</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="icon">Menu Icon</label>
                                        <br>
                                        @if($menu->icon)
                                            <strong>Selected:</strong>
                                            <br>
                                            <span>
                                                <input type="radio" id="{{ $menu->id }}" name="icon" value="{{ $menu->icon }}" checked />
                                                <label for="{{ $menu->id }}"><i class="{{ $menu->icon }}"></i></label>
                                            </span>
                                        @endif
                                        <br>
                                        <strong>Choose Another:</strong>
                                        <br>
                                        <span>
                                            <input type="radio" id="icon1" name="icon" value="@if($menu->icon == 'fa fa-bar-chart') fa fa-bar-chart @endif" />
                                            <label for="icon1"><i class="fa fa-bar-chart"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon2" name="icon" value="fa fa-line-chart" />
                                            <label for="icon2"><i class="fa fa-line-chart"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon3" name="icon" value="fa fa-pie-chart" />
                                            <label for="icon3"><i class="fa fa-pie-chart"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon4" name="icon" value="fa fa-arrow-circle-right" />
                                            <label for="icon4"><i class="fa fa-arrow-circle-right"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon5" name="icon" value="fa fa-arrow-right" />
                                            <label for="icon5"><i class="fa fa-arrow-right"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon6" name="icon" value="fa fa-plus-square" />
                                            <label for="icon6"><i class="fa fa-plus-square"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon7" name="icon" value="fa fa-clipboard" />
                                            <label for="icon7"><i class="fa fa-clipboard"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon8" name="icon" value="fa fa-list-alt" />
                                            <label for="icon8"><i class="fa fa-list-alt"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon9" name="icon" value="fa fa-book" />
                                            <label for="icon9"><i class="fa fa-book"></i></label>
                                        </span>
                                            <br>
                                        <span>
                                            <input type="radio" id="icon10" name="icon" value="fa fa-briefcase" />
                                            <label for="icon10"><i class="fa fa-briefcase"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon11" name="icon" value="fa fa-calendar" />
                                            <label for="icon11"><i class="fa fa-calendar"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon12" name="icon" value="fa fa-check-square-o" />
                                            <label for="icon12"><i class="fa fa-check-square-o"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon13" name="icon" value="fa fa-cog" />
                                            <label for="icon13"><i class="fa fa-cog"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon14" name="icon" value="fa fa-database" />
                                            <label for="icon14"><i class="fa fa-database"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon15" name="icon" value="fa fa-group" />
                                            <label for="icon15"><i class="fa fa-group"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon16" name="icon" value="fa fa-institution" />
                                            <label for="icon16"><i class="fa fa-institution"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon17" name="icon" value="fa fa-line-chart" />
                                            <label for="icon17"><i class="fa fa-line-chart"></i></label>
                                        </span>
                                        <span>
                                            <input type="radio" id="icon18" name="icon" value="fa fa-paper-plane" />
                                            <label for="icon18"><i class="fa fa-paper-plane"></i></label>
                                        </span>
                                        {{--<div class="icon-selected">
                                            <img src="{{ asset('assets/uploads/menu_icons/'.$menu->icon) }}" class="image" alt="" width="100px" height="80px">
                                            <br>
                                            <button type="button" class="btn btn-sm btn-success change-icon">Change Icon</button>
                                        </div>
                                        <div class="icon-div hidden">
                                            <input type="file" name="icon" id="icon" class="form-control height-unset" accept=".jpg,.jpeg,.bmp,.png,.gif">
                                            --}}{{--<br>--}}{{--
                                            --}}{{--<button class="btn btn-sm btn-danger cancel-btn">Cancel</button>--}}{{--
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="name">Menu Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="menu_url">Menu URL</label>
                                        <input type="text" class="form-control" id="menu_url" name="menu_url" value="{{ $menu->menu_url }}">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="menuorder">Menu Order</label>
                                        <input type="number" class="form-control" id="menu_order" name="menu_order" value="{{ $menu->menu_order }}" required>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="parent_id">Menu Parent</label>
                                        <select name="parent_id" class="form-control select2">
                                            <option value="0" selected> --Select Parent Menu-- </option>
                                            @foreach ($menus as $item)
                                                @if($item->id != $menu->id)
                                                    <option value="{{ $item->id }}" @if($item->id==$menu->parent_id){{'selected'}}@endif>{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="publish">Status</label>
                                        <select class="form-control select2" id="status_id" name="status_id" required>
                                            <option value="2" @if($menu->status_id == 0) {{'selected'}} @endif>Inactive</option>
                                            <option value="1" @if($menu->status_id == 1) {{'selected'}} @endif>Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Menus Edit Labels -->
            </div>
        </div>
        <!-- END Menus Edit -->
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".icon-div").hide();
            $(".change-icon").click(function(){
                $(".icon-selected").hide();
                $(".icon-div").removeClass('hidden');
                $(".icon-div").show();

            });
            /*$(".cancel-btn").click(function(){
                $(".icon-selected").show();
                $(".icon-div").hide();
            });
            if($('.input1').val()){
                $(".cancel-btn").hide();
            }*/
        });
    </script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
