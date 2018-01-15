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
        </div>
        <div class="row">
            <div class="col-md-8">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form method="post" action="{{ route('monitor.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $monitor->id }}">

                <div class="form-group">
                    <label for="exampleInputEmail1">项目</label>
                    <select class="form-control" name="project_id">
                        @foreach($projects as $projectItem)
                            <option value="{{ $projectItem->id }}" {{ $projectItem->id === $monitor->project_id?"selected=\"selected\"":""}}>{{ $projectItem->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">标题</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="新建监控" value="{{ $monitor->title }}{{ $monitor->id?"":\App\Monitor::generateTitle() }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">URL</label>
                    <input type="text" name="request_url" class="form-control" id="exampleInputEmail1" placeholder="http://www.baidu.com/" value="{{ $monitor->request_url }}">
                </div>
                <a class="btn btn-info btn-sm" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    点击展开详细请求信息编辑
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                </a>
                <br><br>
                <div class="collapse" id="collapseExample">
                    <div class="form-group">
                        <label for="exampleInputEmail1">请求方法</label>
                        <input type="text" name="request_method" class="form-control" id="exampleInputEmail1" placeholder="GET" value="{{ $monitor->request_method?:"GET" }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Headers</label>
                        <textarea name="request_headers" class="form-control" rows="3" placeholder="Host: www.baidu.com" value="{{ $monitor->request_headers }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Request Body</label>
                        <textarea name="request_body" class="form-control" rows="3" placeholder="a=1&b=2" value="{{ $monitor->request_body }}"></textarea>
                    </div>
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
                    <select class="form-control" name="match_type">
                        <option value="http_status_code" {{ $monitor->match_type === "http_status_code"?"selected=\"selected\"":""}}{{ $monitor->id?"":"selected=\"selected\"" }}>HTTP响应状态代码匹配</option>
                        <option value="include"  {{ $monitor->match_type === "include"?"selected=\"selected\"":""}}>关键字匹配</option>
                        <option value="timeout"  {{ $monitor->match_type === "timeout"?"selected=\"selected\"":""}}>超时匹配（秒）</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">匹配内容</label>
                    <input type="text" name="match_content" class="form-control" id="exampleInputPassword1" value="{{ $monitor->match_content }}{{ $monitor->id?"":"200" }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">反向匹配</label>
                    <label class="radio-inline">
                        <input type="radio" name="match_reverse" id="inlineRadio1" value="0" {{ $monitor->match_reverse===false?"checked":"" }}{{ $monitor->id?"":"checked" }}> 否
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="match_reverse" id="inlineRadio2" value="1" {{ $monitor->match_reverse===true?"checked":"" }}> 是
                    </label>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">是否启用</label>
                    <label class="radio-inline">
                        <input type="radio" name="is_enable" id="inlineRadio1" value="0" {{ $monitor->is_enable===false?"checked":"" }}> 否
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_enable" id="inlineRadio2" value="1" {{ $monitor->is_enable===true?"checked":"" }}{{ $monitor->id?"":"checked" }}> 是
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <button form="monitor-destroy" class="btn btn-danger">删除监控</button>
            </form>
            </div>
        </div>

        <form id="monitor-destroy" action="{{ route('monitor.destroy', $monitor->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    </div>
    <br><br><br><br>
@endsection
