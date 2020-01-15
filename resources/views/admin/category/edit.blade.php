@extends('admin.layout.master')
@section('title', 'Cập nhật danh mục')
@section('contents')
<div class="content-wrapper">
        <section class="content-header">
            <h1>
               Cập nhật danh mục
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Edit Category</li>
            </ol>
        </section>
        <section class="content container-fluid">
            @include('admin.blocks.error')
            <form action="{{ url('admin/category/update/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="" for="txtCateName">Tên danh mục</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập đầy đủ Họ và Tên" name="txtCateName" id="txtCateName" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>      
            </form>
        </section>
    </div>
@endsection