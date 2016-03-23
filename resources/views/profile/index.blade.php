@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('auth.profile') }}</div>
				<div class="panel-body">
 
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>   
                    @endif
                    
                    
                    @if (count($errors) > 0)
						<div class="alert alert-danger">
							{{ trans('messages.fix_errors') }}:<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

                    
					{!! Form::open(['route' => 'profile.update', 'class' => 'form-horizontal']) !!}	
						<div class="form-group">
							{!! Form::label('login', trans('auth.login'), array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
                                {!! Form::text('login', old('login') ? old('login') : $user->login, ['class' => 'form-control']); !!}
                            </div>
						</div>

						<div class="form-group">
							{!! Form::label('email', trans('auth.email'), array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
                                {!! Form::text('email', old('email') ? old('email') : $user->email, ['class' => 'form-control']); !!}
							</div>
						</div>
                        
                        <div class="form-group">
							{!! Form::label('name', trans('auth.name'), array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
                                {!! Form::text('name', old('name') ? old('name') : $user->name, ['class' => 'form-control']); !!}
							</div>
						</div>

                        <div class="form-group">
							<label class="col-md-4 control-label">{{ trans('auth.lang') }}</label>
							<div class="col-md-6">
                                {!! Form::select('lang', LaravelLocalization::getSupportedLocalesAssoc(), old('lang') ? old('lang') : $user->lang,  ['class' => 'form-control']); !!}
							</div>
						</div>
                        
						<div class="form-group">
							{!! Form::label('password', trans('auth.password'), array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']); !!}
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-md-4 control-label">{{ trans('auth.confirm_password') }}</label>
							<div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']); !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
									{{ trans('auth.submit_edit') }}
								</button>
							</div>
						</div>
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
