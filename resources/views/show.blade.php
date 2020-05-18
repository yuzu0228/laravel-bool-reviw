@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{asset('css/show.css')}}" type="text/css">
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body d-flex">
				<section class="review-main">
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
					<p class="h2 mb20 show-title">「{{$review->title}}」</p>
					<p>{{$review->body}}</p>
					
					<div class="show-btns-wrapper">
					@if($review->url != 'no-data')
						<a href="{{$review->url}}" class="btn btn-primary parchase-btn" target=”_blank” >購入する<i class="fas fa-shopping-cart"></i></a>
					@endif
					
					@if (Auth::check())

					    @if (Auth::user()->is_favorite($review->id))
					
					        {!! Form::open(['route' => ['favorites.unfavorite', $review->id], 'method' => 'delete']) !!}
					            {!! Form::submit('いいね ❤を外す', ['class' => "button btn btn-warning"]) !!}
					        {!! Form::close() !!}
					
					    @else
					
					        {!! Form::open(['route' => ['favorites.favorite', $review->id]]) !!}
					            {!! Form::submit('いいね ❤', ['class' => "button btn btn-success"]) !!}
					        {!! Form::close() !!}
					
					    @endif
				
					@endif
				
				<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="btn btn-primary tweet" data-show-count="false">ツイートする<i class="fab fa-twitter"></i></a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
					
				</section>
				<aside class="review-image">
					
					<p class="favorites_counter">いいね<i class="far fa-heart"></i>{{$count_favorites}}件</p>
					@if(!empty($review->image))
						<img class="book-image" src="{{asset('storage/images/' . $review->image )}}"></img>
					@else
						<img class="book-image" src="{{asset('images/dummy.png')}}">
					@endif
				</aside>
				
			</div>
			
			<section class="comments-wrapper">
				@if (Auth::check())
					@if($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
				@endif
					<form action="{{route('comment', ['id' => $review->id])}}" method="post">
						@csrf
						<div class="form-group">
							<label>コメント本文</label>
							<textarea class="description form-control" name="description" placeholder="本文を入力"></textarea>
						</div>
						<div class="form-group">
							<input class="btn btn-light" type="submit" value="コメントを投稿する">
						</div>
					</form>
				@endif
			
			
				<h2 class="h2 comment">コメント一覧({{$count_comments}})</h2><hr>
				@if(!isset($comments[0]['description']))
					<p>コメントはありません。</p>
				@endif
				
				@foreach($comments as $item)
					<div class="comment-part">
						<span>{{$item->description}}</span>
						@if(Auth::id() == $item->user_id)
							<span><a id="delete" href="{{route('comment.delete', ['id' => $item->id])}}"><i class="fas fa-trash-alt"></i></a></span>
						@endif
					</div><hr>
				@endforeach
			</section>
			
			<a href="{{route('index')}}" class="btn btn-info btn-back mb20">一覧へ戻る</a>
		</div>
	</div>
	
	<br>
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