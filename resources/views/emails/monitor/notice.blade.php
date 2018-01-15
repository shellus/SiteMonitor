@extends('../../layouts.email')
<?php /** @var \App\Snapshot $snapshot */ ?>
@section('content')
    <div class="container">
        <div class="panel panel-default">
            项目: {{ $snapshot->monitor->title }}<br>
            <br>
            状态：{{ $snapshot->status_message }}
            <br>
            产生时间: {{ $snapshot->created_at }}<br>
            URL: {{ $snapshot->monitor->request_url }}<br>
            响应代码: {{ $snapshot->http_status_code }}<br>
            耗费时间: {{ $snapshot->time_total }} ms<br><br>
            匹配类型：{{ $snapshot->monitor->match_type }}<br>
            匹配反向：{{ $snapshot->monitor->match_reverse?"true":"false" }}<br>
            匹配内容：{{ $snapshot->monitor->match_content }}<br>
        </div>
        状态变化后，我们会及时通知您。
    </div>
@endsection
