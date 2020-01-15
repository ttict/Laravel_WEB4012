@extends('user.master')
@section('title', 'Danh sách danh mục')
@section('content')
<main id="tt-pageContent" class="tt-offset-small">
    <div class="container">
        <div class="tt-tab-wrapper">
            <div class="tt-wrapper-inner">
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="tt-tab-06" role="tabpanel">
                <h3>Danh sách danh mục</h3>
                    <div class="tt-wrapper-inner">
                        <div class="tt-categories-list">
                            <div class="row">
                                @if(!empty($categories))
                                    @foreach($categories as $category)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="tt-item">
                                                <div class="tt-item-header">
                                                    <ul class="tt-list-badge">
                                                        <li><a href="{{ url('category/'. $category->id) }}"><span class="tt-color01 tt-badge">{{ $category->name }}</span></a></li>
                                                    </ul>
                                                    <h6 class="tt-title"><a href="#">{{ $category->posts->count() }} Bài viết</a></h6>
                                                </div>
                                                <div class="tt-item-layout">
                                                    <div class="innerwrapper">
                                                        {{ $category->description == "" ? '' : $category->description}}
                                                    </div>
                                                    <div class="innerwrapper">
                                                        <h6 class="tt-title">Người tạo</h6>
                                                        <ul class="tt-list-badge">
                                                            <li><a href="{{ url('user/' . $category->user->id) }}"><span class="tt-badge">{{ $category->user->name }}</span></a></li>
                                                        </ul>
                                                    </div>
                                                    <a href="#" class="tt-btn-icon">
                                                        <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
@endsection
