@extends('admin.layout.master')
@section('title', 'Danh sách danh mục')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
@section('contents')
<div class="wrapper">
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Danh sách danh mục
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Category List</li>
			</ol>
		</section>
		<section class="content container-fluid">
			@if(empty($categories))
			<p>No Data</p>
			@else
			<table class="table table-bordered table-striped table-hover table-responsive">
				<thead class="thead-dark">
					<tr class="text-center">
						<th class="text-center align-middle">STT</th>
						<th class="text-center align-middle">Tên danh mục</th>
						<th class="text-center align-middle">Người tạo</th>
						<th class="text-center align-middle">Tổng số<br>bài viết</th>
						<th class="text-center align-middle">Ngày tạo</th>
						<th class="text-center align-middle"><a href="{{ route('admin.category.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a></th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0 ?>
					@foreach ($categories as $category)
					<?php $stt = $stt + 1 ?>
					<tr>
						<td class="text-center align-middle">{{ $stt }}</td>
						<td class="text-center align-middle">{{ $category['name'] }}</td>
						<td class="text-center align-middle">{{ $category['user']['name'] }}</td>
						<td class="text-center align-middle">{{ count($category['posts']) }}</td>
						<td class="text-center align-middle">{{ $category['created_at'] }}</td>
						<td class="text-center align-middle">
							<a href="{{ url('admin/category/edit/' . $category->id)  }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</td>
						<td class="text-center align-middle">
							<form action="{{ url('admin/category/delete/' . $category->id) }}" method="POST">
								@csrf
								<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
							</form>
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
	</script>
@endsection
