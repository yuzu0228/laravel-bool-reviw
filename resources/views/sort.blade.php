@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/top.css')}}" type="text/css" />
@endsection

@section('content')
	@if(!isset($reviews[0]['kind']))
		<p class="no-review">レビューはありません。</p>
	@endif
	@foreach($reviews as $review)
		@if ($loop->first)
        	<h1 class="title">{{$review->kind}}</h1>
    	@endif
    @endforeach
	<div class="row justify-content-center">
		@foreach($reviews as $review)
		    <div class="col-md-4">
		        <div class="card mb50">
		            <div class="card-body">
		            	<a href="{{route('sort', ['kind' => $review->kind])}}" class="btn btn-outline-primary">{{$review->kind}}</a>
		            	<span class="rating">
		            		@switch($review->rating)
		            		@case(1)
		            		<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
		            		@break
		            		@case(2)
		            		<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
		            		@break
		            		@case(3)
		            		<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
		            		@break
		            		@case(4)
		            		<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
		            		@break
		            		@case(5)
		            		<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
		            		@break
		            		@endswitch
		            	</span>
		            	@if(!empty($review->image))
		            		<div class="image-wrapper sort"><img class="book-image" src="{{asset('storage/images/' . $review->image )}}"></div>
		            	@else
		                	<div class="image-wrapper"><img class="book-image" src="{{asset('images/dummy.png')}}"></div>
		                @endif	
		                <h3 class="h3 book-title">{{$review->title}}</h3>
		                <p class="description">{{$review->body}}</p>
		                <a href="{{route('show', ['id' => $review->id])}}" class="btn btn-success detail-btn">詳細を読む<i class="fas fa-arrow-circle-right"></i></a>
		            </div>
		        </div>
		    </div>
		@endforeach
	</div>
	{{$reviews->links()}}
	
	<div class="categories white">
		<h2 class="title">Categories</h2>
			<ul>
				<li><a href="{{route('sort', ['kind' => 'HTML&CSS'])}}">HTML&CSS({{$count_htmlcss}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'JavaScript'])}}">JavaScript({{$count_javascript}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'jQuery'])}}">jQuery({{$count_jquery}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'PHP'])}}">PHP({{$count_php}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'WordPress'])}}">WordPress({{$count_wordpress}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'Laravel'])}}">Laravel({{$count_laravel}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'Ruby'])}}">Ruby({{$count_ruby}})</a></li>
    			<li><a href="{{route('sort', ['kind' => 'Ruby on Rails'])}}">Ruby on Rails({{$count_ruby_on_rails}})</a></li>
				<li><a href="{{route('sort', ['kind' => 'その他'])}}">その他({{$count_etc}})</a></li>
			</ul>
	</div>
@endsection