@extends('layouts.app')

@section('content')
    <style>

        .thumbnail {
            padding-left: 1em;
            padding-top: 1.5em;
        }
        .demo-container {
            box-sizing: border-box;
            width: 310px;
            height: 150px;
            padding: 5px;
            /*margin: 15px auto 30px auto;*/
            /*border: 1px solid #ddd;*/
            background: #fff;
        }
        .demo-placeholder {
            width: 100%;
            height: 100%;
            font-size: 12px;
            line-height: 1.2em;
        }
    </style>
    <div class="container">
        <div class="page-header">
            <h1>控制台 - HTTP监控</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                项目：
                <div style="display: inline-block;" class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ $project->title }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @foreach($projects as $projectItem)
                            <li><a href="{{ route('monitor.index') . "?project={$projectItem->id}" }}">{{ $projectItem->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                &nbsp;
                <a href="{{ route('project.create') }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                &nbsp;
                <a href="{{ route('project.edit', $project->id) }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                &nbsp;
                <form id="project-destroy" style="display: inline;" action="{{ route('project.destroy', $project->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" onclick="$(this).parent().submit();return false;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </form>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a class="btn btn-success" href="{{ route('monitor.create') }}">
                        增加监控
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">监控列表</div>

                <div class="panel-body">
                    <div class="row">
                        @foreach($project->monitors()->with('data')->get() as $monitor)
                            <div class="modal fade snapshotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="snapshotModal-{{ $monitor->id }}">
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
                                        <a class="btn btn-default btn-sm" href="{{ route('snapshot.index')."?monitor_id=$monitor->id" }}" data-toggle="modal" data-target="#snapshotModal-{{ $monitor->id }}">
                                            快照列表
                                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                        </a>
                                        <a class="btn btn-default btn-sm" href="{{ route('monitor.edit', $monitor->id) }}">
                                            修改监控
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </a>
                                    </p>
                                    <h3>{{ $monitor->title }}</h3>
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.bootcss.com/flot/0.8.3/jquery.flot.time.min.js"></script>


    <script>
        $(document).on("click", '.snapshotModal .pagination a', function(event){
            $(this).parents(".modal-content").load($(this).attr("href"));
            event.preventDefault();
        });
    </script>

    <script type="text/javascript">
        $("<div id='tooltip'></div>").css({
            position: "absolute",
            display: "none",
            border: "1px solid #fdd",
            padding: "2px",
            "background-color": "#fee",
            opacity: 0.80
        }).appendTo("body");
        $(".placeholder").bind("plothover", function (event, pos, item) {

                var str = "(" + pos.x.toFixed(2) + ", " + pos.y.toFixed(2) + ")";
                $("#hoverdata").text(str);

                if (item) {
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    bo=plotOptions.xaxis.tickFormatter(x, null);
                    $("#tooltip").html(bo + " 分钟前 " + " 访问耗时" + y + "毫秒")
                        .css({top: item.pageY-30, left: item.pageX+1})
                        .fadeIn(200);
                } else {
                    $("#tooltip").hide();
                }
        });
        var plotOptions = {
            series: {
                lines: { show: true },
                points: { show: false }
            },
            yaxis: {
                show: true,
                autoscaleMargin: 2/*,
                    max: 1000,
                    tickSize: 200,*/
            },
            xaxis: {
                mode: "time",
//                    timeformat: "%H-%M",
                tickFormatter: function (val, axis) {
                    var d = new Date(parseInt(val));
                    var n = new Date();
                    var diff = (n.getTime()-d.getTime())/60000;
                    return parseInt(diff)+"";
                },
                minTickSize: [5, "minute"]
            },
            grid: {
                clickable: true,
                hoverable: true,
                autoHighlight: true,
            }
        };
        $(function() {

            $(".placeholder").each(function(){
                var d1 = $(this).parent().data("flot");
                for(var i in d1){
                    d1[i][0] = (d1[i][0] + 0) * 1000
                }
                var data = [
                    {
                    label: "1 hours",
                    data: d1
                    }/*,
                    {
                        label: "x轴为N分钟前",
                        data: []
                    },
                    {
                        label: "y轴为请求耗时毫秒数",
                        data: []
                    }*/
                ];
                $.plot($(this), data, plotOptions);
            });

        });
    </script>

@endsection
