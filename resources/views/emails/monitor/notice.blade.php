@extends('layouts.app')
<?php /** @var \App\Snapshot $snapshot */ ?>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    URL: {{ $snapshot->monitor->request_url }}<br>
                    耗费时间{{ $snapshot->time_total }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
