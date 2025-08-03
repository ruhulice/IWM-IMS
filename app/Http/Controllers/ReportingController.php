<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportData;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function DivisionLanduse()
    {
        // $result = DB::select('SELECT distinct div_code, m_div_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        // FROM public.mv_landuse_division
        // ORDER BY m_div_bn, majclass_b');
        return view('report.division_landuse_report');
    }

    public function DistrictLanduse()
    {
        // $result = DB::select('SELECT distinct dist_code, m_div_bn, m_dist_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        // FROM public.mv_landuse_district
        // ORDER BY m_div_bn, m_dist_bn, majclass_b');
        return view('report.district_landuse_report');
    }

    public function UpazillaLanduse()
    {
        // $result = DB::select('SELECT distinct thana_code, m_div_bn, m_dist_bn, m_thana_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        // FROM public.mv_landuse_upazilla
        // ORDER BY m_div_bn, m_dist_bn, m_thana_bn, majclass_b');
        return view('report.upazilla_landuse_report');
    }

    public function DivisionLanduseJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE div_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct div_code, m_div_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_landuse_division
        '.$where.'
        ORDER BY m_div_bn, majclass_b');
        return response()->json($result);

    }

    public function DistrictLanduseJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE dist_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct dist_code, m_div_bn, m_dist_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_landuse_district
        '.$where.'
        ORDER BY m_div_bn, m_dist_bn, majclass_b');
        return response()->json($result);
    }

    public function UpazillaLanduseJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE thana_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct thana_code, m_div_bn, m_dist_bn, m_thana_bn, majclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_landuse_upazilla
        '.$where.'
        ORDER BY m_div_bn, m_dist_bn, m_thana_bn, majclass_b');
        return response()->json($result);
    }

    public function DivisionZoning()
    {
        return view('report.division_zoning_report');
    }

    public function DistrictZoning()
    {
        return view('report.district_zoning_report');
    }

    public function UpazillaZoning()
    {
        return view('report.upazilla_zoning_report');
    }

    public function DivisionZoningJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE div_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct div_code, m_div_bn, majclass_b, subclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_zoning_division
        '.$where.'
        ORDER BY m_div_bn, majclass_b');
        return response()->json($result);

    }

    public function DistrictZoningJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE dist_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct dist_code, m_div_bn, m_dist_bn, majclass_b, subclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_zoning_district
        '.$where.'
        ORDER BY m_div_bn, m_dist_bn, majclass_b');
        return response()->json($result);
    }

    public function UpazillaZoningJson($areaCode = 0)
    {
        $where = "";
        if($areaCode > 0){
            $where = " WHERE thana_code like '". $areaCode ."%'" ;
        }
        $result = DB::select('SELECT distinct thana_code, m_div_bn, m_dist_bn, m_thana_bn, majclass_b, subclass_b, ROUND(hactor::numeric,2) hactor, ROUND(prc::numeric, 2) as prc
        FROM public.mv_zoning_upazilla
        '.$where.'
        ORDER BY m_div_bn, m_dist_bn, m_thana_bn, majclass_b');
        return response()->json($result);
    }



    public function MauzaSummary()
    {
        return view('report.mauza_summary.report');
    }

    public function DataExportTool()
    {
        return view('report.data_export.report');
    }
    
    public function GetExportData(Request $request)
    {
        $div_code = $request->div_code;
        $dist_code = $request->dist_code;
        $upz_code = $request->upz_code;
        $mauza_code = $request->mauza_code;

        if(empty($div_code)){
            $div_code = -9999;
        }

        if(empty($dist_code)){
            $dist_code = -9999;
        }

        if(empty($upz_code)){
            $upz_code = -9999;
        }

        if(empty($mauza_code)){
            $mauza_code = -9999;
        }

        return Excel::download(new ExportData($div_code, $dist_code, $upz_code, $mauza_code), 'ExportData.xlsx');
    }

    public function SheetWisePlot()
    {
        return view('report.sheet_wise_plot.report');
    }

    public function GetSheetWisePlotSummary(Request $request)
    {
        $mauza        = $request->mauzaVal; 
        $mauza_tab    = $request->mauza_tab;
        $sheet        = $request->sheetVal;
        $mauza_tab_mg = $mauza_tab.'_mg';
        $mauza_tab_ml = $mauza_tab.'_ml';

        $sql = "SELECT COUNT(gid) as total_plots FROM $mauza_tab_mg where \"substring\"(geocode_en, 0,13) = '$mauza' ";
        $result=DB::select($sql);
        
        $majorClassSql = "SELECT major_class,plots,ROUND((plots*100)/SUM(plots) OVER(),1) as Percentage FROM
        (
            SELECT maj_class_bn as major_class, COUNT(plot_no_en) as plots 
            FROM $mauza_tab_ml 
            WHERE \"substring\"(geocode_en, 0,13) = '$mauza' AND sht_no_en = '$sheet' AND maj_class_bn IS NOT NULL
            GROUP BY maj_class_bn
        ) A";
        $marjorClass = DB::select($majorClassSql);

        $subClassSql = "SELECT major_class, sub_class,plots,ROUND((plots*100)/SUM(plots) OVER(),1) as Percentage FROM
        (
            SELECT maj_class_bn as major_class, sub_class_bn as sub_class, COUNT(plot_no_en) as plots 
            FROM $mauza_tab_ml 
            WHERE \"substring\"(geocode_en, 0,13) = '$mauza' AND sht_no_en = '$sheet' AND sub_class_bn IS NOT NULL
            GROUP BY maj_class_bn, sub_class_bn
        ) A";
        $subClass = DB::select($subClassSql);

        return response()->json(array('summary'=>$result,'major_class'=>$marjorClass,'sub_class'=>$subClass));
    }

    public function MauzaSheetWisePloting()
    {
        $sql = "select distinct m_div_en,m_div_bn,m_dist_en,m_dist_bn,m_thana_en,m_thana_bn,m_name_en,m_name_bn,jl_no_en,jl_no_bn,sht_no_en,sht_no_bn ,count(plot_no_en) as total_plot from mg_vw
                group by m_div_en,m_div_bn,m_dist_en,m_dist_bn,m_thana_en,m_thana_bn,m_name_en,m_name_bn,jl_no_en,jl_no_bn,sht_no_en,sht_no_bn order by m_div_en;";
        $results = DB::select($sql);

        return view('report.mauza_sheet_wise_plot.report', compact('results'));
    }

}