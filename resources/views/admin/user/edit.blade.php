@extends('admin.layout.master')
@section('title', 'Chỉnh sửa thông tin người dùng')
@section('contents')
<div class="content-wrapper">
        <section class="content-header">
            <h1>
                Chính sửa thông tin người dùng
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Edit User</li>
            </ol>
        </section>
        <section class="content container-fluid">
            @include('admin.blocks.error')
            <form action="{{ url('admin/user/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <img src="{{ asset('storage/upload/images/' . $user->avatar) }}" alt="" width="80" height="80" class="img_current">
                    <input type="hidden" name="img_current" value="{{ $user->avatar }}">
                </div>
                <div class="form-group has-feedback">
                    <label class="" for="avatar">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="avatar">
                </div>
                <div class="form-group">
                    <label class="" for="txtFName">Họ và tên</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập đầy đủ Họ và Tên" name="txtFName" id="txtFName" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtBirthday">Ngày sinh</label>
                    <input class="form-control" type="date" placeholder="Hãy nhập ngày sinh" name="txtBirthday" id="txtBirthday" value="{{ $user->birthday }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtPhoneNumber">Số điện thoại</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập số điện thoại" name="txtPhoneNumber" id="txtPhoneNumber" value="{{ $user->phoneNumber }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtEmail">Email</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập địa chỉ email" name="txtEmail" id="txtEmail" value="{{ $user->email }}">
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
                    <select class="form-control" name="role" id="role">
                        @foreach ($roles as $role)
                            <option value=" {{ $role['id'] }}" {{ $user->roles()->first()->name == $role['name']  ? 'selected' : ''}}> {{ $role['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </section>
    </div>
@endsection
