@extends('../layouts.email')
<?php /** @var \App\Snapshot $snapshot */ ?>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    这是一封测试邮件，如果收到，说明通讯状况良好
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
