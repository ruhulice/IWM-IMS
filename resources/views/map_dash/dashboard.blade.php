@extends('layouts.map-master')
@section('content')
    <div id="content" class="row">
        @include('layouts.partials.map_left')
        <div id="mapWrapper" class="row">
            <div id="layer-con" class="">
                <div class="card w-100">
                    <div class="text-center bg-secondary" id="dist-header">
                        <button class="btn btn-link text-white" type="button" data-toggle="collapse"
                                data-target="#collapse-dist" aria-expanded="true" aria-controls="collapse-dist">
                            Admin Location
                        </button>
                    </div>
                    <div id="collapse-dist" class="collapse" aria-labelledby="dist-header">
                        <div class="card-body p-2">
                            <table width="100%">
                                <tbody>
                                <tr>
                                    <td>Division:</td>
                                    <td>
                                    <select id="divisions" class="form-control" style="width:100%">
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>District:</td>
                                    <td>
                                        <select id="districts" class="form-control" style="width:100%"></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Upazila:</td>
                                    <td>
                                        <select @change="changeThana" id="thanas" class="form-control"
                                                style="width:100%"></select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="text-center bg-success" id="header-layer">
                        <button class="btn btn-link text-white" type="button" data-toggle="collapse"
                                data-target="#collapse-layer" aria-expanded="true" aria-controls="collapse-layer">
                            Map Layers
                        </button>
                    </div>
                    <div id="collapse-layer" class="collapse show" aria-labelledby="header-layer">
                        <div id="layertree" class="layertree"></div>
                    </div>
                </div>
            </div>

            <upazila-status v-if="selectedUpazila.code"></upazila-status>
            <div id="cropSuiteName" v-show="isCropNameShow"><span v-html="cropName"></span>
                <button type="button" class="close ml-2" style="font-size: 0.9rem" aria-label="Close"
                        @click="isCropNameShow=false">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="" id="map-containter" v-show="contentToShow === 'map'">
                <div id="toolbarWrap" class="row">
                    <div id="toolbar" class="toolbar">
                        <div class="collapse" id="collapsehelp">
                            <div class="btn-group btn-group-sm" role="group" aria-label="aria label">
                                <button id="rule" onclick="location.href='/rule/details'" class="btn btn-danger">Crop
                                    Limitation
                                </button>
                                <button id="framework" class="btn btn-success">Framework</button>
                                <button id="process" class="btn btn-info">Process</button>
                                <button id="codes" class="btn btn-warning">Codes</button>
                                <button id="issues" class="btn btn-primary" onclick="location.href='/comment'">
                                    Comments
                                </button>
                                <button id="contacts" class="btn btn-danger">Contacts</button>
                                <button id="contacts" class="btn btn-secondary" @click="showMobile"><span
                                        class="fa fa-mobile-alt fa-2x"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="map" class="map" ondrop="Drop(event)" ondragover="DragOver(event)"></div>
            </div>
            @auth
                <div id="updateSoilProps" class="contentStyle" v-if="contentToShow === 'soilprops'">
                    <div class="card">
                        <div class="card-header alert-primary font-weight-bold text-center">
                            Input Soil Parameter
                        </div>
                        <div class="card-body p-1">
                            <soil-parameter></soil-parameter>
                        </div>
                    </div>
                </div>
                <div id="updateLtArea" class="contentStyle" v-if="contentToShow === 'ltarea'">
                    <div class="alert alert-warning font-weight-bold text-center" role="alert">
                        Update Land Type Area
                    </div>
                    <lt-area></lt-area>
                </div>
                <div id="limitationRating" class="contentStyle" v-if="contentToShow === 'limitrating'">
                    <limit-ratings></limit-ratings>
                </div>
                <div id="limitationRule" class="contentStyle" v-if="contentToShow === 'limitrule'">
                    <limit-rules></limit-rules>
                </div>
                <div id="limitationRating" class="contentStyle" v-if="contentToShow === 'comment'">
                    <comments ref="commentsComp"></comments>
                </div>
            @endauth
        </div>

        <div id="status-bar" class="row">
            <div  class="text-left col-md-3 mystatus" style="padding-right: 25px"> 
            <span id="coordinates" ></span>
            </div>
        </div>
    </div>

    <div id="status-bar"  class="row">
            bottom footer
    </div>

@endsection
