@extends('layouts.app')

@section('content')
    <style>
        .time-table>li>label{
            min-width: 5em;
        }
    </style>
    <div class="container">
        <div class="row">
            <h3>控制台</h3>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">监控列表</div>

                <div class="panel-body">
                    <div class="row">
                        @foreach(\App\Monitor::whereUserId(Auth::id())->get() as $monitor)
                            <div class="col-sm-6 col-md-4">
                                    <h3>{{ $monitor->title }}</h3>
                                    <p>{{ $monitor->request_url }}</p>
                                平均请求时间
                                <ul class="list-unstyled time-table">
                                    <li><label>匹配规则：</label> HTTP 状态代码 不等于 200 </li>
                                    <li></li>
                                    <li><label>最后一次匹配：</label>{{ $monitor->last_match_time?:"从未" }}</li>
                                    <li><label>最后一次错误：</label>{{ $monitor->last_error_time?:"从未" }}</li>
                                    <li></li>
                                    <li><label>15分钟：</label>{{ $monitor->time_total_average_15minute }}毫秒</li>
                                    <li><label>30分钟：</label>{{ $monitor->time_total_average_30minute }}毫秒</li>
                                    <li><label>1小时： </label>{{ $monitor->time_total_average_1hour }}    毫秒</li>
                                    <li><label>12小时：</label>{{ $monitor->time_total_average_12hour }}  毫秒</li>
                                    <li><label>24小时：</label>{{ $monitor->time_total_average_24hour }}  毫秒</li>
                                </ul>
                                    <p>
                                        @if($monitor->last_error==1)
                                            <span class="label label-danger">请求错误</span>
                                        @elseif($monitor->last_match==1)
                                            <span class="label label-warning">匹配命中</span>
                                            @else
                                            <span class="label label-success">未匹配</span>
                                        @endif
                                        <br>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
