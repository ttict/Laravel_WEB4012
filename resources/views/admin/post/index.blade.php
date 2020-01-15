@extends('admin.layout.master')
@section('title', 'Danh sách bài viết')
@section('contents')
<div class="wrapper">
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Danh sách bài viết
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Post List</li>
			</ol>
		</section>
		<section class="content container-fluid">
			@if(empty($posts))
			<p>No Data</p>
			@else
			<table class="table table-bordered table-striped table-hover table-responsive">
				<thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Tiêu đề</th>
						<th>Nội dung</th>
						<th>Người đăng</th>
						<th>Danh mục</th>
						<th>Ngày tạo</th>
						<th><a href="{{ route('admin.post.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a></th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0 ?>
					@foreach($posts as $post)
					<?php $stt = $stt + 1 ?>
                        <tr>
							<td>{{ $stt }}</td>
							<td>{{ $post['title'] }}</td>
                            <td>{{ $post['content'] }}</td>
                            <td><a href="{{ url('admin/user/' . $post['user']['id']) }}">{{ $post['user']['name'] }}</a></td>
                        	<td><a href="{{ url('admin/category/' . $post->categories->first()->id) }}">{{ $post->categories->first()->name }}</a></td>
                        	<td>{{ $post['created_at'] }}</td>
                        	<td><a href="{{ url('admin/post/edit/' . $post->id)  }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        	<td>
                        		<form action="{{ url('admin/post/delete/' . $post->id) }}" method="post">
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
