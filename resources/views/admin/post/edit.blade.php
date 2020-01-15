@extends('admin.layout.master')
@section('title', 'Cập nhật bài viết')
@section('contents')

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Cập nhật bài viết
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Create Post</li>
            </ol>
        </section>
        <section class="content container-fluid">
            @include('admin.blocks.error')
            <form action="{{ url('admin/post/update/' . $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <img src="{{ asset('storage/upload/images/' . $post->avatar) }}" alt="" width="80" height="80" class="img_current">
                    <input type="hidden" name="img_current" value="{{ $post->avatar }}">
                </div>
                <div class="form-group">
                    <label class="" for="avatar">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="avatar">
                </div>
                <div class="form-group">
                    <label class="" for="txtTitle">Tiêu đề</label>
                    <input class="form-control" type="text" placeholder="Hãy nhập tiêu đề bài viết" name="txtTitle" id="txtTitle" value="{{ $post['title'] }}">
                </div>
                <div class="form-group">
                    <label class="" for="txtContent">Nội dung</label>
                    <textarea class="form-control" rows="5" placeholder="Hãy nhập nội dung bài viết" name="txtContent" id="txtContent" value="">{{ $post['content'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sltCategory">Danh mục</label>
                    <select class="form-control" name="sltCategory" id="sltCategory">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}" {{ $post->categories()->first()->id == $category['id']  ? 'selected' : ''}}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </section>
    </div>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'txtContent' );
</script>
@endsection
