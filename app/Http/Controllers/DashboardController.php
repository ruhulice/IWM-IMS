<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Dashboard()
    {
        // $counts = DB::select('SELECT COUNT(DISTINCT m_div_en) as div, COUNT(DISTINCT m_dist_en) as dist,COUNT(DISTINCT m_thana_en) as thana,COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet  FROM public.gis_boundary_mauza_dynamic');
        // $divWiseCounts = DB::select('SELECT m_div_en, m_div_bn, COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet FROM gis_boundary_mauza_dynamic GROUP BY m_div_en, m_div_bn');
        // $divisions = DB::select('SELECT DISTINCT div_code, m_div_en, m_div_bn FROM public.vw_national_dashboard ORDER BY div_code;');
        // $major_class = DB::select('SELECT DISTINCT maj_class, majclass_b FROM public.vw_national_dashboard ORDER BY majclass_b;');
        // $result = DB::select('SELECT div_code, m_div_en, m_div_bn, maj_class, majclass_b, hactor, prc FROM public.vw_national_dashboard ORDER BY div_code,majclass_b;');
        // $major_class_data = DB::select('SELECT  maj_class,majclass_b as major_class, ROUND(hactor::numeric,2) hactor, ROUND((hactor * 100/ SUM(hactor) OVER())::numeric,2) as Percentage FROM (
        //     SELECT maj_class,majclass_b, SUM(hactor) as hactor FROM public.vw_national_dashboard GROUP BY maj_class,majclass_b
        // ) A');
        return view('dashboard.dashboard');
    }

    public function DistrictDashboard()
    {
        $counts = DB::select('SELECT COUNT(DISTINCT m_dist_en) as dist,COUNT(DISTINCT m_thana_en) as thana,COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet  FROM public.gis_boundary_mauza_dynamic');
        $distWiseCounts = DB::select('SELECT m_dist_en, m_dist_bn, COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet FROM gis_boundary_mauza_dynamic GROUP BY m_dist_en, m_dist_bn');
        $districts = DB::select('SELECT DISTINCT div_code,dist_code, m_div_en, m_div_bn,m_dist_en,m_dist_bn FROM public.vw_district_dashboard ORDER BY div_code,dist_code;');
        $major_class = DB::select('SELECT DISTINCT maj_class, majclass_b FROM public.vw_district_dashboard ORDER BY majclass_b;');
        $result = DB::select('SELECT div_code,dist_code, m_div_en, m_div_bn,m_dist_en,m_dist_bn, maj_class, majclass_b, hactor, prc FROM public.vw_district_dashboard ORDER BY div_code,majclass_b;');
        $major_class_data = DB::select('SELECT  maj_class,majclass_b as major_class, ROUND(hactor::numeric,2) hactor, ROUND((hactor * 100/ SUM(hactor) OVER())::numeric,2) as Percentage FROM (
            SELECT maj_class,majclass_b, SUM(hactor) as hactor FROM public.vw_district_dashboard GROUP BY maj_class,majclass_b
        ) A');
        return view('dashboard.district_dashboard',compact('result','districts','major_class','major_class_data','counts','distWiseCounts'));
    }
    
    public function UpazilaDashboard()
    {
        $counts = DB::select('SELECT COUNT(DISTINCT m_thana_en) as thana,COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet  FROM public.gis_boundary_mauza_dynamic');
        $upzWiseCounts = DB::select('SELECT m_thana_en, m_thana_bn, COUNT(DISTINCT "substring"(m_code,0,16)) as mouza,COUNT(DISTINCT m_code) as sheet FROM gis_boundary_mauza_dynamic GROUP BY m_thana_en, m_thana_bn');
        $thanas = DB::select('SELECT DISTINCT div_code, dist_code, upz_code, m_div_en, m_div_bn, m_dist_en, m_dist_bn, m_thana_en, m_thana_bn FROM public.vw_thana_dashboard ORDER BY div_code,dist_code,upz_code;');
        $major_class = DB::select('SELECT DISTINCT maj_class, majclass_b FROM public.vw_thana_dashboard ORDER BY majclass_b;');
        $result = DB::select('SELECT div_code, dist_code, upz_code, m_div_en, m_div_bn, m_dist_en, m_dist_bn, m_thana_en, m_thana_bn, maj_class, majclass_b, hactor, prc FROM public.vw_thana_dashboard ORDER BY div_code,majclass_b;');
        $major_class_data = DB::select('SELECT  maj_class,majclass_b as major_class, ROUND(hactor::numeric,2) hactor, ROUND((hactor * 100/ SUM(hactor) OVER())::numeric,2) as Percentage FROM (
            SELECT maj_class,majclass_b, SUM(hactor) as hactor FROM public.vw_thana_dashboard GROUP BY maj_class,majclass_b
        ) A');
        return view('dashboard.upazila_dashboard',compact('result','thanas','major_class','major_class_data','counts','upzWiseCounts'));
    }

    public function MapDashboard()
    {
        $landuses = DB::select('select * from landuses');
        return view('dashboard.map_dashboard',compact('landuses'));
    }
}