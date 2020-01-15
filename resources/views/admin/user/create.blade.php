@extends('admin.layout.master')
@section('title', 'Thêm người dùng mới')
@section('contents')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Thêm người dùng mới
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Create User</li>
            </ol>
        </section>
        <section class="content container-fluid">
            @include('admin.blocks.error')
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <label class="" for="avatar">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="avatar">
                </div>
                <div class="form-group">
                    <label class="" for="txtFName">Họ và tên</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập đầy đủ Họ và Tên"name="txtFName" id="txtFName" value="{{ old('txtFName') }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtBirthday">Ngày sinh</label>
                    <input class="form-control" type="date" placeholder="Hãy nhập ngày sinh" name="txtBirthday" id="txtBirthday" value="{{ old('txtBirthday') }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtPhoneNumber">Số điện thoại</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập số điện thoại" name="txtPhoneNumber" id="txtPhoneNumber" value="{{ old('txtPhoneNumber') }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtEmail">Email</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập địa chỉ email" name="txtEmail" id="txtEmail" value="{{ old('txtEmail') }}">
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
                    <label for="role">Quyền</label>
                    <select class="form-control" name="role" id="role" value="{{ old('role') }}">
                        @if($roles->count() != 0)
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif
                    </select>
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
