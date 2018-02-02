@extends('layouts.app')

@section('content')
    <style>

    </style>
    <div class="container">
        <div class="page-header">
            <h1>查看分享 - HTTP监控</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $monitor->title }}</h1>
                    @include('monitor.item', ['monitor'=>$monitor, 'share'=>true])

                <form action="{{ route('monitor.Watch') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $monitor->id }}">
                    <button class="btn btn-success" href="{{ route('monitor.edit', $monitor->id) }}">
                        关注监控
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </button>
                </form>

                <p>关注监控后，该监控条目产生的提醒会发送到您的邮箱（或其他提醒方式）中， 您可以查看监控信息和监控快照，但是无法修改监控信息</p>
            </div>
        </div>
        <br>
    </div>
@endsection

@section('foot')
@endsection
