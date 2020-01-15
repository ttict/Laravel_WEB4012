@extends('admin.layout.master')
@section('title', 'Danh sách người dùng')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('contents')
<div class="wrapper">
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Danh sách người dùng
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">User List</li>
			</ol>
		</section>
		<section class="content container-fluid">
			@if(empty($users))
			<p>No Data</p>
			@else
			<table class="table table-bordered table-striped table-hover table-responsive">
				<thead class="thead-dark">
					<tr class="text-center">
						<th class="text-center align-middle">STT</th>
						<th class="text-center align-middle">Họ và tên</th>
						<th class="text-center align-middle">Ngày sinh</th>
						<th class="text-center align-middle">Số điện thoại</th>
						<th class="text-center align-middle">Email</th>
						<th class="text-center align-middle">Quyền</th>
						<th class="text-center align-middle">Hoạt động</th>
						<th class="text-center align-middle">Trạng thái</th>
						<th class="text-center align-middle">Tổng số<br>bài viết</th>
						<th class="text-center align-middle">Tổng số<br>bình luận</th>
						<th class="text-center align-middle"><a href="{{ route('admin.user.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a></th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0 ?>
					@foreach ($users as $user)
					<?php $stt = $stt + 1 ?>
					<tr>
						<td class="text-center align-middle">{{ $stt }}</td>
						<td class="text-center align-middle">{{ $user['name'] }}</td>
						<td class="text-center align-middle">{{ $user['birthday'] }}</td>
						<td class="text-center align-middle">{{ $user['phoneNumber'] }}</td>
						<td class="text-center align-middle">{{ $user['email'] }}</td>
						<td class="text-center align-middle">
							@if($user->roles->count() != 0)
								{{-- @php(dd($user->roles)) --}}
								@foreach ($user->roles as $role)
									{{ $role['name'] }}
								@endforeach
							@endif
						</td>
						<td class="text-center align-middle">
							@if (($user->roles->first()->name == 'Admin'))
								<input type="checkbox" data-id="{{ $user->id }}" name="is_active" class="js-switch" {{ $user->is_active == 1 ? 'checked' : '' }} disabled="disabled">
							@else
								<input type="checkbox" data-id="{{ $user->id }}" name="is_active" class="js-switch" {{ $user->is_active == 1 ? 'checked' : '' }}>
							@endif
						</td>
						<td class="text-center align-middle">
							@if($user->isOnline())
                                <i class="fa fa-circle text-success"></i>
							@else
                                <i class="fa fa-circle text-danger"></i>
							@endif
						</td>
						<td class="text-center align-middle">{{ $user->post->count() }}</td>
						<td class="text-center align-middle">{{ $user->comment->count() }}</td>
						<td class="text-center align-middle">
							@if (($user->roles->first()->name == 'Admin' && ($user['id'] != Auth::user()->id)))
								<a href="#" class="btn btn-primary" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							@else
								<a href="{{ url('admin/user/edit/' . $user->id)  }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							@endif
						</td>
						<td class="text-center align-middle">
							@if (($user->roles->first()->name == 'Admin') || ($user->roles->first()->name == 'Admin' && ($user['id'] != Auth::user()->id)))
								<form action="" method="POST">
									@csrf
									<button class="btn btn-danger" disabled="disabled"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</form>
							@else
								<form action="{{ url('admin/user/delete/' . $user->id) }}" method="POST">
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
				let userId = $(this).data('id');
				console.log(is_active, userId);
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('admin.user.active.update') }}',
					data: {'is_active': is_active, 'user_id': userId},
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
