@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('auth.home') }}</div>

				<div class="panel-body">
					{{ trans('messages.logged_in') }}! <a href="{{ LaravelLocalization::localizeURL('profile', LaravelLocalization::getCurrentLocale()) }}">{{ trans('messages.go_to_profile') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
