<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('storage/upload/images/' . Auth::user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>TT</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Main Navigation</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Người dùng</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/user/index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
                    <li><a href="{{ url('admin/user/create') }}"><i class="fa fa-circle-o"></i> Thêm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Bài viết</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/post/index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
                    <li><a href="{{ url('admin/post/create') }}"><i class="fa fa-circle-o"></i> Thêm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Danh mục</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/category/index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
                    <li><a href="{{ url('admin/category/create') }}"><i class="fa fa-circle-o"></i> Thêm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Bình luận</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/comment/index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
