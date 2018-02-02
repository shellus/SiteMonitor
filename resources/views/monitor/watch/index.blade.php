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
            <h1>我的关注 - HTTP监控</h1>
        </div>
        <br>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">监控列表</div>

                <div class="panel-body">
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

                                        <form style="display: inline;" action="{{ route('monitor.CancelWatch') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $monitor->id }}">
                                            <button class="btn btn-default btn-sm">
                                                取消关注
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                    </p>
                                    <h3>{{ $monitor->title }}</h3>
                                    @include('monitor.item', ['monitor'=>$monitor, 'share'=>false])
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
