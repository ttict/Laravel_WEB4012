@extends('user.master')
@section('title', 'Thêm bài viết mới')
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
                    <ul><a href="{{ url('myaccount/post/create') }}"> Tạo bài viết</a></ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @include('user.blocks.error')
        <form action="{{ url('myaccount/post/update/' . $post->id) }}" method="POST" enctype="multipart/form-data">
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
    </div>
</main>
<script src="{{ asset('user/js/bundle.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'txtContent' );
</script>
@endsection