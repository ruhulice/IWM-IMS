
<div id="rightSideBar" class="border-left" style="width:400px;">
    <ul class="nav nav-tabs mb-0" id="right-pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                title="Suitability Analysis" role="tab" aria-controls="pills-home" aria-selected="true"><span
                    class="fa fa-binoculars fa-1-5x"></span></a>
        </li>

        @if (!Auth::check())
        <li class="nav-item">
            <a class="nav-link" id="pills-crop-tab" data-toggle="pill" href="#pills-crop" role="tab" title="Crops"
                aria-controls="pills-crop" aria-selected="false"><span class="fa fa-globe-asia fa-1-5x"></span></a>
        </li>
        @endif

        @if (Auth::check())
        <li class="nav-item">
            <a class="nav-link" id="pills-suitability-tab" data-toggle="pill" href="#pills-suitability" role="tab"
                title="Upazila Shape file & Suitability Assessment" aria-controls="pills-suitability" aria-selected="false"><span
                    class="fa fa-chart-bar fa-1-5x"></span></a>

        </li>
        <li class="nav-item">

            <a style="padding:5px;" class="nav-link" id="pills-rating-tab" data-toggle="pill" href="#pills-rating"
                role="tab" title="Suitability Rating" aria-controls="pills-rating" aria-selected="false">&nbsp;
                <span><img src="/images/rating.svg" height="30px" alt="rating"> </span>&nbsp;</a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" title="Information"
                aria-controls="pills-info" aria-selected="false">&nbsp;<span
                    class="fa fa-info fa-1-5x"></span>&nbsp;</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                title="Meta Data" aria-controls="pills-profile" aria-selected="false"><span
                    class="fas fa-file-alt fa-1-5x"></span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="pills-download-tab" data-toggle="pill" href="#pills-download" role="tab"
                title="Download" aria-controls="pills-download" aria-selected="false"><span
                    class="fa fa-download fa-1-5x"></span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                title="Contact" aria-controls="pills-contact" aria-selected="false"><span
                    class="fa fa-envelope fa-1-5x"></span></a>
        </li>
    </ul>

    <div class="tab-content py-1" id="pills-tabContent" style="padding-left: 0.1rem; padding-right: 0.1rem">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="accordion" id="edaphic">
                <div class="card">
                    <div class="card-header text-center text-white bg-danger cursor-pointer" data-toggle="collapse"
                        data-target="#edaphicSuitability" aria-expanded="false" aria-controls="edaphicSuitability">
                        Suitability Analysis
                    </div>
                    <div style="margin:10px; display:none;">
                        <table>
                            <tr>
                                <td>Upazila:*</td>
                                <td>
                                    <input id="upazilaCode" name="upazilaCode" class="form-control"
                                        placeholder="must enter upazila code" type="text" required
                                        v-model="selectedUpazila.code">
                                    <div class="text-danger" style="display: none">Upazila code is
                                        required
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="edaphicSuitability" class="collapse show">
                        <analysis></analysis>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-upload" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="card">
                @auth
                <div class="card-header bg-primary text-center text-white cursor-pointer" data-toggle="collapse"
                    data-target="#uploadData" aria-expanded="true" aria-controls="uploadData">
                    Upload Agro-Edaphic Information
                </div>
                <div class="card-body collapse show px-2 py-3" id="uploadData">
                    <form action="/upload" method="POST" enctype="multipart/form-data" id="dataUploadForm">
                        @csrf
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Upazila:*</td>
                                    <td>
                                        <input id="upazilaCode" name="upazilaCode" class="form-control"
                                            placeholder="must enter upazila code" type="text" required
                                            v-model="selectedUpazila.code">
                                        <div class="text-danger" style="display: none">Upazila code is
                                            required
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shapefile:*</td>
                                    <td>
                                        <select class="form-control" name="shpType" required>
                                            <option selected="" disabled="" hidden="">Choose here</option>
                                            <option value="sop">Soil Map</option>
                                            <option value="sol">Soil Location Map</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <label for="fileToUploadCon" class="mt-1"> Upload Upazila Soil Map:</label>
                        <div id="fileToUploadCon" class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload"
                                    required>
                                <label class="custom-file-label" for="fileToUpload">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="btn btn-outline-success" type="submit" value="Upload" name="submit">
                            </div>
                        </div>
                    </form>
                    
                    <div class="btn-group btn-block mt-1" role="group" id="btn-soil-parameter-entry">
                        <button @click="contentToShow='soilprops'" type="button" class="btn btn-primary"
                            style="width: 60%;">Soil Parameter Entry
                        </button>
                        <button @click="contentToShow='map'" type="button" class="btn btn-warning"
                            style="width: 40%;">Go To Map
                        </button>
                    </div>
                    
                    <div class="card mt-1">
                        <div class="card-header text-dark" style="background-color: #a9d18e">
                            Generate Agro-Edaphic Parameters
                        </div>
                        <div class="card-body mt-1 p-2">
                            @if(auth()->user()->email=='usm@iwmbd.org')
                            <div class="mb-1">
                                <button class="btn btn-secondary" @click="updateEdaphicParameterAll">
                                    Calculate All
                                </button>
                            </div>

                            <div class="mb-1">
                                <button class="btn btn-success btn-sm" @click="updateEdaphicParameter">
                                    Extract from DEM
                                </button>
                                <span v-html="prog.extract"></span><br>
                            </div>
                            <div class="mb-1">
                                <button class="btn btn-primary btn-sm" @click="updateLandType">Assign
                                    Land Type
                                </button>
                                <span v-html="prog.landtype"></span><br>
                            </div>
                            <div class="mb-1">
                                <button class="btn btn-danger btn-sm" @click="updateSoilGroup">Assign
                                    Soil Group
                                </button>
                                <span v-html="prog.soilgroup"></span><br>
                            </div>
                            Merging: <span v-html="prog.merge"></span><br>
                            Inserting: <span v-html="prog.insert"></span><br>
                            <span v-if="prog.complete">All Process Completed <span
                                    class="fa fa-check-circle text-success"></span></span>
                            @endif
                            <div class="mb-1">
                                <button class="btn btn-success btn-sm" @click="updateEdaphicParameter">
                                    Update Upazila
                                </button>
                                <span v-html="prog.all"></span><br>
                            </div>
                        </div>
                    </div>
                </div>
                @endauth
            </div>

            <div class="card">
                <div class="card-header bg-success text-white cursor-pointer" data-toggle="collapse"
                    data-target="#climateUpload" aria-expanded="true" aria-controls="climateUpload">
                    Upload Climatic Information
                </div>

                <div class="card-body collapse show px-2 py-3" id="climateUpload">
                    @auth
                    <form action="" method="POST" enctype="multipart/form-data" id="dataUploadFormCli">
                        @csrf
                        <table width="100%">
                            <tbody>
                                <tr>
                                    <td>Agro-Climatic Shape:*</td>
                                    <td>
                                        <select class="form-control" name="shpType" required>
                                            <option selected="" disabled="" hidden="">Choose here</option>
                                            <option value="">Kharif/Rabi Growing Period</option>
                                            <option value="">Pre-Kharif Transition Period</option>
                                            <option value="">Cool Winter Zone (<15°C) </option>
                                            <option value="">Hot Summer Zone (>40°C)</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <label for="fileToUploadCon" class="mt-1"> Upload Climate Shape</label>
                        <div id="fileToUploadCon" class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUploadCli"
                                    required>
                                <label class="custom-file-label" for="fileToUploadCli">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input class="btn btn-outline-success" type="submit" value="Upload" name="submit">
                            </div>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            @auth

            <button id="limitRating" class="btn btn-block btn-danger" @click="contentToShow='limitrating'">
            Agro-Edaphic Limitation Rating
            </button>
            <button id="limitRule" class="btn btn-block btn-dark" @click="contentToShow='limitrule'">
            Agro-Edaphic Suitability Rule
            </button>

            @endauth
            <button id="framework" class="btn btn-block btn-success">Framework</button>
            <button id="process" class="btn btn-block btn-info">Process</button>
            <button id="codes" class="btn btn-block btn-warning">Codes</button>

            <button id="issues" class="btn btn-block btn-primary" @click="contentToShow = 'comment'">
                Comments
            </button>
            <button id="contacts" class="btn btn-block btn-danger">Contacts</button>
            <button id="mobile" class="btn btn-block btn-secondary" @click="showMobile"><span
                    class="fa fa-mobile-alt fa-2x"></span></button>
            <button id="metadataSeeAll" class="btn btn-block btn-info">Metadata</button>
        </div>

        <div class="tab-pane fade" id="pills-crop" role="tabpanel" aria-labelledby="pills-crop-tab">
            <div class="card">
                <div class="card-header text-center text-white bg-success cursor-pointer" data-toggle="collapse"
                    data-target="#cropDrop" aria-expanded="false" aria-controls="cropDrop">
                    Crops
                </div>

                <div class="card-body collapse px-2 py-3 show" id="cropDrop" style="padding: 0.2rem">
                    <div id="image-div">
                        <img id="61" class="pic" src="cz_assets/res/crops/01_paddy_aus.jpg" alt="crop image"
                            title="T. Aus (HYV)" draggable="true" ondragstart="drag(event)">
                        <img id="87" class="pic" src="cz_assets/res/crops/02_paddy_aman.jpg" alt="crop image"
                            title="T. Aman (HYV)" draggable="true" ondragstart="drag(event)">
                        <img id="1" class="pic" src="cz_assets/res/crops/03_paddy_boro.jpg" alt="crop image"
                            title="Boro (HYV)" draggable="true" ondragstart="drag(event)">
                        <img id="3" class="pic" src="cz_assets/res/crops/04_wheat.jpg" alt="crop image"
                            title="Wheat (HYV)" draggable="true" ondragstart="drag(event)">
                        <img id="6" class="pic" src="cz_assets/res/crops/05_maize.jpg" alt="crop image" title="Maize"
                            draggable="true" ondragstart="drag(event)">
                        <img id="22" class="pic" src="cz_assets/res/crops/07_mustard.jpg" alt="crop image"
                            title="Mustard" draggable="true" ondragstart="drag(event)">
                        <img id="12" class="pic" src="cz_assets/res/crops/08_potato.jpg" alt="crop image" title="Potato"
                            draggable="true" ondragstart="drag(event)">
                        <img id="36" class="pic" src="cz_assets/res/crops/09_pumpkin.jpg" alt="crop image"
                            title="Pumpkin" draggable="true" ondragstart="drag(event)">
                        <img id="75" class="pic" src="cz_assets/res/crops/10_cucumber.jpg" alt="crop image"
                            title="Cucumber" draggable="true" ondragstart="drag(event)">
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-suitability" role="tabpanel" aria-labelledby="pills-suitability-tab">
            <div class="accordion" id="suitability">
                <div class="card">
                    <div class="card-header text-center text-white bg-danger cursor-pointer" data-toggle="collapse"
                        data-target="#suitabilityInfo" aria-expanded="false" aria-controls="suitabilityInfo">
                        Upazila Shape file & Suitability Assessment
                    </div>
                    <div id="suitabilityInfo" class="collapse show">
                        <div class="card-body p-2">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>Division:</td>
                                        <td>
                                            <select id="divisions2" class="form-control" style="width:100%">
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>District:</td>
                                        <td>
                                            <select id="districts2" class="form-control" style="width:100%"></select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Upazila:</td>
                                        <td>
                                            <select @change="changeThana" id="thanas2" class="form-control"
                                                style="width:100%"></select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <suitability-assessment></suitability-assessment>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-rating" role="tabpanel" aria-labelledby="pills-rating-tab">
            <div class="accordion" id="rating">
                <div class="card">
                    <div class="card-header text-center text-white bg-danger cursor-pointer" data-toggle="collapse"
                        data-target="#ratingInfo" aria-expanded="false" aria-controls="ratingInfo">
                        Suitability Rating
                    </div>

                    <div id="ratingInfo" class="collapse show">
                        <suitability-rating></suitability-rating>
                    </div>

                    <div class="card-body collapse show px-2 py-3" id="uploadData">
                        <div class="btn-group btn-block mt-1" role="group" id="btn-soil-parameter-entry">
                            <button @click="contentToShow='soilprops'" type="button" class="btn btn-primary"
                                style="width: 60%;">Soil Parameter Entry
                            </button>
                            <button @click="contentToShow='map'" type="button" class="btn btn-warning"
                                style="width: 40%;">Go To Map
                            </button>
                        </div>

                        <form action="/upload" method="POST" enctype="multipart/form-data" id="dataUploadForm">
                            @csrf
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>Upazila:*</td>
                                        <td>
                                            <input id="upazilaCode" name="upazilaCode" class="form-control"
                                                placeholder="must enter upazila code" type="text" required
                                                v-model="selectedUpazila.code">
                                            <div class="text-danger" style="display: none">Upazila code is
                                                required
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shapefile:*</td>
                                        <td>
                                            <select class="form-control" name="shpType" required>
                                                <option selected="" disabled="" hidden="">Choose here</option>
                                                <option value="sop">Soil Map</option>
                                                <option value="sol">Soil Location Map</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <label for="fileToUploadCon" class="mt-1"> Upload Upazila Soil Map:</label>
                            <div id="fileToUploadCon" class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload"
                                        required>
                                    <label class="custom-file-label" for="fileToUpload">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <input class="btn btn-outline-success" type="submit" value="Upload" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
            <div class="accordion" id="info">
                <div class="card">
                    <div class="card-header text-center text-white bg-success cursor-pointer" data-toggle="collapse"
                        data-target="#cropInfo" aria-expanded="false" aria-controls="cropInfo">
                        Information
                    </div>
                    <div id="cropInfo" class="collapse show">
                        <div class="card-body p-2">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td>Division:</td>
                                        <td>
                                            <select id="divisions3" class="form-control" style="width:100%">
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>District:</td>
                                        <td>
                                            <select id="districts3" class="form-control" style="width:100%"></select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Upazila:</td>
                                        <td>
                                            <select id="thanas3" class="form-control" style="width:100%"></select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Union:</td>
                                        <td>
                                            <select id="union3" class="form-control" style="width:100%"></select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <information></information>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-calculate" role="tabpanel" aria-labelledby="pills-calculate-tab">
            <div class="card">
                <div class="card-header text-center w3-deep-orange">
                    Calculate
                </div>
                <div class="card-body p-1">
                    @auth()
                    <button id="limitRule" class="btn btn-block w3-khaki" @click="allSuitabilityByUpazila">Calculate
                    </button>
                    @if(auth()->user()->email=='usm@iwmbd.org')
                    <button id="limitRule" class="btn btn-block w3-purple" @click="allSuitabilityByUpazilaAll">
                        Calculate All
                    </button>
                    @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="card">
                <button id="feedback" class="card-header text-center text-white bg-info cursor-pointer">Send Feedback</button>
                <br />
                @if (Auth::check())
                @if (Auth::user()->role_id == 1)
                <button id="feedbackSeeAll" class="card-header text-center text-white bg-info cursor-pointer">All Feedback</button>
                <br />
                @endif   
                @endif 

                <div class="card-header text-center text-white bg-success cursor-pointer" data-toggle="collapse"
                    data-target="#contact" aria-expanded="false" aria-controls="contact">
                    Contact
                </div>

                <div class="card-body collapse px-2 py-3 show" id="contact" style="padding: 0.2rem">
                    <div id="image-div">
                        <div style="font-size:1.1em; line-height:30px;">
                            <b>Hasan Md. Hamidur Rahman</b> <br />
                            Director (Computer & GIS) <br />
                            Bangladesh Agricultural Research Council (BARC) <br />
                            <b>Email:</b> h.rahman@barc.gov.bd <br />
                            <b>Phone:</b> 880-2-58152275 <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-download" role="tabpanel" aria-labelledby="pills-download-tab">
            <div class="card">
                <div class="card-header text-center text-white bg-success cursor-pointer" data-toggle="collapse"
                    data-target="#download" aria-expanded="false" aria-controls="download">
                    Downloads
                </div>
                <div class="card-body collapse px-2 py-3 show" id="download" style="padding: 0.2rem">
                    <!-- download content -->
                    @if (Auth::check())
                    @if(\Helper::getAccess(9,"download"))
                    <div class="gis-download">
                        <div class="row m-1">
                            <div class="col-2">1</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Adivision_barc&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Division boundary</a> </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-2">2</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Adistrict_boundary_wgs&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> District boundary</a> </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-2">3</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_boundary_barc&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Upazila boundary</a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">4</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aunion_boundary_barc_new&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Union boundary</a> </div>
                        </div>


                        <div class="row m-1">
                            <div class="col-2">5</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Amauza_boundary_barc_new&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Mauza boundary</a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">6</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aacz&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> ACZ</a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">7</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aedaphic_data&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Miscellaneous Land</a> </div>
                        </div>
                        
                        <div class="row m-1">
                            <div class="col-2">8</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_sol&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Sample Location </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">9</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aedaphic_landtype&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Land Type </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">10</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_sop_a&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Upazila Sop </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">11</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aedaphic_soilgroup&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Group </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">12</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_texture&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Texture </a> </div>
                        </div>


                        <div class="row m-1">
                            <div class="col-2">13</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_consistency&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Consistency </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">14</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_drainage&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Drainage </a> </div>
                        </div>

                        <div class="row m-1">
                            <div class="col-2">15</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_reaction&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Reaction(pH) </a> </div>
                        </div>


                        <div class="row m-1">
                            <div class="col-2">16</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_moisture&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Moisture </a> </div>
                        </div>


                        <div class="row m-1">
                            <div class="col-2">17</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_salinity&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Salinity </a> </div>
                        </div> 


                        <div class="row m-1">
                            <div class="col-2">18</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_recession&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Water Recession </a> </div>
                        </div>


                        <div class="row m-1">
                            <div class="col-2">19</div>
                            <div class="col-10"><a
                                    href="{{ config('app.geoserver_base_url')}}/geoserver/wsBARC/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBARC%3Aupazila_soil_relief&outputFormat=SHAPE-ZIP">
                                    <span class="fa fa-download fa-1-2x p-2"></span> Soil Relief </a> </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
        <div id="messageBar" class="row text-center col-md-12" style="color:red;"></div>
    </div>
</div>
