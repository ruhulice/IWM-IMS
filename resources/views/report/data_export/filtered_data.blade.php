<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="data_table"> 
    <thead>
        <tr>
            <th>div_code</th>
            <th>dist_code</th>
            <th>thana_code</th>
            <th>m_code</th>
            <th>m_div_en</th>
            <th>m_div_bn</th>
            <th>m_dist_en</th>
            <th>m_dist_bn</th>
            <th>m_thana_en</th>
            <th>m_thana_bn</th>
            <th>m_name_en</th>
            <th>m_name_bn</th>
            <th>jl_no_en</th>
            <th>jl_no_bn</th>
            <th>sht_no_en</th>
            <th>sht_no_bn</th>
            <th>l_code_en</th>
            <th>l_code_bn</th>
            <th>l_name_en</th>
            <th>l_name_bn</th>
            <th>plot_no_en</th>
            <th>plot_no_bn</th>
            <th>sv_type_en</th>
            <th>sv_type_bn</th>
            <th>scale_en</th>
            <th>scale_bn</th>
            <th>sv_year_en</th>
            <th>sv_year_bn</th>
            <th>rev_no_en</th>
            <th>rev_no_bn</th>
            <th>geocode_en</th>
            <th>remarks</th>
            <th>geom</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $item)
            <tr>
                <td scope="row">{{ $item->div_code }}</td>
                <td scope="row">{{ $item->dist_code }}</td>
                <td scope="row">{{ $item->thana_code }}</td>
                <td scope="row">{{ $item->m_code }}</td>
                <td scope="row">{{ $item->m_div_en }}</td>
                <td scope="row">{{ $item->m_div_bn }}</td>
                <td scope="row">{{ $item->m_dist_en }}</td>
                <td scope="row">{{ $item->m_dist_bn }}</td>
                <td scope="row">{{ $item->m_thana_en }}</td>
                <td scope="row">{{ $item->m_thana_bn }}</td>
                <td scope="row">{{ $item->m_name_en }}</td>
                <td scope="row">{{ $item->m_name_bn }}</td>
                <td scope="row">{{ $item->jl_no_en }}</td>
                <td scope="row">{{ $item->jl_no_bn }}</td>
                <td scope="row">{{ $item->sht_no_en }}</td>
                <td scope="row">{{ $item->sht_no_bn }}</td>
                <td scope="row">{{ $item->l_code_en }}</td>
                <td scope="row">{{ $item->l_code_bn }}</td>
                <td scope="row">{{ $item->l_name_en }}</td>
                <td scope="row">{{ $item->l_name_bn }}</td>
                <td scope="row">{{ $item->plot_no_en }}</td>
                <td scope="row">{{ $item->plot_no_bn }}</td>
                <td scope="row">{{ $item->sv_type_en }}</td>
                <td scope="row">{{ $item->sv_type_bn }}</td>
                <td scope="row">{{ $item->scale_en }}</td>
                <td scope="row">{{ $item->scale_bn }}</td>
                <td scope="row">{{ $item->sv_year_en }}</td>
                <td scope="row">{{ $item->sv_year_bn }}</td>
                <td scope="row">{{ $item->rev_no_en }}</td>
                <td scope="row">{{ $item->rev_no_bn }}</td>
                <td scope="row">{{ $item->geocode_en }}</td>
                <td scope="row">{{ $item->remarks }}</td>
                <td scope="row"></td>
            </tr>
        @endforeach
    </tbody>
</table>