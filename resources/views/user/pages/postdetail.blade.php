@extends('user.master')
@section('content')
    <main id="tt-pageContent">
    <div class="container">
        <div class="tt-single-topic-list">
            <div class="tt-item">
                <div class="tt-single-topic">
                    <div class="tt-item-header">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <img src="{{ asset('storage/upload/images/'. $post->avatar) }}" alt="">
                            </div>
                            <div class="tt-avatar-title">
                                <a href="{{ url('user/' . $post->user->id) }}">{{ $post->user->name }}</a>
                            </div>
                            <a href="#" class="tt-info-time">
                                {{ $post->user->created_at }}
                            </a>
                        </div>
                        <h3 class="tt-item-title">
                            <a href="{{ url('post/' . $post->id) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="tt-item-tag">
                            <ul class="tt-list-badge">
                                <li><a href="{{ url('category/' . $post->categories->first()['id']) }}"><span class="tt-color03 tt-badge">{{ $post->categories->first()['name'] }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tt-item-description">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
            @if(count($post->comments) != 0)
                @foreach($post->comments as $comment)
                    @if($comment->is_active == 1 || ($comment->user->roles->first()->name == 'Admin'))
                    {{--@php(dd( $comment->user))--}}
                    <div class="tt-item">
                        <div class="tt-single-topic">
                            <div class="tt-item-header pt-noborder">
                                <div class="tt-item-info info-top">
                                    <div class="tt-avatar-icon">
                                        <img src="{{ asset('storage/upload/images/'. $comment->user->avatar ) }} " alt="">
                                    </div>
                                    <div class="tt-avatar-title">
                                        <a href="{{ url('user/' . $comment->user->id) }}">{{ $comment->user->name }}</a>
                                    </div>
                                    <a href="#" class="tt-info-time">
                                        {{ $comment->created_at }}
                                    </a>
                                </div>
                            </div>
                            <div class="tt-item-description">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
        @if(Auth::user())
            <div class="tt-wrapper-inner">
                <div class="pt-editor form-default">
                    <h6 class="pt-title">Bình luận</h6>
                    <div class="form-group">
                        <form action="{{ url('comment/' .$post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <textarea name="txtContent" class="form-control" rows="5" placeholder="Lets get started">{{ old('txtContent') }}</textarea>
                            <button class="btn btn-primary" type="submit">Gửi</button>
                        </form>

                    </div>
                </div>
            </div>
        @endif
    </div>
</main>
@endsection
