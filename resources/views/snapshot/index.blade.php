<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">快照列表</h4>
</div>
<div class="modal-body">
    <ul class="">
        @foreach($snapshots as $snapshot)

            <li>
                <span class="label label-{{ $snapshot->getLabel() }}">{{ $snapshot->status_text }}</span>
                <a target="_blank" href="{{ route('snapshot.show', $snapshot) }}">{{ $snapshot->created_at }}</a>
                @if($snapshot->is_notice)
                    <span class="label label-info" title="这次快照给你发送了通知">Notice</span>
                @endif
            </li>
        @endforeach
    </ul>
    {{ $snapshots->appends(Request::all())->links() }}
</div>
<div class="modal-footer">
    <button form="project-create-form" class="btn btn-primary">提交</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
</div>