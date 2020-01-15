@extends('user.master')
@section('title', 'Thêm bài viết mới')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
	<div class="tt-wrapper-section">
		<div class="container">
			<div class="tt-user-header">
				<div class="tt-col-avatar">
					<div class="tt-icon">
						<img src="{{ url('storage/upload/images/' . Auth::user()->avatar) }}" alt="">
					</div>
				</div>
				<div class="tt-col-title">
					<div class="tt-title">
						<a href="#">{{ Auth::user()->name }}</a>
					</div>
					<ul class="tt-list-badge">
						<li><a href="#"><span class="tt-color14 tt-badge">{{ Auth::user()->roles->first()->name }}</span></a></li>
					</ul>
					@if (Auth::check())
					<ul><a href="{{ url('myaccount/post/create') }}">Tạo bài viết mới</a></ul>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		@include('user.blocks.error')
		<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="form-group has-feedback">
				<label class="" for="avatar">Ảnh đại diện</label>
				<input type="file" class="form-control" name="avatar">
			</div>
			<div class="form-group">
				<label class="" for="txtTitle">Tiêu đề</label>
				<input class="form-control" type="text" placeholder="Hãy nhập tiêu đề bài viết" name="txtTitle" id="txtTitle" value="{{ old('txtTitle') }}">
			</div>
			<div class="form-group">
				<label class="" for="txtContent">Nội dung</label>
				<textarea class="form-control" rows="5" placeholder="Hãy nhập nội dung bài viết" name="txtContent" id="txtContent" value="{{ old('txtContent') }}"></textarea>
			</div>
			<div class="form-group">
				<label for="sltCategory">Danh mục</label>
				<select class="form-control" name="sltCategory" id="sltCategory">
					@foreach($categories as $category)
					<option value="{{ $category['id'] }}">
						{{ $category['name'] }}
					</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</main>
<script src="{{ asset('user/js/bundle.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'txtContent' );
</script>
@endsection