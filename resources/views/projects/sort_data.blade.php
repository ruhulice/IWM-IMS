
<div class="row">
    <div class="col-md-6">
        <ul id="content_hrch1" class="connectedSortable ui-sortable">
            @foreach($emps as $key=>$emp)
                @if($key < $set_row)
                    <li class="ui-state-default ui-sortable-handle" data-val="{{ $emp->id }}">{{ $key+1 }}. {{ $emp->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <ul id="content_hrch2" class="connectedSortable ui-sortable">
            @foreach($emps as $key=>$emp)
                @if($key >= $set_row)
                    <li class="ui-state-default ui-sortable-handle" data-val="{{ $emp->id }}">{{ $key+1 }}. {{ $emp->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

<script type="text/javascript" data-cfasync="false">
    $('.connectedSortable').sortable({
        placeholder: "ui-state-highlight",
        connectWith: ".connectedSortable"
    });

    $('ul#content_hrch1,ul#content_hrch2').sortable({
        placeholder: "ui-state-highlight",
        connectWith: ".connectedSortable"
    });
</script>
