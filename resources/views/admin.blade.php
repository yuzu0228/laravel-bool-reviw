@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/top.css')}}" type="text/css" />
@endsection

@section('content')
	<h1 class="title">{{ Auth::user()->name }}さんが書いたレビュー</h1>
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
		            		<div class="image-wrapper"><img class="book-image" src="{{asset('storage/images/' . $review->image )}}"></div>
		            	@else
		                	<div class="image-wrapper"><img class="book-image" src="{{asset('images/dummy.png')}}"></div>
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
		                <div class="admin-btns">
		                <form action="{{route('show')}}" method="post">
		                	@csrf
		                	<input type="hidden" name="id" value="{{$review->id}}">
		                	<input type="hidden" name="title" value="{{$review->title}}">
		                	<input type="submit" value="詳細を読む" class="btn btn-success">
		                </form>
		                <a href="{{route('edit', ['id' => $review->id])}}" class="btn btn-info">編集する</a>
		                <form action="{{route('delete', ['id' => $review->id])}}" method='post'>
    						@csrf
           					<input type="submit" name="delete" class="btn btn-warning" value="削除する" onClick="delete_alert(event);return false;">
  						</form>
		                </div>
		            </div>
		        </div>
		    </div>
		@endforeach
	</div>
	{{$reviews->links()}}
	
	<div class="categories">
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
