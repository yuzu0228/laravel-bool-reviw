@extends('layouts.app')

@section('css')
	<link rel="stylesheet" href="{{asset('css/show.css')}}" type="text/css">
@endsection

@section('content')
	<div class="container">
		<h1 class="pagetitle">レビュー詳細ページ</h1>
		<div class="card">
			<div class="card-body d-flex">
				<section class="review-main">
					<h2 class="h2">本のタイトル</h2>
					<p class="h2 mb20">{{$review->title}}</p>
					<h2 class="h2">レビュー本文</h2>
					<p>{{$review->body}}</p>
				</section>
				<aside class="review-image">
					@if(!empty($review->image))
						<img class="book-image" src="{{asset('storage/images/' . $review->image )}}"></img>
					@else
						<img class="book-image" src="{{asset('images/dummy.png')}}">
					@endif
				</aside>
			</div>
			<a href="{{route('index')}}" class="btn btn-info btn-back mb20">一覧へ戻る</a>
		</div>
	</div>
@endsection