@extends('layouts.app')

@section('content')
<h1 class="pagetitle">レビュー編集ページ</h1>

@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="row justify-content-center container">
	<div class="col-md-10">
		<form action="{{route('update', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label>本のタイトル</label>
						<input type="text" name="title" class="form-control" value="{{old('title', $data->title)}}">
					</div>
					<div class="form-group">
						<label>レビュー本文</label>
						<textarea class="description form-control" name="body">{{old('body', $data->body)}}</textarea>
					</div>
					<div class="form-group">
						<label class="label-price">価格(任意)</label>
						<input type="number" name="price" class="form-control price"><span>円</span>
					</div>
					<div class="form-group isseud-info">
						<label class="label-issued">発行日(任意)</label>
						<input type="number" name="issued-year" class="form-control issued-year">年<input type="number" name="issued-month" class="form-control">月<input type="number" name="issued-date" class="form-control">日
					</div>
					<div class="form-group">
						<label>URL(任意)</label>
						<input type="text" name="url" class="form-control" value="{{old('url', $data->url)}}">
					</div>
					<div class="form-group">
						<label for="file1">本のサムネイル(任意)</label>
						<input type="file" id="file1" name="image" class="form-control-file">
					</div>
					<div class="form-group">
						<label>本のジャンル</label>
						<select name="kind">
							<option value="HTML&CSS">HTML&CSS</option>
							<option value="JavaScript">JavaScript</option>
							<option value="jQuery">jQuery</option>
							<option value="PHP">PHP</option>
							<option value="Laravel">Laravel</option>
							<option value="WordPress">WordPress</option>
							<option value="Ruby">Ruby</option>
							<option value="Ruby on Rails">Ruby on Rails</option>
							<option value="その他">その他</option></option>
						</select>
					</div>
					<div class="form-group">
						<label>本の評価(★1~5)</label>
						<select name="rating">
							<option value="1">1:★☆☆☆☆</option>
							<option value="2">2:★★☆☆☆</option>
							<option value="3">3:★★★☆☆</option>
							<option value="4">4:★★★★☆</option>
							<option value="5">5:★★★★★</option>
						</select>
					</div>
					<input type="submit" class="btn btn-primary" value="レビューを登録">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection