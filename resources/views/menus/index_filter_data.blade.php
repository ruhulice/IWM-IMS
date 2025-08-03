<!-- Menus Table -->
<table id="menu-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
    <thead>
        <tr>
            <th>#</th>
            <th>Icon</th>
            <th>Name</th>
            <th>Order</th>
            <th>Parent</th>
            <th>URL</th>
            <th>Status</th>
            <th width="60px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $key=>$menu)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $menu->icon }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->menu_order}}</td>
                <td>{{ $menu->parent->name }}</td>
                <td>{{ $menu->menu_url}}</td>
                <td>
                    <label class="css-control css-control-success css-switch">
                        <input class="css-control-input" onclick="MenuSwitchButton({{ $menu->id }})" type="checkbox" data-switchery {{ $menu->status_id ? 'checked' : ''}} id="togBtn{{ $menu->id }}" value="{{ $menu->status_id }}">
                        <span class="css-control-indicator"></span>
                    </label>
                    <div class="pull-right switch-publish-loader-{{ $menu->id }}"></div>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.menus.edit',$menu->id) }}" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Icon</th>
            <th>Name</th>
            <th>Order</th>
            <th>Parent</th>
            <th>URL</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<!-- END Menus Table -->
