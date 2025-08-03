var finalEnlishToBanglaNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};
 
String.prototype.getDigitBanglaFromEnglish = function() {
    var retStr = this;
    for (var x in finalEnlishToBanglaNumber) {
         retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
    }
    return retStr;
};

(function($){
	$.fn.serializeObject = function () {
		"use strict";

		var result = {};
		var extend = function (i, element) {
			var node = result[element.name];

	// If node with same name exists already, need to convert it to an array as it
	// is a multi-value field (i.e., checkboxes)

			if ('undefined' !== typeof node && node !== null) {
				if ($.isArray(node)) {
					node.push(element.value);
				} else {
					result[element.name] = [node, element.value];
				}
			} else {
				result[element.name] = element.value;
			}
		};

		$.each(this.serializeArray(), extend);
		return result;
	};
})(jQuery);
  

    $rivers=[];
    var geojsonStr;
    var pointLonlat;
    let draw = null, snap=null, drawing = null, lastDrown= null, attributeWindowOpen= false, featureType=''; 

      const geoServerBase = 'http://geo.iwmbd.com:8080/geoserver/';
      const gsWorkspace = 'wsIwmBase'; 
  
  
      const mousePositionControl = new ol.control.MousePosition({
        //coordinateFormat: createStringXY(4),
        projection: 'EPSG:4326',
        // comment the following two lines to have the mouse position
        // be placed within the map.
        className: 'custom-mouse-position',
        target: document.getElementById('lblLatLon'),
      });




      var layerGroupBase = new ol.layer.Group({
          'title': 'Base maps',
          layers: [
        //   new ol.layer.Tile({
        //       title: 'OSM',
        //     //   type: 'base',
        //       visible: true,
        //       source: new ol.source.OSM()
        //   }),
  
          new ol.layer.Tile({
              title: 'Satellite (Esri)',
              //type: 'base',
              visible: true,
              source: new ol.source.XYZ({
            //   attributions: ['Powered by Esri',
            //       'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'
            //   ],
              attributionsCollapsible: false,
              url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
              maxZoom: 23
              })
          })
          ]
      });
  
  
      var internationalBoundary =    new ol.layer.Tile({
          title: 'Int. Boundary',
          source: new ol.source.TileWMS({
          url: geoServerBase + gsWorkspace + '/wms',
          params: {'LAYERS': 'wsIwmBase:gis_boundary_international', 'TILED': true},
          serverType: 'geoserver',
          transition: 0,
          }),
      });


      var divisionBoundary =    new ol.layer.Tile({
        title: 'Divisoin Boundary',
        visible: true,
        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        //params: {'LAYERS': 'wsBARC:division_barc', 'TILED': true},
        params: {'LAYERS': 'wsDMMS:gis_boundary_division', 'TILED': true},
        projection: 'EPSG:4326',
        serverType: 'geoserver',
        transition: 0,
        }),
    });


    var districtBoundary =    new ol.layer.Tile({
        title: 'District Boundary',
        visible: false,
        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        //params: {'LAYERS': 'wsBase:district_boundary_wgs', 'TILED': true},
        params: {'LAYERS': 'wsDMMS:gis_boundary_district', 'TILED': true},
        projection: 'EPSG:4326',
        serverType: 'geoserver',
        transition: 0,
        }),
    });


  
      var upazilaBoundary =    new ol.layer.Tile({
          title: 'Upazila Boundary',
          visible: false,  
          source: new ol.source.TileWMS({
          url: 'http://geo.iwmbd.com:8080/geoserver/wms',
          //params: {'LAYERS': 'wsIwmBase:gis_boundary_upazila', 'TILED': true},
          params: {'LAYERS': 'wsDMMS:gis_boundary_upazila', 'TILED': true},
          projection: 'EPSG:4326',
          serverType: 'geoserver',
          transition: 0,
          }),
      });


      var unionBoundary =    new ol.layer.Tile({
        title: 'Union Boundary',
        visible: false,

        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        params: {'LAYERS': 'wsIwmBase:gis_boundary_union', 'TILED': true},
        projection: 'EPSG:4326',
        serverType: 'geoserver',
        transition: 0,
        }),
    });


    var mauzaBoundary =    new ol.layer.Tile({
        title: 'Mauza Boundary',
        visible: false,

        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        params: {'LAYERS': 'wsIwmBase:gis_boundary_mauza', 'TILED': true},
        projection: 'EPSG:4326',
        serverType: 'geoserver',
        transition: 0,
        }),
    });
  
  
  
      var layerGroupBoundary = new ol.layer.Group({
          'title': 'Juristics Boundary',
          //layers: [mauzaBoundary,unionBoundary,upazilaBoundary,districtBoundary,divisionBoundary,internationalBoundary]
          layers: [internationalBoundary,divisionBoundary,districtBoundary,upazilaBoundary,unionBoundary,mauzaBoundary]
      });
  
  
      var scanMap =    new ol.layer.Tile({
          visible:false,
          title: 'Scan Map',
          source: new ol.source.TileWMS({
          url: 'http://geo.iwmbd.com:8080/geoserver/wms',
          params: {'LAYERS':'wsDMMS:itabaria_tif', 'TILED': true},          
          serverType: 'geoserver',
          transition: 0,
          }),
      });

      var hatni =    new ol.layer.Tile({
        title: 'Plot Boundary',
        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        params: {'LAYERS':'wsDMMS:dha_dha_sin_098_000_rs_ml_updated', 'TILED': true},
        projection: 'ESRI:102941',
        serverType: 'geoserver',
        transition: 0,
        }),
    });
  
    var satImg =    new ol.layer.Tile({
        title: 'Land Use',
        source: new ol.source.TileWMS({
        url: 'http://geo.iwmbd.com:8080/geoserver/wms',
        params: {'LAYERS':'wsDMMS:dha_dha_sin_098_000_rs_mg', 'TILED': true},
        projection: 'ESRI:102941',
        serverType: 'geoserver',
        transition: 0,
        }),
    });

    // var hatni =    new ol.layer.Tile({
    //     title: 'Hatni Plot',
    //     source: new ol.source.TileWMS({
    //     url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //     params: {'LAYERS':'Hatni:dha_dha_sin_098_000_rs_mg', 'TILED': true},
    //     //projection: 'ESRI:102941',
    //     serverType: 'geoserver',
    //     transition: 0,
    //     }),
    // });
  
    // var satImg =    new ol.layer.Tile({
    //     title: 'Hatni Plot',
    //     source: new ol.source.TileWMS({
    //     url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //     params: {'LAYERS':'Hatni:dha_dha_sin_098_000_rs_ml_updated', 'TILED': true},
    //     projection: 'ESRI:102941',
    //     serverType: 'geoserver',
    //     transition: 0,
    //     }),
    // });

    //   var outfallPoint =    new ol.layer.Tile({
    //       title: 'Drain Outfall',
    //       source: new ol.source.TileWMS({
    //       url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //       //params: {'LAYERS': 'wsIwmBase:gis_drain_outfall', 'TILED': true},
    //       params: {'LAYERS':'wsRiverPolution:pollution_data', 'TILED': true},
    //       serverType: 'geoserver',
    //       transition: 0,
    //       }),
    //   });

    //   var khalLayer =    new ol.layer.Tile({
    //     title: 'Khal Layer',
    //     source: new ol.source.TileWMS({
    //     url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //     //params: {'LAYERS': 'wsIwmBase:gis_drain_outfall', 'TILED': true},
    //     params: {'LAYERS':'wsRiverPolution:khal_info', 'TILED': true},
    //     serverType: 'geoserver',
    //     transition: 0,
    //     }),
    //     });
    
    //     var projectArea =    new ol.layer.Tile({
    //         title: 'Project Area',
    //         source: new ol.source.TileWMS({
    //         url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //         params: {'LAYERS':'wsFFWC:project_extent', 'TILED': true},
    //         serverType: 'geoserver',
    //         transition: 0,
    //         }),
    //     });
    //     var forecast_stations =    new ol.layer.Tile({
    //         title: 'Forecast Stations',
    //         source: new ol.source.TileWMS({
    //         url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //         params: {'LAYERS':'wsFFWC:forecast_stations', 'TILED': true},
    //         serverType: 'geoserver',
    //         transition: 0,
    //         }),
    //     });
    //     var polder_bnd =    new ol.layer.Tile({
    //         title: 'Polder Boundary',
    //         source: new ol.source.TileWMS({
    //         url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //         params: {'LAYERS':'wsFFWC:polder_bnd', 'TILED': true},
    //         serverType: 'geoserver',
    //         transition: 0,
    //         }),
    //     });
    //     var selected_polders =    new ol.layer.Tile({
    //         title: 'Selected Polders',
    //         source: new ol.source.TileWMS({
    //         url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //         params: {'LAYERS':'wsFFWC:selected_polders', 'TILED': true},
    //         serverType: 'geoserver',
    //         transition: 0,
    //         }),
    //     });
    //     var water_level_bwdb =    new ol.layer.Tile({
    //         title: 'Water Level',
    //         source: new ol.source.TileWMS({
    //         url: 'http://geo.iwmbd.com:8080/geoserver/wms',
    //         params: {'LAYERS':'wsFFWC:water_level_bwdb', 'TILED': true},
    //         serverType: 'geoserver',
    //         transition: 0,
    //         }),
    //     });
      

      const source = new ol.source.Vector();
      const vector = new ol.layer.Vector({
        source: source,
        style: new ol.style.Style({
          fill: new ol.style.Fill({
            color: 'rgba(255, 255, 255, 0.2)',
          }),
          stroke: new ol.style.Stroke({
            color: '#ffcc33',
            width: 2,
          }),
          image: new ol.style.Circle({
            radius: 7,
            fill: new ol.style.Fill({
              color: '#ffcc33',
            }),
          }),
        }),
      });
  
  
      var layerGroupData = new ol.layer.Group({
          'title': 'Data layer',
          layers: [vector,scanMap,hatni,satImg]
          });
  
      var zoom = document.createElement('span');
     // zoom.innerHTML = '<img src="https://icons.iconarchive.com/icons/mazenl77/I-like-buttons-3a/512/Cute-Ball-Go-icon.png" width="100%" height="100%">';

      var map = new ol.Map({
          controls: ol.control.defaults().extend([mousePositionControl]),
          target: 'map',
          layers: [layerGroupBase, layerGroupBoundary, layerGroupData],
        //   controls: ol.control.defaults().extend([
        //     new ol.control.ZoomToExtent({'E': zoom})
        //   ]),
          view: new ol.View({
              center: ol.proj.fromLonLat([90.3783589, 23.6954955]),
              //center: ol.proj.fromLonLat([90.63442179811553, 22.15041416701378]),
              zoom: 7.3
          })
      });


      /* Map Drwaing interaciton part */
      const modify = new ol.interaction.Modify({source: source});
      map.addInteraction(modify);



      /* map resize rerander map */

      function updateMapSize(){
        //alert('w');
        setTimeout(function(){
            map.updateSize();
        },100);
        
    };

      function addAttibute(){
          if(featureType == 'line'){
            addAttibuteToDrawnLine();
          }
          else if(featureType =='point'){
            addAttibuteToDrawnPoint();
          }
      }

      function saveKhalInfo(){
          var khalName = $('#name').val();
          var riverId = $('#outfall_river_id').val();
          var pollution_record_id = $('#pollution_record_id').val();
          if(khalName == null || khalName == ''){
              toastr.warning('দয়া করে খালের নাম প্রবেশ করুন');
          }
          else if(riverId == null || riverId == ''){
            toastr.warning('দয়া করে নদী নির্বাচন করুন');
          }
          else{
             $.ajax({
                  url: '/saveKhalInfo',
                  type: 'POST',
                  data: {
                      "_token": $('#token').val(),
                     "Data":geojsonStr,
                     "name":khalName,
                     "outfall_river_id":riverId,
                     "pollution_record_id":pollution_record_id
                  },
                  success: function (data) {
                      if(data.Status){
                        toastr.success("তথ্য সফলভাবে সংরক্ষিত হয়েছে");
                        clearInteractions();
                      }
                      else{
                          toastr.error('তথ্য সংরক্ষণ করা যায়নি');
                      }
                  }
              });
          }
      }


      function clearInteractions(){
          $('.ui-dialog-titlebar-close').trigger('click');
            if (lastDrown) {
                source.removeFeature(lastDrown);
            }
            map.removeInteraction(snap);
            snap = null;
            map.removeInteraction(draw);
            draw = null;
            drawing = null;
            lastDrown = null;
            featureType= '';

            if(snap != null){
                $('.line-attr').removeClass('hidden');
            }
            else{
                $('.line-attr').addClass('hidden');
            }            
      }

      function addPointDrawingInteractions(){
        drawing = true;
        featureType='point';
        if(draw != null){
            removeDrawingInteraction();
            return;
        }
    
        draw = new ol.interaction.Draw({
          source: source,
          type: 'Point',
        });
        map.addInteraction(draw);
        snap = new ol.interaction.Snap({source: source});
        map.addInteraction(snap);
      
        draw.on('drawend', function (event) {
          lastDrown = event.feature;
          pointLonlat = ol.proj.transform(event.feature.A.geometry.flatCoordinates, 'EPSG:3857', 'EPSG:4326');
          drawing = null;

          addAttibuteToDrawnPoint();     
        });
      }
      
    function addLineDrawingInteractions() {
        drawing = true;
        featureType='line';
        if(draw != null){
            removeDrawingInteraction();
            return;
        }

        draw = new ol.interaction.Draw({
        source: source,
        type: 'LineString',
        });
        map.addInteraction(draw);
        snap = new ol.interaction.Snap({source: source});
        map.addInteraction(snap);
    
        draw.on('drawend', function (event) {
            lastDrown = event.feature;
        var features = vector.getSource().getFeatures();
        features = features.concat(lastDrown);
        var writer = new ol.format.GeoJSON();
        geojsonStr = writer.writeFeatures(features);
        drawing = null;
        addAttibuteToDrawnLine();     
        });
  }

  
  function addAttibuteToDrawnPoint(){
    attributeWindowOpen = true;
    $("#modalUI").dialog({
        modal: true,
        autoOpen: false,
        collapseEnabled: true,
        title: "",
        width: 700,
        height: 900,
        show: {
          effect: "blind",
          duration: 300
        },
        hide: {
          effect: "clip",
          duration: 200
        },
        close : function(){
            attributeWindowOpen = false;
            if(snap != null){
                $('.line-attr').removeClass('hidden');
            }
            else{
                $('.line-attr').addClass('hidden');
            }
        }  
      }).dialog("open");

    //   console.log('geojsonstr');
    //   console.log(geojsonStr);


      $html = `<style>.form-group{display:flex;} .control-label{width:40%;} .form-control,.select2{width:60% !important;}</style><form role="form" id="khal-info">
      <div class="form-group">
        <label class="control-label" for="inputSuccess">অবস্থানঃ <span class="asterisk">*</span></label>
        <input type="text" readonly="true" name="latlon" class="form-control" id="latlon" required value="">
      </div>
      <div class="form-group">
          <label class="control-label" for="inputSuccess">বিভাগঃ <span class="asterisk">*</span></label>
          <select id="Div" name="Div" class="form-control" style="width:100%"></select>
      </div>
      <div class="form-group">
          <label class="control-label" for="inputWarning">জেলাঃ <span class="asterisk">*</span></label>
          <select id="Dist" name="Dist" class="form-control" style="width:100%"></select>
          </select>
      </div>
      <div class="form-group">
          <label class="control-label" for="inputError">উপজেলা/সিটি কর্পোরেশনঃ <span class="asterisk">*</span> </label>
          <select id="Upz" name="Upz" class="form-control" style="width:100%"></select>
      </div>
      <div class="form-group">
        <label class="control-label" for="inputError">ইউনিয়ন/ওয়ার্ডঃ <span class="asterisk">*</span></label>
        <select id="Uni" name="Uni" class="form-control" style="width:100%"></select>
      </div>
      <div class="form-group">
        <label class="control-label" for="inputError">নদীর নামঃ <span class="asterisk">*</span></label>
        <select id="River" name="River" class="form-control" style="width:100%"></select>
      </div>
      <div class="form-group">
        <label class="control-label" for="inputError">খালের নামঃ <span class="asterisk">*</span></label>
        <select id="Khal" name="Khal" class="form-control" style="width:100%"></select>
      </div>
      <div class="form-group">
        <label class="control-label" for="inputError">দূষণের প্রকারভেদঃ <span class="asterisk">*</span></label>
        <select id="PType" name="PType" class="form-control" style="width:100%"></select>
      </div>
     <div class="form-group">
        <label class="control-label" for="inputError">দূষণের মাত্রাঃ <span class="asterisk">*</span></label>
        <select id="PLevel" name="PLevel" class="form-control" style="width:100%"></select>
     </div>
    <div class="form-group">
        <label class="control-label" for="inputError">দূষণের উৎসঃ <span class="asterisk">*</span></label>
        <select id="PSource" name="PSource" class="form-control" style="width:100%" multiple=""></select>
    </div>
    <div class="form-group">
        <label class="control-label" for="inputError">ছবি ১ঃ </label>
        <input type="file" id="ImageOne" name="ImageOne" class="form-control" style="width:100%;padding: 3px;"></input>
    </div>
    <div class="form-group">
        <label class="control-label" for="inputError">ছবি ২ঃ</label>
        <input type="file" id="ImageTwo" name="ImageTwo" class="form-control" style="width:100%;padding: 3px;"></input>
    </div>
    <div class="form-group">
        <label class="control-label" for="inputError">ছবি ৩ঃ </label>
        <input type="file" id="ImageThree" name="ImageThree" class="form-control" style="width:100%;padding: 3px;"></input>
    </div>
    <div class="form-group">
        <label class="control-label" for="inputError">ভিডিওঃ </label>
        <input type="file" id="Video" name="Video" class="form-control" style="width:100%;padding: 3px;"></input>
    </div>
      <button type="button" class="btn btn-primary btn-save-data" style="float:right;margin-left:15px;">সংরক্ষণ করুন</button>
      <button type="button" class="btn btn-danger btn-cancle-data-save" style="float:right">বাতিল করুন</button>
  </form>`;

  $('#modalUI').html($html);
  $('.ui-dialog-title').html('দূষণের তথ্য যোগ করুন');


  $('.btn-save-data').on('click',function(){
    savPollutionInfo();
  });

  $('.btn-cancle-data-save').on('click',function(){
    $('.ui-dialog-titlebar-close').trigger('click');
    clearInteractions();
  });
  
  var inputDiv = $('#Div');
  var inputDist = $('#Dist');
  var inputThana = $('#Upz');
  var inputUni = $('#Uni');
  var inputRivers = $('#River');
  var inputKhal = $('#Khal');
  var inputPType = $('#PType');
  var inputPSource = $('#PSource');
  var inputPLevel = $('#PLevel');


  $locationInfo=null;

  $('#latlon').val(pointLonlat[0]+','+pointLonlat[1]);
  $.blockUI({ message: '<img src="/images/preloader.gif" />' });
  $.ajax({
    url: '/api/mobile/location/'+pointLonlat[0]+'/'+pointLonlat[1],
    type: 'GET',
    success: function (data) {
        $locationInfo = data;
        $locationInfo.divCode= $locationInfo.geocode.substring(0, 2);
        $locationInfo.distCode= $locationInfo.geocode.substring(0, 4);
        $locationInfo.upzCode= $locationInfo.geocode.substring(0, 6);
        $locationInfo.uniCode= $locationInfo.geocode.substring(0, 8);
        console.log($locationInfo);
        pupulateCascadedropdowns();
    }
  });


  removeDrawingInteraction();

    if(snap != null){
        $('.line-attr').removeClass('hidden');
    }
    else{
        $('.line-attr').addClass('hidden');
    }
  }

  $divName='';
  $distName='';
  $upzName='';
  $uniName='';
  $mouzaName='';


  function updateLocationBC(){
    var inputDiv = $('#Div');
    var inputDist = $('#Dist');
    var inputThana = $('#Upz');
    var inputUni = $('#Uni');
    var inputMouza = $('#Mouza');
    var inputPlot = $('#Plot');

    
    var text  = '';
    $divName = $( "#Div option:selected" ).text();
    if(inputDiv.val() != null){
        text +='<span class="breadcrumb-item">বিভাগঃ '+$divName+'</span>';
    }
    $distName = $( "#Dist option:selected" ).text();
    if(inputDist.val() != null){
        text +='<span class="breadcrumb-item">জেলাঃ'+$distName+'</span>';
    }
    $upzName = $( "#Upz option:selected" ).text();
    if(inputThana.val() != null){
        text +='<span class="breadcrumb-item">উপজেলাঃ '+$upzName+'</span>';
    }
    $uniName = $( "#Uni option:selected" ).text();
    if(inputUni.val() != null){
        text +='<span class="breadcrumb-item">ইউনিয়নঃ '+$uniName+'</span>';
    }
    $mouzaName = $( "#Mouza option:selected" ).text();
    if(inputMouza.val() != null){
        text +='<span class="breadcrumb-item">মৌজাঃ '+$mouzaName+'</span>';
    }
    $('#geoLocationBC').html(text);
  }


  function pupulateCascadedropdowns(){

    var formatWKT = new ol.format.WKT();

    var inputDiv = $('#Div');
    var inputDist = $('#Dist');
    var inputThana = $('#Upz');
    var inputUni = $('#Uni');
    var inputMouza = $('#Mouza');
    var inputPlot = $('#Plot');

    $.ajax({
        url: '/getAdminByCode',
        type: 'POST',
        data: {
            level: 'forDiv',
            column: 'division_n',
            "_token": $('#token').val()
        },
        
        success: function (data) {
            inputDiv.html('');
            inputDiv.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
            data.forEach(function (d) {
                var opt = $("<option></option>").attr("value", d.code).text(d.name_bn);
                inputDiv.append(opt);
            });
            if(typeof($locationInfo) != 'undefined' && $locationInfo != null){
                $(inputDiv).val($locationInfo.divCode).trigger('change'); 
            }
        }
    });

    var myStyle = new ol.style.Style({
        fill: new ol.style.Fill({
           color: 'rgba(255, 255, 255, 0.4)',
         }),
        stroke:new ol.style.Stroke({
           color: '#088dcf7d',
           width: 1,
         }),
       text: new ol.style.Text({
         font: '12px Calibri,sans-serif',
         fill: new ol.style.Fill({
           color: '#FFFFFF'
         }),
         stroke: new ol.style.Stroke({
            color: '#000000',
            width: 5
        }),
       })
     });

     var highlightedStyle = new ol.style.Style({
        fill: new ol.style.Fill({
           color: 'rgba(255, 255, 255, 0.4)',
         }),
        stroke:new ol.style.Stroke({
           color: '#FF9F29',
           width: 2,
         }),
       text: new ol.style.Text({
         font: '12px Calibri,sans-serif',
         fill: new ol.style.Fill({
           color: '#FFFFFF'
         }),
         stroke: new ol.style.Stroke({
            color: '#000000',
            width: 5
        }),
       })
     });
  
    //------District----------------
    $('#Div').change(function (evt) {
        // console.log('dfa');
        inputDist.html('');
        inputThana.html('');
        inputUni.html('');
        inputMouza.html('');
        inputPlot.html();

        updateLocationBC();
        
        $.ajax({
            url: '/getAdminByCode',
            type: 'POST',
            data: {
                level: 'forDist',
                'division_code': inputDiv.val(),
                "_token": $('#token').val()
            },
            success: function (dataDist) {
                inputDist.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
                dataDist.forEach(function (dist) {
                    var optdist = $("<option></option>").attr("value", dist.code).text(dist.name_bn);
                    inputDist.append(optdist);
  
                });
                if(typeof($locationInfo) != 'undefined' && $locationInfo != null){
                    $(inputDist).val($locationInfo.distCode).trigger('change');
                }
            }
        });

        
        $.ajax({
            type: 'POST',
            url: '/getGeomByCode',
            data: {
                level: 'forDiv',
                tableName: 'gis_boundary_division',
                divVal: inputDiv.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                var label = data.label;
                data = data.geom;
                globalLayer.getSource().clear();
                if (formatWKT.readFeatures(data)) {                        
                    formatWKT.readFeatures(data, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    }).forEach(function (ft) {
                        
                         myStyle.getText().setText(label);
                         ft.setStyle(myStyle);
                        globalLayer.getSource().addFeature(ft);
                    });
                }
                var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(), 40000);
                map.getView().fit(extent, map.getSize());
            }
        });
    });
    //---------District----------------
  
    //---------thana----------------
    $('#Dist').change(function (evt) {
        inputThana.html('');
        inputUni.html('');
        inputMouza.html('');
        inputPlot.html();
        updateLocationBC();
        $.ajax({
            url: 'getAdminByCode',
            type: 'POST',
            data: {
                level: 'forThana',
                'division_code': inputDiv.val(),
                'district_code': inputDist.val(),
                "_token": $('#token').val()
            },
            success: function (dataThana) {
  
              inputThana.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
                dataThana.forEach(function (thana) {
                    var opt = $("<option></option>").attr("value", thana.code).text(thana.name_bn);
                    inputThana.append(opt);
                });
  
                if(typeof($locationInfo) != 'undefined' && $locationInfo != null){
                    $(inputThana).val($locationInfo.upzCode).trigger('change');
                }
  
            }
        });


        $.ajax({
            type: 'POST',
            url: 'getGeomByCode',
            data: {
                level: 'forDist',
                tableName: 'gis_boundary_district',
                divVal: inputDiv.val(),
                distVal: inputDist.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                var label = data.label;
                data = data.geom;               
                globalLayer.getSource().clear();
                console.log(data);
                if (formatWKT.readFeatures(data)) {                        
                    formatWKT.readFeatures(data, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    }).forEach(function (ft) {
                         
                         myStyle.getText().setText(label);
                         ft.setStyle(myStyle);
                        globalLayer.getSource().addFeature(ft);
                    });
                }
                var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(), 30000);
                map.getView().fit(extent, map.getSize());
            }
        });

    });
  
  
    $('#Upz').change(function (evt) {
        inputUni.html('');
        inputMouza.html('');
        inputPlot.html();
        updateLocationBC();
        $.ajax({
            url: 'getAdminByCode',
            type: 'POST',
            data: {
                level: 'forUnion',
                'division_code': inputDiv.val(),
                'district_code': inputDist.val(),
                'thana_code': inputThana.val(),
                "_token": $('#token').val()
            },
            success: function (dataUni) {
  
              inputUni.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
              dataUni.forEach(function (uni) {
                    var opt = $("<option></option>").attr("value", uni.code).text(uni.name_bn);
                    inputUni.append(opt);
                });
                //$.unblockUI();
                if(typeof($locationInfo) != 'undefined' && $locationInfo != null){
                    $(inputUni).val($locationInfo.uniCode).trigger('change');
                }
            },
            error:function(){
               // $.unblockUI();
            }
        });

        $.ajax({
            type: 'POST',
            url: 'getGeomByCode',
            data: {
                level: 'forThana',
                tableName: 'gis_boundary_upazila',
                thanaVal: inputThana.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                var label = data.label;
                data = data.geom;
                globalLayer.getSource().clear();
                if (formatWKT.readFeatures(data)) {                        
                    formatWKT.readFeatures(data, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    }).forEach(function (ft) {
                         myStyle.getText().setText(label);
                         ft.setStyle(myStyle);
                        globalLayer.getSource().addFeature(ft);
                    });
                }
                var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(), 20000);
                map.getView().fit(extent, map.getSize());
            }
        });
    });


    $('#Uni').change(function (evt) {
        inputMouza.html('');
        inputPlot.html();
        updateLocationBC();
        $.ajax({
            url: 'getAdminByCode',
            type: 'POST',
            data: {
                level: 'forMauza',
                'division_code': inputDiv.val(),
                'district_code': inputDist.val(),
                'thana_code': inputThana.val(),
                'uni_code': inputUni.val(),
                "_token": $('#token').val()
            },
            success: function (dataMouza) {
  
              inputMouza.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
              dataMouza.forEach(function (item) {
                    var opt = $("<option></option>").attr("value", item.code).text(item.name_bn);
                    inputMouza.append(opt);
                });
                //$.unblockUI();
                if(typeof($locationInfo) != 'undefined' && $locationInfo != null){
                    $(inputMouza).val($locationInfo.uniCode).trigger('change');
                }
            },
            error:function(){
                //$.unblockUI();
            }
        });

        $.ajax({
            type: 'POST',
            url: 'getGeomByCode',
            data: {
                level: 'forUnion',
                tableName: 'gis_boundary_union',
                unionVal: inputUni.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                var label = data.label;
                data = data.geom;
                globalLayer.getSource().clear();
                console.log(data);
                if (formatWKT.readFeatures(data)) {                        
                    formatWKT.readFeatures(data, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    }).forEach(function (ft) {

                         myStyle.getText().setText(label);
                         ft.setStyle(myStyle);
                        globalLayer.getSource().addFeature(ft);
                    });
                }
                var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(), 10000);
                map.getView().fit(extent, map.getSize());
            }
        });
    });


    $('#Mouza').change(function (evt) {
        inputPlot.html();
        updateLocationBC();

        $.ajax({
            type: 'POST',
            url: 'getGeomByCode',
            data: {
                level: 'forMauza',
                tableName: 'gis_boundary_mauza',
                //tableName: 'barishal_patuakhali_patuakhalisadar',
                mauzaVal: inputMouza.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
               // console.log(data.length);
                globalLayer.getSource().clear();
                for(var i=0; i<data.length; i++){
                    var dt = data[i].geom;
                   
                    //console.log(data[i]);
                    if (formatWKT.readFeatures(dt)) {                        
                        formatWKT.readFeatures(dt, {
                            // dataProjection: 'EPSG:4326',
                            // featureProjection: 'EPSG:3857'
    
                             dataProjection: 'EPSG:4326',
                             featureProjection: 'EPSG:4326'
                            //dataProjection: 'ESRI:102941',
                            //featureProjection: 'EPSG:4326'
                        }).forEach(function (ft) {
                            //console.log(ft);
                            var label = data[i].label;
                            console.log(data[i]);
                            //Populate Plot Dropdown
                            inputPlot.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
                            var opt = $("<option></option>").attr("value", data[i].gid).text('প্লট - '+label);
                            inputPlot.append(opt);

                            var myStyle = new ol.style.Style({
                                fill: new ol.style.Fill({
                                   color: 'rgba(255, 255, 255, 0.4)',
                                 }),
                                stroke:new ol.style.Stroke({
                                   color: '#088dcf7d',
                                   width: 1,
                                 }),
                               text: new ol.style.Text({
                                 font: '12px Calibri,sans-serif',
                                 fill: new ol.style.Fill({
                                   color: '#FFFFFF'
                                 }),
                                 stroke: new ol.style.Stroke({
                                    color: '#000000',
                                    width: 5
                                }),
                               })
                             });
                           
                             Object.entries(data[i]).forEach(([key, value]) => {
                                if(key != 'geom'){
                                    ft.set(key,value);
                                }                                
                             });
                             myStyle.getText().setText(label);
                             ft.setStyle(myStyle);
                            
                            globalLayer.getSource().addFeature(ft);
                        });
                    }

                    if(i == 0){
                        var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(),1000);
                        // var resolution =  map.getView().getResolutionForExtent(extent);
                        // var zoom =  map.getView().getZoomForResolution(resolution);
                        // var center = ol.extent.getCenter(extent);
                        // console.log(resolution);
                        // console.log(zoom);
                        // console.log(center);
                        map.getView().fit(extent, map.getSize());
                    }
                }
                
               
            }
        });

    });


    $('#Plot').change(function (evt) {
        updateLocationBC();

        $.ajax({
            type: 'POST',
            url: 'getGeomByCode',
            data: {
                level: 'forPlot',
                tableName: 'itabaria_geo',
                plotVal: inputPlot.val(),
                "_token": $('#token').val()
            },
            success: function (data) {
                highlightedLayer.getSource().clear();
                
                var label = data.label;
                data = data.geom;
                console.log(data);
                if (formatWKT.readFeatures(data)) {                        
                    formatWKT.readFeatures(data, {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:4326'
                    }).forEach(function (ft) {

                        highlightedStyle.getText().setText(label);
                         ft.setStyle(highlightedStyle);
                         highlightedLayer.getSource().addFeature(ft);
                    });
                }
                var extent = ol.extent.buffer(highlightedLayer.getSource().getFeatures()[0].getGeometry().getExtent(), 200);
                map.getView().fit(extent, map.getSize());
            }
        });

    });
  
  }

  function addAttibuteToDrawnLine(){
    attributeWindowOpen = true;
    $("#modalUI").dialog({
        modal: true,
        autoOpen: false,
        collapseEnabled: true,
        title: "",
        width: 500,
        height: 365,
        show: {
          effect: "blind",
          duration: 300
        },
        hide: {
          effect: "clip",
          duration: 200
        },
        close : function(){
            attributeWindowOpen = false;
            if(snap != null){
                $('.line-attr').removeClass('hidden');
            }
            else{
                $('.line-attr').addClass('hidden');
            }
        }  
      }).dialog("open");


      $html = `<form role="form" id="khal-info">
      <div class="form-group">
          <label class="control-label" for="inputSuccess">খালের নামঃ <span class="asterisk">*</span></label>
          <input type="text" name="name" class="form-control" id="name" required>
      </div>
      <div class="form-group">
          <label class="control-label" for="inputWarning">সংযুক্ত নদীর নামঃ <span class="asterisk">*</span></label>
          <select id="outfall_river_id" name="outfall_river_id" class="form-control" style="width:100%">
          </select>
      </div>
      <div class="form-group">
          <label class="control-label" for="inputError">নদী দূষণের অবস্থানঃ  </label>
          <input type="text" name="pollution_record_id" class="form-control" id="pollution_record_id">
      </div>
      <button type="button" onclick="saveKhalInfo()" class="btn btn-primary pull-right">সংরক্ষণ করুন</button>
  </form>`;

  $('#modalUI').html($html);
  $('.ui-dialog-title').html('খালের তথ্য যোগ করুন');

  var reiver = $('#outfall_river_id');
  reiver.append('<option selected disabled hidden value="">নির্বাচন করুন</option>');
  $rivers.forEach(function (d) {
    var opt = $("<option></option>").attr("value", d.gid).text(d.river_nm);
    reiver.append(opt);
    });

  $(reiver).select2({ theme: 'bootstrap-5',dropdownParent: $("#modalUI")});
  //$('.ui-widget-overlay').css('display','none');
  removeDrawingInteraction();

    if(snap != null){
        $('.line-attr').removeClass('hidden');
    }
    else{
        $('.line-attr').addClass('hidden');
    }
  }

  function removeDrawingInteraction(){
    if(draw != null){
        map.removeInteraction(draw);
        draw = null;
    }
  }
  
/* End of drwaing interaction */




      var zoomToExtentControl = new ol.control.ZoomToExtent({
        extent: [9802861.639, 2326387.771, 10338532.333, 3060183.243],
      });
      map.addControl(zoomToExtentControl);



      var vectorSource = new ol.source.Vector({
        features: []
    });

    var vectorSourceHighlight = new ol.source.Vector({
        features: []
    });

    var globalLayer = new ol.layer.Vector({
        source: vectorSource
    });
    map.addLayer(globalLayer);

    var highlightedLayer = new ol.layer.Vector({
        source: vectorSourceHighlight
    });
    map.addLayer(highlightedLayer);
  
      var layerSwitcher = new ol.control.LayerSwitcher({
          activationMode: 'click',
          //startActive: true,
          tipLabel: 'Layers', // Optional label for button
          groupSelectStyle: 'children', // Can be 'children' [default], 'group' or 'none'
          collapseTipLabel: 'Collapse layers',
      });
      map.addControl(layerSwitcher);
  
  

  
  
  
  
      //map.addLayer(connectionPoint);
  
      //var connectionPointJsonLink = "http://geo.iwmbd.com:8080/geoserver/wsBase/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=wsBase%3Agov_circuithouse&maxFeatures=50&outputFormat=application%2Fjson";
      //var connectionPointVectorSource = new ol.source.Vector({
      //    url: connectionPointJsonLink,
      //    format: new ol.format.GeoJSON()
      //});
          
  
      /**
      * Elements that make up the popup.
      */
      const container = document.getElementById('popup');
      const content = document.getElementById('popup-content');
      const closer = document.getElementById('popup-closer');
  
  
  
      /**
      * Create an overlay to anchor the popup to the map.
      */
      const overlay = new ol.Overlay({
      element: container,
      autoPan: {
          animation: {
          duration: 250,
          },
      },
      });
  
      /**
      * Add a click handler to hide the popup.
      * @return {boolean} Don't follow the href.
      */
      closer.onclick = function () {
      overlay.setPosition(undefined);
      closer.blur();
      return false;
      };
  
      map.addOverlay(overlay);


      function showOwnerInfo(OwnerName,Khatian,Share){

        //$ownerInfo = JSON.parse(jsonst);

        $landSizeShare = parseFloat($khatianValue * Share).toFixed(2).getDigitBanglaFromEnglish();
        $("#modalUI").dialog({
            modal: true,
            autoOpen: false,
            collapseEnabled: true,
            title: "",
            width: 1000,
            //height: 300,
            show: {
              effect: "blind",
              duration: 300
            },
            hide: {
              effect: "clip",
              duration: 200
            } 
          }).dialog("open");
    
          $html = `<div class="card" style="    width: 100%;
          text-align: center;
          padding-bottom: 2px;">
          <img src="/assets/media/nid_.png" class="card-img-top" alt="NID Card" style="border: 5px solid #ddd;">
          </div><hr/>`;

          $html += `
          <style>
    .dotted_botton {
    border-bottom: 1px dotted #000;
    background-color: #fff;
}
table{
    font-size: 13px !important;
}
#tblCollection{
    border-spacing: 0;
    border-collapse: collapse;
    width: 100%;
}
#tblCollection td, #tblCollection th, #tblCollection tr{
   border: 1px solid #ddd;

}
.qr_code{
    margin-top:-100px;
}
p {
    margin-top: 0;
    margin-bottom: 0.5rem !important;
}

hr {
    margin-top: 0.25rem;
    margin-bottom: 0.25rem;
    border: 0;
    border-top: 1px solid #e4e7ed;
}
</style>
<div>
    <div class="portlet-body">
        <div style="font-family: 'kalpurush',Arial,sans-serif;font-size: 13px !important;line-height: 1.2;color: #333;background-color: #fff;" class="printDiv" id="mydiv">
            <div>
                <div>
                    <div>বাংলাদেশ ফরম নং ১০৭৭</div>
                    <div style="margin-left: 40px;">(সংশোধিত)</div>
                </div>
                <div align="right" style="margin-top: -30px">
                    (পরিশিষ্ট: ৩৮)                        <br>
                    <span class="input_bangla">ক্রমিক নং 261622002844</span>
                </div>
            </div>
            <br>
            <div align="center">
                <div>ভূমি উন্নয়ন কর পরিশোধ রসিদ</div>
                <div>(অনুচ্ছেদ ৩৯২ দ্রষ্টব্য)</div>
            </div>
            <br>
            <table width="100%">
                <tbody><tr>
                    <td>সিটি কর্পোরেশন /পৌর /ইউনিয়ন ভূমি অফিসের নাম  </td>
                    <td class="dotted_botton" width="75%">রামচন্দ্রপুর ভূমি অফিস</td>
                </tr>
            </tbody></table>
            <table style="margin-top:5px;" width="100%">
                <tbody><tr>
                    <td>মৌজার ও জে. এল. নং:</td>
                    <td class="dotted_botton" width="50%" style="padding-left: 10px;">১</td>
                    <td>উপজেলা / থানা  </td>
                    <td width="30%" class="dotted_botton" style="padding-left: 10px;">`+$upzName+`</td>
                </tr>
            </tbody></table>

            <table style="margin-top:5px;" width="100%">
                <tbody><tr>
                    <td>জেলা:</td>
                    <td class="dotted_botton" width="35%" style="padding-left: 10px;">`+$distName+`</td>
                    <td>মালিকের নাম </td>
                    <td width="50%" class="dotted_botton" style="padding-left: 10px;">
                    `+OwnerName+`                        </td>
                </tr>
            </tbody></table>

            <table style="margin-top:5px;" width="100%">
                <tbody><tr>
                    <td>২ নং রেজিস্টার অনুযায়ী হোল্ডিং নম্বার</td>
                    <td class="dotted_botton numeric_bangla" width="80%" style="padding-left: 10px;">
                        164/11                        </td>
                </tr>
            </tbody></table>

            <table style="margin-top:5px;" width="100%">
                <tbody><tr>
                    <td>জমির শ্রেণী</td>
                    <td width="93%" class="dotted_botton" style="padding-left: 10px;">
                        `+$landUse+`</td>
                </tr>
                <tr>
                    <td>খতিয়ান নং</td>
                    <td width="90%" class="dotted_botton" style="padding-left: 10px;">
                        `+Khatian.getDigitBanglaFromEnglish()+`                        </td>
                </tr>
            </tbody></table>

            <table style="margin-top:5px;" width="100%">
                <tbody><tr>
                    <td width="5%">দাগ নং</td>
                    <td width="93%" class="dotted_botton" style="padding-left: 10px;">
                       `+$plotNo+`                      </td>
                </tr>
                <tr>
                    <td width="10%">জমির পরিমাণ (শতক)</td>
                    <td width="93%" class="dotted_botton" style="padding-left: 10px;">
                    `+ $landSizeShare+`                        </td>
                </tr>
            </tbody></table>

            <br>
            <br>
            <table id="tblCollection">
                <tbody><tr>
                    <th style="text-align: center;" colspan="8">আদায়ের বিবরণ </th>
                </tr>
                <tr>
                    <th style="text-align: center;">তিন বৎসরের ঊর্ধ্বের বকেয়া</th>
                    <th style="text-align: center;">গত তিন বৎসরের বকেয়া
                    </th>
                    <th style="text-align: center;">বকেয়ার সুদ ও ক্ষতিপূরণ
                    </th>
                    <th style="text-align: center;">হাল দাবি
                    </th>
                    <th style="text-align: center;">মোট দাবি</th>
                    <th style="text-align: center;">মোট আদায়
                    </th>
                    <th style="text-align: center;">মোট বকেয়া</th>
                    <th style="text-align: center;">মন্তব্য</th>
                </tr>

                    <tr>
                        <!-- <td align="center" class="numeric_bangla"></td> -->
                        <td align="center">০</td>
                        <td align="center">০</td>
                        <td align="center">০</td>
                        <td align="center">১২০</td>
                        <td align="center">
                            ১২০</td>
                        <td align="center">১২০</td>
                        <td align="center">
                            ০
                        </td>
                        <td align="center"></td>

                    </tr>
            </tbody></table>
            <div class="row">
                <div class="col-md-12">
                    <p class="dotted_botton"> সর্বমোট (কথায়):
                                                    এক শত বিশ টাকা মাত্র ।
                    </p>
                </div>
            </div>
            <div>
                <div>
                    <p style="margin: 0 !important;">
                        নোট: সর্বশেষ কর পরিশোধের সাল - ১৪২৯                        </p>
                </div>
            </div>
            <div>
                <div align="left">
                    <p class="input_bangla">চালান নং : 2122-0005039909</p>
                    <p>
                        তারিখ : </p><div style="margin-top: -32px;margin-left: 10px;"><p style="width: 93px;padding: 0;margin: 0;margin-left: 38px;margin-bottom: 2px;">২৩ বৈশাখ ১৪২৯</p><span style="border-top:1px solid;margin-left:36px;">০৬ মে, ২০২২</span><p></p></div>

                </div>
                <div class="qr_code" align="center">
                    <img src="/assets/media/qr.png" width="100" height="100">
                </div>
                <div style=" float: right; text-align: right;font-size: 12px;font-family: 'kalpurush',Arial,sans-serif; margin-top:-80px;">
                        <p class="text-center" style="padding: 5px; ">এই দাখিলা ইলেক্ট্রনিকভাবে তৈরি করা হয়েছে, <br> কোন স্বাক্ষর প্রয়োজন নেই।</p>
                </div>
            </div>
        </div>
    </div>
</div>

                `;

        //   <div class="card-body">
        //     <h5 class="card-title">Card title</h5>
        //     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        //     <a href="#" class="btn btn-primary">Go somewhere</a>
        //   </div>
    
        $('#modalUI').html($html);
        $('.ui-dialog-title').html('Owner Information: Dummy');
    
      }


      $ownerInfo = null;
      function changeTab(id,e){
        $('.nav-link').removeClass('active');
        // $('.tab-pane').removeClass('show active');
        // $(id).addClass('show active');
        $(e).addClass('active');

        var id = id.replace('#','');
        var dhtml = `<table class="table table-bordered table-stripped"><tbody><tr><th>মালিকের নাম</th><th>অংশ</th><th>জমির পরিমাণ</th></tr>`;
        $.ajax({
            url: '/assets/js/khatian.js',
            type: 'GET',
            success: function (data) {
                var data = JSON.parse(data);
                data = data.filter((item)=>item.Khatian == id);
                data.forEach(element => {
                    console.log(element);
                    var shareArea = parseFloat(element.Share * $khatianValue).toFixed(2);
                    //$ownerInfo = element;
                    var st = JSON.stringify(JSON.stringify(element));
                    dhtml +=`<tr><td><a href="#" role="button" onclick="showOwnerInfo(\'`+element.OwnerName+`\',\'`+element.Khatian+`\',`+element.Share+`)">`+element.OwnerName+`</a></td><td>`+element.Share.getDigitBanglaFromEnglish()+`</td><td>`+shareArea.getDigitBanglaFromEnglish()+`  শতক</td></tr>`;
                });

                dhtml+=`</tbody></table>`;  

                var html='';
                html += `
                <h6 style="margin-bottom:10px;color:#ff9900;margin-top:5px;">খাতিয়ান `+id.getDigitBanglaFromEnglish()+`   মালিকানা তথ্যঃ         &nbsp;&nbsp; <span style="color:red">`+$khatianValue.getDigitBanglaFromEnglish()+` শতক</span><button type="button" title="Print khatian" onclick="printKhatian(`+id+`)" class="btn btn-outline-primary" style="float:right; margin-top:-5px;"><i class="fa fa-print"></i></button></h6>
                <div class="col-md-12" style="padding:0px; min-height:50px; margin-bottom:10px;">`+dhtml+`</div>`;
                $('#khatianDetails').html(html);
            }
        });
        
      }



function printKhatian(id){

    $dagtBn = id;
    $owners ='অকৃষি প্রজা </br>সাং ';
    $shares = '&nbsp;</br>';
    $dagNo = '&nbsp;</br>'+$dagtBn;
    $khatianOngsho = '&nbsp;</br>৩৩.৩';
    $sharesLandSize = '&nbsp;</br>';

    $.ajax({
        url: '/assets/js/khatian.js',
        type: 'GET',
        success: function (data) {
            var data = JSON.parse(data);
            data = data.filter((item)=>item.Khatian == id);
            data.forEach(element => {
                var shareArea = parseFloat(element.Share * $khatianValue).toFixed(2);
                $owners += element.OwnerName+'</br>';
                $shares += element.Share+'</br>';
                $sharesLandSize += shareArea+'</br>';              
                $plotSize = parseFloat($khatianValue*3).toFixed(2);
                
                var html = `<section>
                <h3 style="text-align:center;">খতিয়ান নং - <span id="ktNo">`+id+`</span></h3>

                <div style="width:100%; display:inline">
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">বিভাগঃ <span id="ktDiv">`+$divName+`</span></p>
                    </div>
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">জেলাঃ <span id="ktDist">`+$distName+`</span></p>
                    </div>
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">থানাঃ <span id="ktThana">`+$upzName+`</span></p>
                    </div>
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">মৌজাঃ <span id="ktMauza">`+$mouzaName+`</span></p>
                    </div>
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">জে, এল, নংঃ <span id="ktJl">১</span></p>
                    </div>
                    <div style="width:16%; float:left">
                    <p class="u-custom-item u-text u-text-default u-text-2">রেঃ সাঃ নংঃ * </p>
                    </div>
                </div>
                <div class="u-align-center u-table u-table-responsive u-table-1">
                <table style="border:1px solid #000;text-align:center;font-size:14px; border-collapse: collapse">
                    <colgroup>
                    <col width="18.4%">
                    <col width="5.6%">
                    <col width="2.8%">
                    <col width="6.3%">
                    <col width="8.8%">
                    <col width="6.8%">
                    <col width="9.9%">
                    <col width="11.7%">
                    <col width="10.7%">
                    <col width="19.1%">
                    </colgroup>
                    <tbody>
                    <tr style="height: 79px;border:1px solid #000">
                        <td style="border:1px solid #000">মালিক, অকৃষি প্রজা বা ইজারাদারের নাম ও ঠিকানা&nbsp;</td>
                        <td style="border:1px solid #000">অংশ</td>
                        <td style="border:1px solid #000">রাজস্ব&nbsp;</td>
                        <td style="border:1px solid #000">দাগ নং&nbsp;</td>
                        <td style="border:1px solid #000" colspan="2">জমি ও শ্রেণী</td>
                        <td style="border:1px solid #000">দাগের মোট পরিমাণ</td>
                        <td style="border:1px solid #000">দাগের মধ্যে অত্র খতিয়ানের অংশ&nbsp;</td>
                        <td style="border:1px solid #000">অংশানুযায়ী জমির পরিমাণ&nbsp;</td>
                        <td style="border:1px solid #000">দখল বিষয়ক বা অন্যান্য বিশেষ মন্তব্য</td>
                    </tr>
                    <tr style="height: 46px;">
                        <td style="border:1px solid #000">১</td>
                        <td style="border:1px solid #000">২</td>
                        <td style="border:1px solid #000">৩</td>
                        <td style="border:1px solid #000">৪</td>
                        <td style="border:1px solid #000">কৃষি&nbsp;<br>৫(ক)</td>
                        <td style="border:1px solid #000">অকৃষি&nbsp;<br>৫(খ)</td>
                        <td style="border:1px solid #000">শতাংশ&nbsp;<br>৬</td>
                        <td style="border:1px solid #000">৭</td>
                        <td style="border:1px solid #000">শতাংশ&nbsp;&nbsp;<br>৮</td>
                        <td style="border:1px solid #000">৯</td>
                    </tr>
                    <tr style="height:250px">
                        <td style="border:1px solid #000"><span id="ktOwnars">`+$owners+`</span></td>
                        <td style="border:1px solid #000"><span id="ktShare">`+$shares.getDigitBanglaFromEnglish()+`</span></td>
                        <td style="border:1px solid #000"><span id="ktTax"></span></td>
                        <td style="border:1px solid #000"><span id="ktPlotNo">`+$plotNo.getDigitBanglaFromEnglish()+`</span></td>
                        <td style="border:1px solid #000"><span id="ktLand"></span></td>
                        <td style="border:1px solid #000"><span id="ktLandClass">নাল</span></td>
                        <td style="border:1px solid #000"><span id="ktLandSize">`+$plotSize.getDigitBanglaFromEnglish()+`</span></td>
                        <td style="border:1px solid #000">`+$khatianOngsho+`</td>
                        <td style="border:1px solid #000">`+$sharesLandSize.getDigitBanglaFromEnglish()+`</td>
                        <td style="border:1px solid #000"><img style="width:50%" src="/assets/media/stamp.png"></img></td>
                    </tr>
                    <tr style="height: 99px;">
                        <td style="border:1px solid #000">... ... ... ধারামতে মোট বা পরিবর্তন <br/>মায় মোকদ্দমা নং এবং সন ।</td>
                        <td style="border:1px solid #000" colspan="7"><br/><strong style="float:right">মোট জমিঃ</strong>  <br/><i style="padding-top:15px;">পরিবার পরিকল্পনা গ্রহন করুন ।</i></td>
                        <td style="border:1px solid #000">`+$khatianValue.getDigitBanglaFromEnglish()+`</td>
                        <td style="border:1px solid #000"></td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </section>`;


            $("#modalUI").dialog({
                modal: true,
                autoOpen: false,
                collapseEnabled: true,
                title: "",
                width: 1200,
                //height: ,
                show: {
                  effect: "blind",
                  duration: 300
                },
                hide: {
                  effect: "clip",
                  duration: 200
                } 
              }).dialog("open");

        
            $('#modalUI').html(html);
            $('.ui-dialog-title').html('খতিয়ানের তথ্যঃ Dummy');

            });

           
        }
    });


}


let highlight;
$khatianValue=0;
$plotSize=0;
$plotNo=0;
$landUse ='';
const displayFeatureInfo = function (pixel,evt) {
    globalLayer.getFeatures(pixel).then(function (features) {
    const feature = features.length ? features[0] : undefined;
    const coordinate = evt.coordinate;
    if (features.length) {
      console.log(feature.get('label'));
      //console.log(feature.A.area_sft);

       var html='<h5 style="margin-bottom:10px;color:#ff9900;">ভূমি তথ্য বিবরণঃ</h5><table class="table table-bordered table-stripped"><tbody>';
      html +='<tr><td>প্রকল্প</td><td>মৌজা ও প্লট ভিত্তিক জাতীয় ডিজিটাল ভূমি জোনিং প্রকল্প</td></tr>';
      html +='<tr><td>বিভাগ</td><td>'+feature.A.বিভাগ+'</td></tr>';
      html +='<tr><td>জেলা</td><td>'+feature.A.জেলা+'</td></tr>';
      html +='<tr><td>উপজিলা/সিটি কর্পোরেশন</td><td>'+feature.A.উপজেলা+'</td></tr>';
      //html +='<tr><td>ইউনিয়ন</td><td>'+feature.A.area_sft+'</td></tr>';
      html +='<tr><td>মৌজা</td><td>'+feature.A.মৌজার_নাম+'</td></tr>';
      html +='<tr><td>জে,এল </td><td>'+feature.A.জে_এল+'</td></tr>';
      html +='<tr><td>সিট নং</td><td>'+feature.A.sheet_nobn+'</td></tr>';
      html +='<tr><td>সার্ভে পিরিয়ড</td><td>'+feature.A.সার্ভে_টাইপ+', '+feature.A.সার্ভে_পিরিয়ড+'</td></tr>';
      html +='<tr><td>দাগ নং</td><td>'+feature.A.label+'</td></tr>';
      html +='<tr><td>অত্র দাগে জমির পরিমাণ</td><td>'+feature.A.প্লট_আয়তন.getDigitBanglaFromEnglish()+'  শতক</td></tr>';
      html +='<tr><td>ল্যান্ড ইউজ</td><td>'+feature.A.landuse+'</td></tr>';

      $khatianValue = parseFloat(feature.A.প্লট_আয়তন/3).toFixed(2);
      $plotNo =feature.A.label;
      $landUse = feature.A.landuse;
    //   Object.entries(feature.A).forEach(([key, value]) => {
    //     if(key != 'geometry' && !key.includes('en') && key !='sheet_nobn' && key != 'gid' && key != 'la_code_bn' && key != 'reve_no_bn'){
    //         if(key == 'label'){
    //             key = 'প্লট'
    //         }
    //         key = key.replace('_',' ');
    //         if(key === 'প্লট আয়তন'){
    //             html +='<tr><td>'+key+'</td><td>'+value+' শতক</td></tr>';
    //             $khatianValue = parseFloat(value/3).toFixed(2);
    //             $plotSize = value;
    //         }
    //         else{
    //             html +='<tr><td>'+key+'</td><td>'+value+'</td></tr>';
    //         }
            
    //     }                                
    //  });

     html+='</tbody></table>';
     html +=`<h5 style="margin-bottom:10px;color:#ff9900;">খতিয়ানের তথ্যঃ</h5>
        <div class="col-md-12" style="min-width:400px;padding:0px;background-color: #ddd;"><ul class="nav nav-tabs">
        <li class="nav-item">
            <a role="button" onClick="changeTab('#22',this)" class="nav-link active" data-bs-toggle="tab">২২</a>
        </li>
        <li class="nav-item">
            <a role="button" onClick="changeTab('#67',this)" class="nav-link" data-bs-toggle="tab">৬৭</a>
        </li>
        <li class="nav-item">
            <a  role="button" onClick="changeTab('#111',this)" class="nav-link" data-bs-toggle="tab">১১১</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="110">
            <div id="khatianDetails">
            </div>
        </div>
    </div></div>
    `;

     content.innerHTML = html;

     overlay.setPosition(coordinate);
        $($('.nav-item .active')[0]).trigger('click');
    }

    if (feature !== highlight) {
      if (highlight) {
        highlightedLayer.getSource().removeFeature(highlight);
      }
      if (feature) {
        highlightedLayer.getSource().addFeature(feature);
      }
      highlight = feature;
    }
  });
};


    //   map.on('pointermove', function (evt) {
    //     if (evt.dragging) {
    //       return;
    //     }
    //     const pixel = map.getEventPixel(evt.originalEvent);
    //     displayFeatureInfo(pixel);
    //   });
      
      map.on('singleclick', function (evt) {
       displayFeatureInfo(evt.pixel,evt);
      });


      map.on('dblclick', function (evt) {
         getFetureInfo(evt.coordinate);
       });

      var selectedlevel = 'forDiv';
      var zoomVal = 50000;
      function getFetureInfo(coordinate){
        var formatWKT = new ol.format.WKT();
        var clickedPosition =  ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
       

        $.ajax({
            url: '/GetCascadeGeom',
            type: 'POST',
            data: {
                level: selectedlevel,
                'lat': clickedPosition[1],
                'lon': clickedPosition[0],
                "_token": $('#token').val()
            },
            success: function (data) {
                var fProjection = 'EPSG:3857';
                if(selectedlevel == 'forMauza'){
                    fProjection = 'EPSG:4326';
                }
                globalLayer.getSource().clear();
                for(var i=0; i<data.length; i++){
                    var dt = data[i].geom;
                    console.log(data[i].divname);
                    if (formatWKT.readFeatures(dt)) {                        
                        formatWKT.readFeatures(dt, {
                            dataProjection: 'EPSG:4326',
                            featureProjection:fProjection
                        }).forEach(function (ft) {
                            var label = data[i].label;
                            var myStyle = new ol.style.Style({
                                fill: new ol.style.Fill({
                                color: 'rgba(255, 255, 255, 0.4)',
                                }),
                                stroke:new ol.style.Stroke({
                                color: '#088dcf7d',
                                width: 1,
                                }),
                            text: new ol.style.Text({
                                font: '12px Calibri,sans-serif',
                                fill: new ol.style.Fill({
                                color: '#FFFFFF'
                                }),
                                stroke: new ol.style.Stroke({
                                    color: '#000000',
                                    width: 5
                                }),
                            })
                            });
                        
                            Object.entries(data[i]).forEach(([key, value]) => {
                                if(key != 'geom'){
                                    ft.set(key,value);
                                }                                
                            });
                            myStyle.getText().setText(label);
                            ft.setStyle(myStyle);
                            
                            globalLayer.getSource().addFeature(ft);
                        });
                    }

                    if(i == 0){
                        var extent = ol.extent.buffer(globalLayer.getSource().getFeatures()[0].getGeometry().getExtent(),zoomVal);
                        map.getView().fit(extent, map.getSize());
                    }
                }

                if(selectedlevel == 'forDiv'){
                    selectedlevel ='forDist';
                    zoomVal = 40000;
                }
                else if(selectedlevel == 'forDist'){
                    selectedlevel ='forThana';
                    zoomVal = 30000;
                }
                else if(selectedlevel == 'forThana'){
                    selectedlevel ='forUnion';
                    zoomVal = 8000;
                }
                else if(selectedlevel == 'forUnion'){
                    selectedlevel ='forMauza';
                    zoomVal = 5000;
                }
                else if(selectedlevel == 'forMauza'){
                    selectedlevel ='forPlot';
                    zoomVal = 5000;
                }
              
            }
        });   
      }

    
function showMauzaSummary(){
    var mauza = $('#Mouza').val();
    if(mauza != undefined && mauza != ''){
    $.ajax({
            type: 'POST',
            url: 'GetMauzaSummary',
            data: {
                mauzaVal: mauza,
                "_token": $('#token').val()
            },
            success: function (data) {
                var totalPlots = 0;
                var totalArea = 0;

                data.forEach(element => {
                    totalArea+=parseFloat(element.area_decimal);
                    totalPlots+=element.total_plots;
                });

                var html='<h5 style="margin-bottom:10px;color:#ff9900;">মৌজার তথ্যঃ '+$mouzaName+'</h5><table class="table table-bordered table-stripped"><tbody>';
                html +='<tr><td>বিভাগ</td><td>'+$divName+'</td></tr>';
                html +='<tr><td>জেলা</td><td>'+$distName+'</td></tr>';
                html +='<tr><td>উপজিলা/সিটি কর্পোরেশন</td><td>'+$upzName+'</td></tr>';
                html +='<tr><td>ইউনিয়ন</td><td>'+$uniName+'</td></tr>';
                html +='<tr><td>মৌজা</td><td>'+$mouzaName+'</td></tr>';
                html +='<tr><td>মৌজার আয়তন</td><td>'+totalArea.toString().getDigitBanglaFromEnglish()+' শতক</td></tr>';
                html +='<tr><td>মোট দাগ সংখ্যা</td><td>'+totalPlots.toString().getDigitBanglaFromEnglish()+'</td></tr>';

                data.forEach(element => {
                    html +='<tr><td>'+element.landuse+'</td><td>প্লট সংখ্যা <span class="badge badge-primary">'+element.total_plots.toString().getDigitBanglaFromEnglish()+'</span>, <span class="badge badge-info">'+element.area_decimal.toString().getDigitBanglaFromEnglish()+'</span> শতক</td></tr>';
                });

                html +='<tr style="background-color: #ddd;"><td>মোট খতিয়ান </td><td>৯৯৯</td></tr>';
                html +='<tr style="background-color: #ddd;"><td>মোট কর</td><td>৮৮৮</td></tr>';
                html +='<tr style="background-color: #ddd;"><td>মোট আদায়</td><td>৭৭৭</td></tr>';
                html += '</tbody></table>';

                $("#modalUI").dialog({
                    modal: true,
                    autoOpen: false,
                    collapseEnabled: true,
                    title: "",
                    width: 800,
                    show: {
                      effect: "blind",
                      duration: 300
                    },
                    hide: {
                      effect: "clip",
                      duration: 200
                    } 
                  }).dialog("open");
            
                  $('#modalUI').html(html);
                  $('.ui-dialog-title').html('Mauza Summary Information:');

            }
        });
    }
    else{
        alert('Please select a mauza first.');
    }
}




$(document).ready(function(){
    $('.btn-add-line').on('click',function(){
        addLineDrawingInteractions();
    });

    $('.btn-add-point').on('click',function(){
        addPointDrawingInteractions();
    });

    $('.btn-report').on('click',function(){
        $locationInfo= null;
        showPollutionDataReport();
    });

    $('.clear-interaction').on('click',function(){
        clearInteractions();
    });


    $('.show-attribute').on('click',function(){
        addAttibute();
    });

    pupulateCascadedropdowns();
 
})
