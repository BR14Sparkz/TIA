@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-body text-center">
				<img class="img img-rounded" height="150" src="http://scontent.cdninstagram.com/t51.2885-15/s480x480/e35/13534513_1722393151358294_430929682_n.jpg"/>

				<h1>{{ $user->username }}</h1>
				<h5>{{ $user->name }}</h5>
				<h5>{{ $user->dob->age }} years old</h5>
				<h5>Joined {{ $user->created_at->format('j F Y') }}</h5>

				<button class="btn btn-success">Follow</button>
			</div>
		</div>
	</div>	
</div>
@endsection