<div class="row">
    @foreach($monitors as $monitor)
        <div class="modal fade snapshotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             id="snapshotModal-{{ $monitor->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <div class="demo-container" data-flot="{{ $monitor->data->last_1hour_table_cache }}">
                    <div class="demo-placeholder placeholder"></div>
                </div>
                <p>
                    <a class="btn btn-default btn-sm" href="{{ route('snapshot.index')."?monitor_id=$monitor->id" }}"
                       data-toggle="modal" data-target="#snapshotModal-{{ $monitor->id }}">
                        快照列表
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    </a>

                    <a class="btn btn-default btn-sm" href="{{ route('monitor.edit', $monitor->id) }}">
                        修改监控
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
@if($monitor->is_public)
                    <a class="btn btn-default btn-sm" href="{{ route('monitor.share') }}?id={{ $monitor->id }}">
                        分享监控
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
@endif
                </p>
                <h3>{{ $monitor->title }}</h3>
                @include('monitor.item', ['monitor'=>$monitor, 'share'=>false])
            </div>
        </div>
    @endforeach
</div>