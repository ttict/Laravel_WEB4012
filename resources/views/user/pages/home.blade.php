@extends('user.master')
<link rel="stylesheet" href="{{ asset('user/css/home.css') }}">
@section('content')
    <main id="tt-pageContent" class="tt-offset-small">
        <div class="container">
            <div class="tt-topic-list">
                <div class="tt-list-header">
                    <div class="tt-col-topic align">Bài viết</div>
                    <div class="tt-col-category">Danh mục</div>
                    <div class="tt-col-value hide-mobile">Bình luận</div>
                </div>
                @foreach ($posts as $post)
                    {{--@php(dd($post->categories->first()->name))--}}
                    <div class="tt-item tt-itemselect">
                        <div class="tt-col-avatar">
                            <img src="{{ asset('storage/upload/images/' . $post->avatar) }}" alt="">
                        </div>
                        <div class="tt-col-description">
                            <h6 class="tt-title"><a href="{{ url('post/' . $post->id) }}">
                                    {{ $post->title }}
                                </a></h6>
                            <div class="row align-items-center no-gutters">
                                <div class="col-11">
                                    <ul class="tt-list-badge">
                                        <li><a href="{{ url('user/' . $post->user->id) }}"><span class="tt-badge">{{ $post->user->name }}</span></a></li>
                                    </ul>
                                </div>
                                <div class="col-1 ml-auto show-mobile">
                                    <div class="tt-value">1h</div>
                                </div>
                            </div>
                        </div>
                        <div class="tt-col-category"><span class=""><a href="{{ url('category/' . $post->categories->first()['id']) }}">{{ $post->categories->first()['name'] }}</a></span></div>
                        <div class="tt-col-value tt-color-select hide-mobile">{{ count($post->comments) }}</div>
                    </div>
                @endforeach
                <div class="text-center">{{ $posts->links() }}</div>
                
            </div>
        </div>
    </main>
@endsection
