@extends('layouts.app')

@section('content')
    <style>
        .time-table > li > label {
            min-width: 5em;
        }
    </style>
    <div class="container">
        <div class="row">
            <h2>控制台 - HTTP监控</h2>
            项目：
            <div class="btn-group">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $project->title }} <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    @foreach($projects as $projectItem)
                        <li><a href="{{ route('monitor.create') . "?project={$projectItem->id}" }}">{{ $projectItem->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <form method="post" action="{{ route('monitor.store') . "?project={$project->id}" }}">
                {{ csrf_field() }}
                <input type="hidden" name="monitor_id" value="{{ $monitor->id }}">

                <div class="form-group">
                    <label for="exampleInputEmail1">标题</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="新建监控" value="{{ $monitor->title }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" name="request_url" class="form-control" id="exampleInputEmail1" placeholder="http://www.baidu.com/" value="{{ $monitor->request_url }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求方法</label>
                    <input type="text" name="request_method" class="form-control" id="exampleInputEmail1" placeholder="GET" value="{{ $monitor->request_method?:"GET" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Headers</label>
                    <input type="text" name="request_headers" class="form-control" id="exampleInputEmail1" placeholder="Host: www.baidu.com" value="{{ $monitor->request_headers }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Request Body</label>
                    <input type="text" name="request_body" class="form-control" id="exampleInputEmail1" placeholder="a=1&b=2" value="{{ $monitor->request_body }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">不接收Body（内容匹配请勿选是）</label>
                    <label class="radio-inline">
                        <input type="radio" name="request_nobody" id="inlineRadio1" value="0" {{ $monitor->request_nobody===false?"checked":"" }}{{ $monitor->id?"":"checked" }}> 否
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="request_nobody" id="inlineRadio2" value="1" {{ $monitor->request_nobody===true?"checked":"" }}> 是
                    </label>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">跟随跳转（监测状态码为跳转后的状态码）</label>
                    <label class="radio-inline">
                        <input type="radio" name="request_follow_location" id="inlineRadio1" value="0" {{ $monitor->request_follow_location===false?"checked":"" }}> 否
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="request_follow_location" id="inlineRadio2" value="1" {{ $monitor->request_follow_location===true?"checked":"" }}{{ $monitor->id?"":"checked" }}> 是
                    </label>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数</label>
                    <input type="text" name="interval_normal" class="form-control" id="exampleInputEmail1" value="{{ $monitor->interval_normal }}{{ $monitor->id?"":"600" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数(匹配状态)</label>
                    <input type="text" name="interval_match" class="form-control" id="exampleInputEmail1" value="{{ $monitor->interval_match }}{{ $monitor->id?"":"600" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数(错误状态)</label>
                    <input type="text" name="interval_error" class="form-control" id="exampleInputEmail1" value="{{ $monitor->interval_error }}{{ $monitor->id?"":"600" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">匹配类型</label>
                    <input type="text" name="match_type" class="form-control" id="exampleInputPassword1" value="{{ $monitor->match_type }}{{ $monitor->id?"":"http_status_code" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">匹配内容</label>
                    <input type="text" name="match_content" class="form-control" id="exampleInputPassword1" value="{{ $monitor->match_content }}{{ $monitor->id?"":"200" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">反向匹配</label>
                    <label class="radio-inline">
                        <input type="radio" name="match_reverse" id="inlineRadio1" value="0" {{ $monitor->request_nobody===false?"checked":"" }}{{ $monitor->id?"":"checked" }}> 否
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="match_reverse" id="inlineRadio2" value="1" {{ $monitor->request_nobody===true?"checked":"" }}> 是
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection
