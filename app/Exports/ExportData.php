<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ExportData implements FromView
{
    public function __construct(int $div_code, int $dist_code, int $upz_code, int $mauza_code)
    {
        $this->div_code = $div_code;
        $this->dist_code = $dist_code;
        $this->upz_code = $upz_code;
        $this->mauza_code = $mauza_code;
    }

    public function view(): View
    {
        $where = " ";

        // if ($this->div_code != -9999) {
        //     $div = $this->div_code;
        //     $where = " WHERE left(geocode_en,2)='$div' ";
        // }
        
        // if ($this->dist_code != -9999) {
        //     $dist = $this->dist_code;
        //     $where = " WHERE left(geocode_en,4)='$dist' ";
        // }
        
        // if ($this->upz_code != -9999) {
        //     $upz = $this->upz_code;
        //     $where = " WHERE left(geocode_en,6)='$upz' ";
        // }
        
        // if ($this->mauza_code != -9999) {
        //     $mauza = $this->mauza_code;
        //     $where = " WHERE \"substring\"(geocode_en, 0,10) = '$mauza' ";
        // }

        // $result = DB::select("select gid,left(geocode_en,2) as div_code,left(geocode_en,4)as dist_code,left(geocode_en,6) as thana_code,m_code,m_div_en,m_div_bn,m_dist_en,m_dist_bn,m_thana_en,m_thana_bn,m_name_en,m_name_bn,jl_no_en,jl_no_bn,sht_no_en,sht_no_bn,l_code_en,l_code_bn,
        // l_name_en,l_name_bn,plot_no_en,plot_no_bn,sv_type_en,sv_type_bn,scale_en,scale_bn,sv_year_en,sv_year_bn,rev_no_en,rev_no_bn,geocode_en,remarks,shape_length,shape_area,geom 
        // FROM generic_func((select array_agg(table_name) FROM information_schema.tables WHERE table_schema='public' AND table_type='BASE TABLE' AND LENGTH(table_name) = 10 AND table_name LIKE '%_mg')) 
        //  $where ");

        if ($this->div_code != -9999) {
            $div = $this->div_code;
            $where = " WHERE div_code='$div' ";
        }
        
        if ($this->dist_code != -9999) {
            $dist = $this->dist_code;
            $where = " WHERE dist_code='$dist' ";
        }
        
        if ($this->upz_code != -9999) {
            $upz = $this->upz_code;
            $where = " WHERE thana_code='$upz' ";
        }
        
        if ($this->mauza_code != -9999) {
            $mauza = $this->mauza_code;
            $where = " WHERE left(geocode_en, 8) = left('$mauza', 8) ";
        }

        $result = DB::select("SELECT gid, div_code, dist_code, thana_code, m_code, m_div_en, m_div_bn, m_dist_en, m_dist_bn, m_thana_en, m_thana_bn, m_name_en, m_name_bn, jl_no_en, jl_no_bn, sht_no_en, sht_no_bn, l_code_en, l_code_bn, l_name_en, l_name_bn, plot_no_en, plot_no_bn, sv_type_en, sv_type_bn, scale_en, scale_bn, sv_year_en, sv_year_bn, rev_no_en, rev_no_bn, geocode_en, remarks, shape_length, shape_area, geom
        FROM public.mg_vw $where ");

         return view('report.data_export.filtered_data', [
            'result' => $result,
        ]);
    }
}
