@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel-heading">
        <p style="text-align:center;">
            <!-- <img src="{{url('img/cache/original/logo.png')}}" alt="logo" style="width:60px;height:60px;" align="middle"></p> -->
             <img src="https://office.algolight.net/img/cache/logo/atmorlogo.png" alt="logo" style="width:60px;height:60px;" align="middle"></p>
    </div>
</div>
</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h6>Please enter your email address.You will receive a link to create a new password via email.<h6></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
