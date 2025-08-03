<!-- Users Table -->
<table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="user_table">
    <thead>
        <tr>
            <th>#</th>
            <th style="">User Name</th>
            <th class="d-none d-sm-table-cell">Info</th>
            <th class="d-none d-sm-table-cell">Roles</th>
            <th class="d-none d-sm-table-cell">Status</th>
            <!-- <th class="text-right">#</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key=>$user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>
                <a class="font-w600" href="{{ route('admin.users.edit',$user->id) }}">{{ $user->name }}</a>
            </td>
            <td>
                <div>User ID: {{ $user->user_name }}</div>
                <div>Email: <a href="mailto:{{ $user->user_email }}">{{ $user->email }}</a></div>
            </td>
            <td>
                <div>
                    @foreach($user->role as $user_role)
                        <i class="fa fa-share"></i> {{ $user_role->role->name }}<br>
                    @endforeach
                </div>
            </td>
            <td>
                <label class="css-control css-control-success css-switch">
                    <input class="css-control-input" onclick="UserSwitchButton({{ $user->id }})" type="checkbox" data-switchery {{ $user->is_active ? 'checked' : ''}} id="togBtn{{ $user->id }}" value="{{ $user->is_active }}">
                    <span class="css-control-indicator"></span>
                </label>
                <div class="pull-right switch-publish-loader-{{ $user->id }}"></div>
            </td>
            <!-- <td class="text-right">{{ $user->id }}</td> -->
        </tr>
    @endforeach
    </tbody>
</table>
<!-- END Users Table -->
