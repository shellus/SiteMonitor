
        <p>
            @if($monitor->no_notice_error!==false)
                <span class="label label-warning" title="请求错误和错误恢复时，不会发送邮件通知">不通知错误</span>
            @endif
            @if($monitor->no_notice_match!==false)
                <span class="label label-warning" title="命中匹配和恢复未命中时，不会发送邮件通知">不通知匹配</span>
            @endif

            @if($monitor->is_public!==false)
                <span class="label label-info">公开监控</span>
            @endif
            @if($monitor->is_enable===false)
                <span class="label label-warning">已停用</span>
            @endif
            <span class="label label-{{ $monitor->data->lastStatusLevelLabel() }}">{{ $monitor->data->last_status_text }}</span>
        </p>
        <p>
            <a target="_blank" href="{{ $monitor->request_url }}">{{ str_limit($monitor->request_url,30) }}</a>
        </p>
        <ul class="list-unstyled">
            <li><label>请求间隔：</label> {{ $monitor->interval_normal }} 秒</li>
            <li>
                <label>最后一次请求：</label>{{ $monitor->data->last_request_time?$monitor->data->last_request_time->diffForHumans():"从未" }}
            </li>
            <li>
                <label>最后一次匹配：</label>{{ $monitor->data->last_match_time?$monitor->data->last_match_time->diffForHumans():"从未" }}
            </li>
            <li>
                <label>最后一次错误：</label>
                @if($monitor->data->last_error_time && $monitor->data->last_error_time > \Carbon\Carbon::now()->subHour(1))
                    <span class="bg-danger">{{ $monitor->data->last_error_time->diffForHumans() }}</span>
                @elseif($monitor->data->last_error_time && $monitor->data->last_error_time > \Carbon\Carbon::now()->subHour(24))
                    <span class="bg-warning">{{ $monitor->data->last_error_time->diffForHumans() }}</span>
                @else
                    {{ $monitor->data->last_error_time?$monitor->data->last_error_time->diffForHumans():"从未" }}
                @endif
            </li>
            <li><label>1小时平均： </label>
                @if($monitor->data->time_total_average_1hour)
                    {{ $monitor->data->time_total_average_1hour }}毫秒
                @else
                    <span class="bg-warning">无数据</span>
                @endif
            </li>
        </ul>
