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
                        <li><a href="{{ route('monitor.index') . "?project={$projectItem->id}" }}">{{ $projectItem->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <form method="post" action="{{ route('monitor.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">标题</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="新建监控">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" name="request_url" class="form-control" id="exampleInputEmail1" placeholder="http://www.baidu.com/">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求方法</label>
                    <input type="text" name="request_method" class="form-control" id="exampleInputEmail1" placeholder="GET" value="GET">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Headers</label>
                    <input type="text" name="request_headers" class="form-control" id="exampleInputEmail1" placeholder="Host: www.baidu.com">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Request Body</label>
                    <input type="text" name="request_body" class="form-control" id="exampleInputEmail1" placeholder="a=1&b=2">
                </div>
                <div class="checkbox">
                    <label>
                        <input name="request_nobody" value="1" type="checkbox"> 不接收Body（内容匹配请勿勾选）
                    </label>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数</label>
                    <input type="text" name="interval_normal" class="form-control" id="exampleInputEmail1" placeholder="600" value="300">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数(匹配状态)</label>
                    <input type="text" name="interval_match" class="form-control" id="exampleInputEmail1" placeholder="600" value="300">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">请求间隔秒数(错误状态)</label>
                    <input type="text" name="interval_error" class="form-control" id="exampleInputEmail1" placeholder="600" value="300">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">匹配类型</label>
                    <input type="text" name="match_type" class="form-control" id="exampleInputPassword1" placeholder="http_status_code">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">匹配内容</label>
                    <input type="text" name="match_content" class="form-control" id="exampleInputPassword1" placeholder="200">
                </div>
                <div class="checkbox">
                    <label>
                        <input name="match_reverse" value="1" type="checkbox"> 是否反向匹配
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection
