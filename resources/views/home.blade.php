@extends('layouts.app')

@section('content')
    <style>

.thumbnail{
    padding-left: 1em;
}
    </style>
    <div class="container">
        <div class="row">
            <h2>控制台 - HTTP监控</h2>
            <div class="text-right">
                <a class="btn btn-success" href="{{ route('monitor.create') }}">
                    增加监控
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">监控列表</div>

                <div class="panel-body">
                    <div class="row">
                        @foreach(\App\Monitor::whereUserId(Auth::id())->get() as $monitor)
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <h3>{{ $monitor->title }}</h3>
                                    <p>
                                        @if($monitor->last_error==1)
                                            <span class="label label-danger">请求错误</span>
                                        @elseif($monitor->last_match==1)
                                            <span class="label label-warning">匹配命中</span>
                                        @else
                                            <span class="label label-primary">未匹配</span>
                                        @endif
                                        {{ $monitor->request_url }}</p>
                                    <ul class="list-unstyled">
                                        <li><label>匹配规则：</label> HTTP 状态代码 不等于 200</li>
                                        <li><label>最后一次请求：</label>{{ $monitor->last_request_time?$monitor->last_request_time->diffForHumans():"从未" }}</li>
                                        <li><label>最后一次匹配：</label>{{ $monitor->last_match_time?$monitor->last_match_time->diffForHumans():"从未" }}</li>
                                        <li><label>最后一次错误：</label>{{ $monitor->last_error_time?$monitor->last_error_time->diffForHumans():"从未" }}</li>
                                        <li><label>1小时平均： </label>{{ $monitor->time_total_average_1hour }} 毫秒</li>
                                    </ul>
                                    <p>
                                        <a class="btn btn-info btn-sm" href="#">
                                            快照列表
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                        </a>
                                        {{--<span class="badge">{{ $monitor->snapshots()->count() }}</span>--}}

                                        <a class="btn btn-danger btn-sm" href="#">
                                            暂停监控
                                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
