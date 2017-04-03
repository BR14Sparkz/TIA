@extends('layouts.app')

@section('content')

     <section class="jumbotron text-center" id="home-splash" style="margin-top: -22px;">
      <div class="container">
        <h1 class="jumbotron-heading">"What's Airsoft?"</h1>
        <p class="lead text-muted">So everyones talking about the new hobby in town,<br> and you want to know more...</p>
        <p>
          <a href="#" class="btn btn-primary">Let's Start</a>
          <a href="#" class="btn btn-primary">Find out more</a>
        </p>
      </div>
    </section>

    <section>
      <div class="container">

        <div class="row">
            <h2>The Airsoft Information Center</h2>
            <p class="lead">With the internet full on information or various versions of the same topic, We look to bring to you advice and information that will improve your understanding of Airsoft and all the technical bits to go with it.</p>
        </div>

        </div>
    </section>

    <div class="album text-muted">
      <div class="container">
        <div class="row">

            <h3>Recent Topics</h3>
            <div class="row"><!-- List Container -->

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

            </div><!-- End of List Container --> 

        </div>
      </div>
    </div>

@endsection

@section('footer')

    <footer class="container-fluid text-center"> 
        <div class="container">
            <hr>             
            <p>
                This is Airsoft &copy; 2017, All rights Reserved
            </p>
            <hr> 
        </div> 
    </footer>

@endsection

