@extends('layouts.app')	

@section('content')
<div class="container">
	<div class="row">

		@forelse($articles as $article)
			<div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail">

                    <img src="{{ $article->image }}" class="img-responsive img-rounded" alt="{{ $article->title }}">

                    <div class="caption">
                        <h3>{{ $article->title }}</h3>
                        <p style="min-height:90px">{{ $article->shortContent }}</p>
                        <p class="text-right"> 
                            <a href="/articles/{{ $article->id }}" class="btn btn-primary" role="button">Read more</a>
                        </p>
                    </div>
                       
                </div>  
            </div>
		@empty
			No Articles
		@endforelse
		
	</div>	

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			{{ $articles->links() }}
		</div>
	</div>
</div>
@endsection