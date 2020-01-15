@extends('admin.layout.master')
@section('title', 'Thông tin thành viên')
@section('contents')
{{--    @php(dd((Auth::user()->roles->first()->name)))--}}
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                User Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User Profile</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/upload/images/' . $user->avatar) }}" alt="User profile picture">
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Bài viết</b> <a class="pull-right">{{ count($user->post) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Danh mục</b> <a class="pull-right">{{ count($user->category)  }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Bình luận</b> <a class="pull-right">{{ count($user->comment)  }}</a>
                                </li>
                            </ul>
                            <a href="{{ url('admin/user/edit/' . $user->id)  }}" class="btn btn-primary btn-block"><b>Chỉnh sửa thông tin</b></a>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Giới thiệu về tôi</h3>
                        </div>
                        <div class="box-body">
                            <strong><i class="fa fa-birthday-cake" aria-hidden="true"></i> Ngày sinh</strong>
                            <p class="text-muted">{{ $user->birthday }}</p>
                            <hr>
                            <strong><i class="fa fa-mobile" aria-hidden="true"></i> Số điện thoại</strong>
                            <p class="text-muted">{{ $user->phoneNumber }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#posts" data-toggle="tab">Bài viết</a></li>
                            <li><a href="#categories" data-toggle="tab">Danh mục</a></li>
                            <li><a href="#comment" data-toggle="tab">Bình luận</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="posts">
                                @foreach($user->post as $post)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="" alt="">
                                            <span class="username">
                                            <a href="#">{{ $post->title }}</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                            <span class="description">Tạo lúc - {{ $post->created_at }}</span>
                                        </div>
                                        <p>
                                            {{ $post->content }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane" id="categories">
                                @foreach($user->category as $category)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="" alt="">
                                            <span class="username">
                                            <a href="#">{{ $category->name }}</a>
                                            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                        </span>
                                            <span class="description">Tạo lúc - {{ $category->created_at }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane" id="comment">
                                @foreach($user->comment as $comment)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="" alt="">
                                            <span class="username">
                                                <a href="#">{{ $comment->content }}</a>
                                            </span>
                                            <span class="description">Tạo lúc - {{ $comment->created_at }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
