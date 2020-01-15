@extends('admin.layout.master')
@section('title', 'Danh sách bình luận')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('contents')
<div class="wrapper">
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Danh sách bình luận
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Comment List</li>
			</ol>
		</section>
		<section class="content container-fluid">
			@if(empty($comments))
			<p>No Data</p>
			@else
			<table class="table table-bordered table-striped table-hover table-responsive">
				<thead class="thead-dark">
					<tr class="text-center">
						<th class="text-center align-middle">STT</th>
						<th class="text-center align-middle">Nội dung</th>
						<th class="text-center align-middle">Bài viết</th>
						<th class="text-center align-middle">Người gửi</th>
						<th class="text-center align-middle">Hoạt động</th>
						<th class="text-center align-middle">Thời gian<br>gửi</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0 ?>
					@foreach ($comments as $comment)
					<?php $stt = $stt + 1 ?>
					<tr>
						<td class="text-center align-middle">{{ $stt }}</td>
						<td class="text-center align-middle">{{ $comment['content'] }}</td>
						<td class="text-center align-middle"><a href="{{ url('post/' . $comment['post']['id']) }}">{{ $comment['post']['title'] }}</a></td>
						<td class="text-center align-middle"><a href="{{ url('admin/user/show/' . $comment['user']['id']) }}">{{ $comment['user']['name'] }}</a></td>
						<td class="text-center align-middle">
							<input type="checkbox" data-id="{{ $comment->id }}" name="is_active" class="js-switch" {{ $comment->is_active == 1 ? 'checked' : '' }}>
						</td>
						<td class="text-center align-middle">{{ $comment['created_at'] }}</td>
						<td class="text-center align-middle">
							@if (($comment['user']['role'] == 1) || ($comment['user']['role'] == 1 && ($comment['user']['id'] != Auth::comment()->id)))
								<form action="" method="POST">
									@csrf
									<button class="btn btn-danger" disabled="disabled"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</form>
							@else
								<form action="{{ url('admin/comment/delete/' . $comment->id) }}" method="POST">
									@csrf
									<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</section>
	</div>
	<div class="control-sidebar-bg">
	</div>
</div>
@endsection
@section('script')
	<script>
		let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		elems.forEach(function(html) {
			let switchery = new Switchery(html,  { size: 'small' });
		});

		$(document).ready(function(){
			$('.js-switch').change(function () {
				let is_active = $(this).prop('checked') === true ? 1 : 0;
				let commentId = $(this).data('id');
				console.log(is_active, commentId);
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('admin.comment.active.update') }}',
					data: {'is_active': is_active, 'comment_id': commentId},
					success: function (data) {
						toastr.options.closeButton = true;
						toastr.options.closeMethod = 'fadeOut';
						toastr.options.closeDuration = 100;
						toastr.success(data.message);
					}
				});
			});
		});
	</script>
@endsection
