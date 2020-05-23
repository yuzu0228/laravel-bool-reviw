@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/top.css')}}" type="text/css" />
@endsection

@section('content')
	@if(!isset($reviews[0]['kind']))
		<h1 class="title">「{{$keyword}}」の検索結果…</h1>
		<p class="no-review">レビューはありません。</p>
	@endif
	@foreach($reviews as $review)
		@if ($loop->first)
        	<h1 class="title">「{{$keyword}}」の検索結果…</h1>
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
		            	
		            	<div class="favorite_counter">
		            		<span><i class="far fa-heart"></i>{{$review->favorite_counter()}}</span>
		            		<span><i class="far fa-comment"></i>{{$review->comment_counter()}}</span>
		            	</div>
		            	
		            	@if(!empty($review->image))
		                	<form action="{{route('show')}}" method="post">
			                	@csrf
			                	<input type="hidden" name="id" value="{{$review->id}}">
			                	<input type="hidden" name="title" value="{{$review->title}}">
			                	<div class="image-wrapper index">
			                		<input type="image" src="{{asset('storage/images/' . $review->image )}}" class="book-image">
			                	</div>
		                	</form>
		                @else
		                	<form action="{{route('show')}}" method="post">
			                	@csrf
			                	<input type="hidden" name="id" value="{{$review->id}}">
			                	<input type="hidden" name="title" value="{{$review->title}}">
			                	<div class="image-wrapper index">
			                		<input type="image" src="{{asset('images/dummy.png')}}" class="book-image">
			                	</div>
		                	</form>
		                @endif
		                
		                
		                <h3 class="h3 book-title">{{$review->title}}</h3>
		                <p class="issued-info">
		                	発行日：
		                	@if($review->issued_year == 0)
		                		不明
		                	@else
		                		{{$review->issued_year}}年{{$review->issued_month}}月{{$review->issued_date}}日
		                	@endif
		                </p>
		                <p class="price">
		                	値段：
		                	@if($review->price == 0)
		                		不明
		                	@else
		                		{{$review->price}}円
		                	@endif
		                </p>
		                <form action="{{route('show')}}" method="post">
		                	@csrf
		                	<input type="hidden" name="id" value="{{$review->id}}">
		                	<input type="hidden" name="title" value="{{$review->title}}">
		                	<input type="submit" value="続きを見る" class="btn btn-success detail-btn">
		                </form>
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