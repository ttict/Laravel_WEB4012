@extends('user.master')
@section('title', 'Chi tiết tài khoản')
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
        <div class="tt-tab-wrapper">
            <div class="tt-wrapper-inner">
                <ul class="nav nav-tabs pt-tabs-default" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tt-tab-04" role="tab"><span>Thông tin</span></a>
                    </li>
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
                <div class="tab-pane tt-indent-none active" id="tt-tab-04" role="tabpanel">
                    @include('admin.blocks.error')
                    <form action="{{ url('myaccount/update/' . Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <img src="{{ asset('storage/upload/images/' . Auth::user()->avatar) }}" alt="" width="80" height="80" class="img_current ">
                            <input type="hidden" name="img_current" value="{{ Auth::user()->avatar }}">
                        </div>
                        <div class="form-group has-feedback">
                            <label class="" for="avatar">Ảnh đại diện</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtFName">Họ và tên</label>
                            <input class="form-control" type="text" placeholder="Hãy nhập đầy đủ Họ và Tên" name="txtFName" id="txtFName" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtBirthday">Ngày sinh</label>
                            <input class="form-control" type="date" placeholder="Hãy nhập ngày sinh" name="txtBirthday" id="txtBirthday" value="{{ Auth::user()->birthday }}">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtPhoneNumber">Số điện thoại</label>
                            <input class="form-control" type="text" placeholder="Hãy nhập số điện thoại" name="txtPhoneNumber" id="txtPhoneNumber" value="{{ Auth::user()->phoneNumber }}">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtEmail">Email</label>
                            <input class="form-control" type="text" placeholder="Hãy nhập địa chỉ email" name="txtEmail" id="txtEmail" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtPass">Mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Hãy nhập mật khẩu" name="txtPass" id="txtPass">
                        </div>
                        <div class="form-group">
                            <label class="" for="txtRePass">Nhập lại mật khẩu</label>
                            <input class="form-control" type="password" placeholder="Hãy nhập mật khẩu" name="txtRePass" id="txtRePass">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane tt-indent-none" id="tt-tab-01" role="tabpanel">
                   <div class="tt-topic-list">
                        <div class="tt-list-header">
                            <div class="tt-col-topic">Bài viết</div>
                            <div class="tt-col-category tt-col-value-large hide-mobile">Danh mục</div>
                            <div class="tt-col-value-large hide-mobile"></div>
                            <div class="tt-col-value-large hide-mobile">Ngày đăng</div>
                             <div class="tt-col-value-large hide-mobile"></div>

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
                                <div class="tt-col-value-large hide-mobile"><a href="{{ url('myaccount/post/edit/' .  $post->id) }}">Sửa</a></div>
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