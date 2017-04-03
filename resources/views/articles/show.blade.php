@extends ('layouts.app')

@section ('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">

			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-1">	

				<div class="panel panel-default">

					<div class="panel-heading">
						<h4>{{ $article->title }}</h4>						
					</div>

					<div class="panel-body">

						<img src="{{ $article->image }}" class="img-responsive img-rounded" alt="{{ $article->title }}">
						<hr>
						<p class="lead">strapline content here</p>
						<p>{{ $article->content }}</p>

					</div>	

				</div>
			</div>

			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-0">
				<div class="col-sm-6 col-md-12">
					<div class="panel panel-default">

						<div class="panel-heading">
							<span>
								Details
							</span>						
						</div>

						<div class="panel-body">

							<!-- Share / views / categories -->

							<p>Last Updated: <span class="pull-right">{{ $article->updated_at->diffForHumans() }}</span></p>						

							<p>Views: <span class="pull-right">000</span></p>	

							<p>Keywords: <span class="pull-right">airsoft, aeg, military</span></p>	

							<p>Sources: <span class="pull-right"><a href="/">This is airsoft</a></span></p>					

							<p>Additional Facts:</p>
							<p></p>
							

							@if($article->user_id == Auth::id())
							
							@endif

						</div>

						<div class="panel-footer">
							<div class="btn-toolbar">
								<a href="/articles/{{ $article->id }}/edit"><button type="button" class="btn btn-success btn-sm">Edit</button></a>				

								<form method="POST" action="/articles/{{ $article->id }}">
								<button type="button" class="btn btn-danger btn-sm margin-left">Delete</button>
								{{ csrf_field() }}

								{{ method_field('DELETE') }}								
								</form>
							</div>
						</div>

					</div>
				</div>

				<div class="col-sm-6 col-md-12 col-md-offset-0">
					<div class="panel panel-default ">

						<div class="panel-heading">
							<span>
								Article Sponsor
							</span>						
						</div>

						<div class="panel-body text-center">
							<img src="{{ $article->image }}" class="img-responsive img-rounded center-block" alt="{{ $article->title }}">
							<hr>
							<p>This is Airsoft</p>
						</div>					

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection