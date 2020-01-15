<nav class="panel-menu" id="mobile-menu">
	<ul>

	</ul>
	<div class="mm-navbtn-names">
		<div class="mm-closebtn">
			Close
			<div class="tt-icon">	</div>
		</div>
		<div class="mm-backbtn">Back</div>
	</div>
</nav>
<header id="tt-header">
	<div class="container">
		<div class="row tt-row no-gutters">
			<div class="col-auto">
				<a class="toggle-mobile-menu" href="#">		</a>
				<div class="tt-logo">
					<a href="{{ url('index') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a>
				</div>
				<div class="tt-desktop-menu">
					<nav>
						<ul>
							<li><a href="{{ url('categories') }}"><span>Danh mục</span></a></li>
						</ul>
					</nav>
				</div>
				<div class="tt-search">
					<form class="search-wrapper" action="{{ route('search') }}" method="GET">
						@csrf
						<div class="search-form">
							<input type="text" class="tt-search__input" placeholder="Tìm kiếm" name="keyword" value="">
						</div>
						<button class="btn" type="submit">Tìm kiếm</button>
					</form>
				</div>
			</div>
			<div class="col-auto ml-auto">
				<div class="tt-account-btn">
					@if (Auth::check())
						<img src="{{ asset('storage/upload/images/' . Auth::user()->avatar) }}" alt="">&nbsp;
						<p style="line-height: 40px"><a href="{{ url('myaccount') }}">{{ Auth::user()->name }}</a>!&nbsp;&nbsp;&nbsp;</p>
						<a class="log-out" href="{!! url('logout') !!}" style="line-height: 40px">Logout</a>
						
					@else
						<a href="{{ url('login') }}" class="btn btn-primary">Đăng nhập</a>
						<a href="{{ url('register') }}" class="btn btn-secondary">Đăng ký</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</header>
