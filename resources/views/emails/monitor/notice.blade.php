@extends('../../layouts.email')
<?php /** @var \App\Snapshot $snapshot */ ?>
@section('content')
<div class="container">
    <div class="panel panel-default">
        项目: {{ $snapshot->monitor->title }}<br>
        <br>
        状态：{{ $statusText }}<br>
        产生时间: {{ $snapshot->created_at }}<br>
        URL: {{ $snapshot->monitor->request_url }}<br>
        响应代码: {{ $snapshot->http_status_code }}<br>
        耗费时间: {{ $snapshot->time_total }}
    </div>
    恢复正常后，我们会及时通知您。
</div>
@endsection
