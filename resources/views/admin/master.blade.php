@extends('admin.layout.master')
@section('title', '')
@section('contents')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ \App\Models\User::count() }}</h3>
                        <p>Tổng số Người dùng</p>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="{{ url('admin/user/index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ \App\Models\Post::count() }}<sup style="font-size: 20px">    </sup></h3>

                        <p>Tổng số bài viết</p>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="{{ url('admin/post/index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ \App\Models\Category::count() }}</h3>

                        <p>Tổng số danh mục</p>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="{{ url('admin/category/index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ \App\Models\Comment::count() }}</h3>

                        <p>Tổng số bình luận</p>
                    </div>
                    <div class="icon">
                        <i class=""></i>
                    </div>
                    <a href="{{ url('admin/comment/index') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
