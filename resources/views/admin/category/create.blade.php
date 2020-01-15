@extends('admin.layout.master')
@section('title', 'Thêm danh mục mới')
@section('contents')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Thêm danh mục mới
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Create Category</li>
            </ol>
        </section>
        <section class="content container-fluid">
            @include('admin.blocks.error')
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="" for="txtCateName">Tên danh mục</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập tên danh mục" name="txtCateName" id="txtCateName" value="{{ old('txtCateName') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection