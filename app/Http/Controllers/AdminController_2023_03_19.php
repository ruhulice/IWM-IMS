<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function GetInfo(Request $request)
    {
        $level = $request->level;
        $result = array();
        switch ($level) {
            case "forDiv":
                //$sql = "SELECT code, name_en, concat(code::text,'-',name_bn) as name_bn FROM iwm_division ORDER BY name_en";
                $sql = "SELECT code, name_en, concat(code::text,'-',name_bn) as name_bn FROM iwm_division WHERE is_uploaded=1 ORDER BY name_en";
                
                //$sql = "SELECT geocode as code, m_div_en as name_en,m_div_bn as name_bn FROM vw_gis_boundary_division ORDER BY m_div_en";
                $result=DB::select($sql);
                break;

            case "forDist":
                $div = $request->division_code;
                //$sql = "SELECT code, name_en,concat(substring(code::text,3,5),'-',name_bn) as name_bn, division_code FROM iwm_district WHERE division_code = '$div'  ORDER BY name_en";
                $sql = "SELECT code, name_en,concat(substring(code::text,3,5),'-',name_bn) as name_bn, division_code FROM iwm_district WHERE is_uploaded=1 AND division_code = '$div'  ORDER BY name_en";
                
                //$sql = "SELECT geocode as code, m_dist_en as name_en, m_dist_bn as name_bn FROM vw_gis_boundary_district WHERE division_code = '$div'  ORDER BY m_dist_en";
                $result=DB::select($sql);
                break;

            case "forThana":
                $div = $request->division_code;
                $dist = $request->district_code;

                //$sql = "SELECT code, name_en,CONCAT(RIGHT(code,2),'-', name_bn) as name_bn, division_code, district_code FROM iwm_upazila WHERE district_code = '$dist' ORDER BY name_en";
                //$sql = "SELECT code, name_en,concat(substring(code::text,5,7),'-',name_bn) as name_bn, division_code, district_code FROM iwm_upazila WHERE district_code = '$dist' ORDER BY name_en";
                $sql = "SELECT code, name_en,concat(substring(code::text,5,7),'-',name_bn) as name_bn, division_code, district_code FROM iwm_upazila WHERE is_uploaded=1 AND district_code = '$dist' ORDER BY name_en";
                
                $result=DB::select($sql);
                break;
        
            case "forUnion":
                $div = $request->division_code;
                $dist = $request->district_code;
                $thana = $request->thana_code;
                //$sql = "SELECT distinct code, name_en,CONCAT(RIGHT(code,2),'-', name_bn) as name_bn, division_code, district_code  FROM public.iwm_union WHERE upazila_code = '$thana'
                $sql = "SELECT distinct code, name_en, name_bn, division_code, district_code  FROM public.iwm_union WHERE upazila_code = '$thana'
                    ORDER BY name_en";
                 $result=DB::select($sql);
                break;
            case "forMouzaByUpz":
                $div = $request->division_code;
                $dist = $request->district_code;
                $thana = $request->thana_code;
                //$sql = "SELECT distinct code, name_en,CONCAT(RIGHT(code,2),'-', name_bn) as name_bn, division_code, district_code FROM public.iwm_mauza WHERE upazila_code = '$thana'
                // $sql = "SELECT distinct code, name_en, name_bn, division_code, district_code FROM public.iwm_mauza WHERE upazila_code = '$thana'
                //     ORDER BY name_en";

                //$sql = "SELECT DISTINCT geocode as code,m_name_en as name_en,m_name_bn as name_bn, division_code, district_code FROM vw_gis_boundary_mouza WHERE upazila_code = '$thana'
                // $sql = "SELECT DISTINCT geocode as code,m_name_bn as name_bn, division_code, district_code FROM vw_gis_boundary_mouza WHERE upazila_code = '$thana'
                // ORDER BY m_name_en";
                $sql = "SELECT DISTINCT geocode as code,concat(\"substring\"(geocode::text, 7, 10),'-',m_name_bn) as name_bn, \"substring\"(m_code::text, 0, 8) as m_code FROM gis_boundary_mauza_dynamic WHERE \"substring\"(geocode::text, 0, 7) = '$thana'";
                $result=DB::select($sql);
                break;
            case "forMauza":
                $div = $request->division_code;
                $dist = $request->district_code;
                $thana = $request->thana_code;
                    // $sql = "SELECT distinct code, name_en,name_bn, division_code, district_code FROM public.iwm_mauza WHERE upazila_code = '$thana'
                    // ORDER BY name_en";
                //  $sql = "SELECT DISTINCT geocode as code,m_name_en as name_en,m_name_bn as name_bn, division_code, district_code FROM vw_gis_boundary_mouza WHERE upazila_code = '$thana'
                //  ORDER BY m_name_en";
                //$sql = "SELECT DISTINCT geocode as code,m_name_bn as name_bn, division_code, district_code FROM vw_gis_boundary_mouza WHERE upazila_code = '$thana' ORDER BY m_name_bn";
                $sql = "SELECT DISTINCT geocode as code,concat(\"substring\"(geocode::text, 7, 10),'-',m_name_bn) as name_bn, \"substring\"(m_code::text, 0, 8) as m_code FROM gis_boundary_mauza_dynamic WHERE \"substring\"(geocode::text, 0, 7) = '$thana'";
                $result=DB::select($sql);
                break;
            case "forPlot":
                $div = $request->division_code;
                $dist = $request->district_code;
                $div = $request->division_code;
                $thana = $request->thana_code;
                $union = $request->uni_code;
                $mauza = $request->mauza_code;
                $sql = "";
                $result=DB::select($sql);
                break;
        }
       
        return response()->json($result);
    }


    ///Get geomatry of any polygon (Division, District, Upazila, Union...)
    public function GetGeom(Request $request)
    {
        $level = $request->level; // Level means For Division, District, Upazila, Union ...
        $result = array();
        switch ($level) {
            case "forDiv":
                $tableName = $request->tableName;
                $divVal = $request->divVal;
                $sql = "SELECT st_astext(geom) as geom, division as label FROM $tableName WHERE divcode = '$divVal'";
                $result=DB::select($sql);
                break;
    
            case "forDist":
                $tableName = $request->tableName;
                $divVal = $request->divVal;
                $distVal =$request->distVal;
                $sql = "SELECT st_astext(geom) as geom, district_n as label FROM $tableName WHERE district_c = '$distVal' ";
                $result=DB::select($sql);
                break;
    
            case "forThana":
                $thanaVal = $request->thanaVal;
                $sql = "SELECT st_astext(geom) as geom, upazila as label FROM gis_boundary_upazila WHERE geocode = '$thanaVal' ";
                $result=DB::select($sql);
                break;
    
            case "forUnion":
                $tableName = $request->tableName;
                $unionVal = $request->unionVal;
                $sql = "SELECT st_astext(geom) as geom, uniname as label FROM $tableName WHERE geocode = '$unionVal' ";
                $result=DB::select($sql);
                break;

            case "forMauza":
                $tableName = $request->tableName;
                $mauzaVal =  $request->mauzaVal;

                $sql = "SELECT DISTINCT sht_no_bn as sht_label, sht_no_en FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal'";
                $sheets=DB::select($sql);

                $sql = "SELECT DISTINCT plot_no_en as gid, plot_no_bn as label,m_code,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' ORDER BY plot_no_en";
                $plots=DB::select($sql);

                $sql = "SELECT DISTINCT plot_no_en,m_code,plot_no_en,maj_class,sub_class,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_ml WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' ORDER BY plot_no_en";
                $landuse=DB::select($sql);

                return response()->json(['sheets'=>$sheets,'plots'=>$plots,'landuse'=>$landuse]);
                break;
    
            /*case "forMauza":
                $tableName = $request->tableName;
                $mauzaVal =  $request->mauzaVal;
                
                $sql = "SELECT mauza FROM $tableName WHERE geocode = '$mauzaVal' ";
                $result=DB::select($sql);
                //$tableName = $result.mauza;

                $newTable = array_values($result)[0]->mauza;

                $sql = "SELECT DISTINCT gid, plot_no_bn as label,plot_no_en,st_astext(geom) as geom, jl_no_bn FROM $newTable ORDER BY plot_no_en";
                
                //$sql = "SELECT st_astext(st_transform(ST_SetSRID(geom,900914),4326)) as geom, plot_no_bn as label,gid,m_div_en, m_div_bn as বিভাগ, m_dist_en, m_dist_bn as জেলা, m_thana_en, m_thana_bn as উপজেলা, sv_type_en, sv_type_bn as সার্ভে_টাইপ, m_code as m_code_en, l_code_en, l_code_bn, l_name_en as layer_en, l_name_bn as লেয়ার,  plot_no_en, plot_no_bn as মৌজা, m_name_en as mauza_nmen, m_name_bn as মৌজার_নাম, jl_no_en, jl_no_bn as জে_এল, sht_no_en as sheet_noen, sht_no_bn as sheet_nobn, scale_en, scale_bn as স্কেল, sv_year_en as sv_perioen, sv_year_bn as  সার্ভে_পিরিয়ড, rev_no_en as reve_no_en, rev_no_bn as reve_no_bn, geocode_en as জিও_কোড,shape_area as প্লট_আয়তন FROM $newTable ORDER BY plot_no_en";
                //dd($sql);
                $result=DB::select($sql);
                //dd($result);
                return response()->json([$result,$newTable]);
                break;*/

            case "forSheet":
                $sheetVal =  $request->sheetVal;
                $mauzaVal =  $request->mauzaVal;
                $tableName = $request->tableName;

                if($sheetVal == null) {
                    $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' ORDER BY plot_no_en";
                    $result=DB::select($sql);
                }
                else {
                    $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' AND sht_no_en = '$sheetVal' ORDER BY plot_no_en";
                    $result=DB::select($sql);
                }

                $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,maj_class,sub_class,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_ml WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' AND sht_no_en = '$sheetVal' ORDER BY plot_no_en";
                $resultLandUse=DB::select($sql);
                return response()->json(['plots'=>$result,'landuse'=>$resultLandUse]);
                break;

            case "forPlot":
                $mauzaVal = $request->mauzaVal;
                $tableName = $request->tableName;
                $plotVal = $request->plotVal;
                $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,sht_no_en,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' AND plot_no_en = '$plotVal' ORDER BY plot_no_en";
                $plot=DB::select($sql);
                $sheetVal = array_values($plot)[0]->sht_no_en;
                
                $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_mg WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' AND sht_no_en = '$sheetVal' ORDER BY plot_no_en";
                $plots=DB::select($sql);

                $sql = "SELECT DISTINCT plot_no_en as gid,m_code, plot_no_bn as label,maj_class,sub_class,plot_no_en,st_astext(st_transform(geom,4326)) as geom FROM ".$tableName."_ml WHERE \"substring\"(geocode_en::text, 0, 10) = '$mauzaVal' AND sht_no_en = '$sheetVal' ORDER BY plot_no_en";
                $resultLandUse=DB::select($sql);
                return response()->json(['plot'=>$plot,'plots'=>$plots,'landuse'=>$resultLandUse]);
                break;
        }
       
        return response()->json($result[0]);
    }



    ///Get geomatry of inside polygon (Division, District, Upazila, Union...)
    public function GetCascadeGeom(Request $request)
    {
        $level = $request->level; // Level means For Division, District, Upazila, Union ...
        $result = array();
        switch ($level) {
            case "forDiv":
                $lon = $request->lon;
                $lat = $request->lat;
                $sql = "SELECT divcode,id.name_bn as divname FROM gis_boundary_division gd LEFT JOIN iwm_division id ON CAST(gd.divcode as varchar(10)) = CAST(id.code as varchar(10)) WHERE st_within(ST_MakePoint($lon, $lat), geom) LIMIT 1 ";
                $result=DB::select($sql);
                $divcode = array_values($result)[0]->divcode;
                $divname =  array_values($result)[0]->divname;
                $sql = "SELECT gid, division_c, district_c, division_n, district_n as label, st_astext(geom) as geom FROM gis_boundary_district WHERE division_c = '$divcode' ";
                $result=DB::select($sql);
                //$result.divame-> $divname;
                break;
    
            case "forDist":
                $lon = $request->lon;
                $lat = $request->lat;
                $sql = "SELECT district_c FROM gis_boundary_district WHERE st_within(ST_MakePoint($lon, $lat), geom) LIMIT 1 ";
                $result=DB::select($sql);

                $distcode = array_values($result)[0]->district_c;
                $sql = "SELECT gid, geocode, division, district, upazila as label, st_astext(geom) as geom FROM gis_boundary_upazila WHERE substring(CAST(geocode  as varchar(10))  from 0 for 5) = '$distcode' ";
                $result=DB::select($sql);
                break;
    
            case "forThana":
                $lon = $request->lon;
                $lat = $request->lat;
                $sql = "SELECT geocode FROM gis_boundary_upazila WHERE st_within(ST_MakePoint($lon, $lat), geom) LIMIT 1 ";
                $result=DB::select($sql);
                $upzode = array_values($result)[0]->geocode;
                $sql = "SELECT gid, geocode, divname, distname, thaname, uniname as label, upz_code, st_astext(geom) as geom FROM gis_boundary_union WHERE substring(geocode from 0 for 7) = '$upzode' ";
                $result=DB::select($sql);
                break;
    
            case "forUnion":
                $lon = $request->lon;
                $lat = $request->lat;
                $sql = "SELECT geocode FROM gis_boundary_union WHERE st_within(ST_MakePoint($lon, $lat), geom) LIMIT 1 ";
                $result=DB::select($sql);
                $unicode = array_values($result)[0]->geocode;
                $sql = "SELECT  gid, geocode, divname, distname, thaname, uniname, mauzname as label, uni_code, upz_code,mauza, st_astext(geom) as geom FROM gis_boundary_mauza WHERE uni_code = '$unicode' ";
                $result=DB::select($sql);
                break;
    
            case "forMauza":
                // $lon = $request->lon;
                // $lat = $request->lat;
                // $sql = "SELECT geocode FROM gis_boundary_mauza WHERE st_within(ST_MakePoint($lon, $lat), geom) LIMIT 1 ";
                // $result=DB::select($sql);
                // $mauzacode = array_values($result)[0]->geocode;
                // $sql = "SELECT gid, division_c, district_c, division_n, district_n, st_astext(geom) as geom FROM gis_boundary_district WHERE division_c = '$mauzacode' ";
                // $result=DB::select($sql);

                // $tableName = $request->tableName;
                // $mauzaVal =  $request->mauzaVal;
                
                // $sql = "SELECT mauza FROM $tableName WHERE geocode = '$mauzaVal' ";
                // $result=DB::select($sql);
                 $tableName = 'dha_dha_sin_098_000_md';
                 $sql = "SELECT * FROM $tableName";
                //$sql = "SELECT st_astext(geom) as geom, plot_no_bn as label,gid,m_div_en, m_div_bn as বিভাগ, m_dist_en, m_dist_bn as জেলা, m_thana_en, m_thana_bn as উপজেলা, sv_type_en, sv_type_bn as সার্ভে_টাইপ, m_code_en, la_code_en, la_code_bn, layer_en, layer_bn as লেয়ার,  plot_no_en, plot_no_bn as মৌজা, mauza_nmen, mauza_nmbn as মৌজার_নাম, jl_no_en, jl_no_bn as জে_এল, sheet_noen, sheet_nobn, scale_en, scale_bn as স্কেল, sv_perioen, sv_periobn as সার্ভে_পিরিয়ড, reve_no_en, reve_no_bn, geocode_en, geocode_bn as জিও_কোড, area_sft FROM itabaria_geo ORDER BY plot_no_en";
                $result=DB::select($sql);
                break;
        }
       
        return response()->json($result);
    }

    public function GetMauzaSummary(Request $request){
        $level = $request->mauzaVal; 
        $mauza_tab = $request->mauza_tab;
        $mauza_tab_mg = $mauza_tab.'_mg';
        $mauza_tab_ml = $mauza_tab.'_ml';
        // $sql = "SELECT COUNT(gid) as total_plots FROM public.dha_dha_sin_098_000_rs_mg ";
        $sql = "SELECT COUNT(gid) as total_plots FROM $mauza_tab_mg where \"substring\"(geocode_en, 0,10) = '$level' ";
        $result=DB::select($sql);
        $majorClassSql = "SELECT major_class,plots,ROUND((plots*100)/SUM(plots) OVER(),1) as Percentage FROM
        (
            SELECT 
                maj_class_bn as major_class,
                COUNT(plot_no_en) as plots 
            FROM $mauza_tab_ml 
            WHERE \"substring\"(geocode_en, 0,10) = '$level' AND maj_class_bn IS NOT NULL
            GROUP BY maj_class_bn
        ) A";
        $marjorClass = DB::select($majorClassSql);

        $subClassSql = "SELECT sub_class,plots,ROUND((plots*100)/SUM(plots) OVER(),1) as Percentage FROM
        (
            SELECT 
                sub_class_bn as sub_class,
                COUNT(plot_no_en) as plots 
            FROM $mauza_tab_ml 
            WHERE \"substring\"(geocode_en, 0,10) = '$level' AND sub_class_bn IS NOT NULL
            GROUP BY sub_class_bn
        ) A";
        $subClass = DB::select($subClassSql);

        return response()->json(array('summary'=>$result,'major_class'=>$marjorClass,'sub_class'=>$subClass));
    }

    public function GetPlotInfo(Request $request){
        $lon = $request->lon;
        $lat = $request->lat;
        $tableName = $request->table.'_ml';
        //$sql = "SELECT plot_no_bn as label,gid,m_div_en, m_div_bn as বিভাগ, m_dist_en, m_dist_bn as জেলা, m_thana_en, m_thana_bn as উপজেলা, sv_type_en, sv_type_bn as সার্ভে_টাইপ, m_code as m_code_en, l_code_en, l_code_bn, l_name_en as layer_en, l_name_bn as লেয়ার,  plot_no_en, plot_no_bn as মৌজা, m_name_en as mauza_nmen, m_name_bn as মৌজার_নাম, jl_no_en, jl_no_bn as জে_এল, sht_no_en as sheet_noen, sht_no_bn as sheet_nobn, scale_en, scale_bn as স্কেল, sv_year_en as sv_perioen, sv_year_bn as  সার্ভে_পিরিয়ড, rev_no_en as reve_no_en, rev_no_bn as reve_no_bn, geocode_en as জিও_কোড,shape_area as প্লট_আয়তন,majorclass as landuse FROM $tableName WHERE ST_WITHIN(ST_SetSRID(ST_MakePoint($lon, $lat),4326),st_transform(geom,4326)) ORDER BY plot_no_en";
        //$sql = "SELECT pj_name_en, pj_name_bn, m_code, m_div_en, m_div_bn, m_dist_en, m_dist_bn, m_thana_en, m_thana_bn, m_name_en, m_name_bn, jl_no_en, jl_no_bn, sht_no_en, sht_no_bn, l_code_en, l_code_bn, l_name_en, l_name_bn, plot_no_en, plot_no_bn, sv_type_en, sv_type_bn, scale_en, scale_bn, sv_year_en, sv_year_bn, rev_no_en, rev_no_bn, geocode_en, remarks, shape_leng, shape_area, fid_landus, objectid_1, shape_le_1, shape_ar_1, majorclass, subclass, COALESCE(remarks_1,'') as remarks_1, updateinfo,COALESCE(majorclass_bn,'') as majorclass_bn, COALESCE(subclass_bn,'') as subclass_bn FROM $tableName WHERE ST_WITHIN(ST_SetSRID(ST_MakePoint($lon, $lat),4326),st_transform(geom,4326)) ORDER BY plot_no_en";
        //$sql = "SELECT pj_name_en, pj_name_bn, m_code, m_div_en, m_div_bn, m_dist_en, m_dist_bn, m_thana_en, m_thana_bn, m_name_en, m_name_bn, jl_no_en, jl_no_bn, sht_no_en, sht_no_bn, l_code_en, l_code_bn, l_name_en, l_name_bn, plot_no_en, plot_no_bn, sv_type_en, sv_type_bn, scale_en, scale_bn, sv_year_en, sv_year_bn, rev_no_en, rev_no_bn, geocode_en, COALESCE(remarks,'') as remarks, maj_class as majorclass, sub_class as subclass,majclass_b as majorclass_bn, subclass_b as subclass_bn FROM $tableName WHERE ST_WITHIN(ST_SetSRID(ST_MakePoint($lon, $lat),4326),st_transform(geom,4326)) ORDER BY plot_no_en";
        $sql = "SELECT * FROM $tableName WHERE ST_WITHIN(ST_SetSRID(ST_MakePoint($lon, $lat),4326),st_transform(geom,4326)) ORDER BY plot_no_en";
        $result=DB::select($sql);  
        //dd($sql);
        return response()->json($result);
    }


}
