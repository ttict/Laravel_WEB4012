@extends('user.master')
@section('title', 'Chi tiết tài khoản')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="tt-wrapper-section">
        <div class="container">
            <div class="tt-user-header">
                <div class="tt-col-avatar">
                    <div class="tt-icon">
                    	<img src="{{ url('storage/upload/images/' . $user->avatar) }}" alt="">
                    </div>
                </div>
                <div class="tt-col-title">
                    <div class="tt-title">
                        <a href="#">{{ $user->name }}</a>
                    </div>
                    <ul class="tt-list-badge">
                        <li><a href="#"><span class="tt-color14 tt-badge">{{ $user->roles->first()->name }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="tt-tab-wrapper">
            <div class="tt-wrapper-inner">
                <ul class="nav nav-tabs pt-tabs-default" role="tablist">
                    <li class="nav-item show">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-01" role="tab"><span>Bài viết</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>Bình luận</span></a>
                    </li>
                    <li class="nav-item tt-hide-md">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>Danh mục</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane tt-indent-none active" id="tt-tab-01" role="tabpanel">
                   <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Bài viết</div>
                            <div class="tt-col-category tt-col-value-large hide-mobile">Danh mục</div>
                            <div class="tt-col-value-large hide-mobile"></div>
                            <div class="tt-col-value-large hide-mobile">Ngày đăng</div>
                        </div>
                        @foreach ($posts as $post)
	                        <div class="tt-item">
	                            <div class="tt-col-avatar">
	                                <img src="{{ url('storage/upload/images/' . $post->avatar) }}" alt="">
	                            </div>
	                            <div class="tt-col-description">
	                                <h6 class="tt-title"><a href="{{ url('post/' . $post->id) }}">
	                                  {{ $post->title }}
	                                </a></h6>
	                                <div class="tt-col-message">
	                                    <a href=""></a>
	                                </div>
	                            </div>
	                            <div class="tt-col-category tt-col-value-large hide-mobile">
	                            	<a href="{{ url('category/' . $post->categories->first()['id']) }}"><span class="tt-color05 tt-badge">{{ $post->categories->first()['name'] }}</span></a>
	                            </div>
	                            <div class="tt-col-value-large hide-mobile"></div>
	                            <div class="tt-col-value-large hide-mobile">{{ $post->created_at }}</div>
	                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-02" role="tabpanel">
                    <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Bài viết</div>
                            <div class="tt-col-category">Nội dung bình luận</div>
                            <div class="tt-col-value">Thời gian</div>
                        </div>
                        @foreach ($comments as $comment)
                        	<div class="tt-item">
                            <div class="tt-col-avatar">
                                <img src="{{ url('storage/upload/images/' . $comment->post->avatar) }}" alt="">
                            </div>
                            <div class="tt-col-description">
                               <h6 class="tt-title"><a href="{{ url('post/'.  $comment->post->id) }}">
                                    {{ $comment->post->title }}
                                </a></h6>
                            </div>
                            <div class="tt-col-category">{{ $comment->content }}</div>
                            <div class="tt-col-value hide-mobile">{{ $comment->created_at }}</div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-03" role="tabpanel">
                	<div class="tt-topic-list">
                		<div class="tt-list-header">
                			<div class="tt-col-topic">Tên danh mục</div>
                			<div class="tt-col-category">Tổng bài viết</div>
                			<div class="tt-col-value">Ngày tạo</div>
                		</div>
                		@foreach ($categories as $category)
                		<div class="tt-item">
                			<div class="tt-col-description">
                				<h6 class="tt-title"><a href="{{ url('category/' . $category->id) }}">
                					{{ $category->name }}
                				</a></h6>
                			</div>
                			<div class="tt-col-category"><a href="#"><span class="tt-color06 tt-badge">{{ $category->posts->count() }}</span></a></div>
                			<div class="tt-col-value-large hide-mobile">{{ $category->created_at }}</div>
                		</div>
                		@endforeach
                	</div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('user/js/bundle.js') }}"></script>
@endsection