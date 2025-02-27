<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/date-timepicker/css/bootstrap-datetimepicker.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" integrity="sha512-UwbBNAFoECXUPeDhlKR3zzWU3j8ddKIQQsDOsKhXQGdiB5i3IHEXr9kXx82+gaHigbNKbTDp3VY/G6gZqva6ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/nouislider/css/nouislider.min.css') }}">
    @livewireStyles
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="javascript:void(0);">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				<div class="topbar-menu-area">
					<div class="container">
						<div class="topbar-menu left-menu">
							<ul>
								<li class="menu-item" >
									<a title="Hotline: (+123) 456 789" href="javascript:void(0);" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
								</li>
							</ul>
						</div>
						<div class="topbar-menu right-menu">
							<ul>
								<li class="menu-item lang-menu menu-item-has-children parent">
									<a title="{{ Config::get('languages')[App::getLocale()]['display'] }}" href="javascript:void(0);"><span class="img label-before"><span class="flag-icon flag-icon-{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}"></span></span>{{ Config::get('languages')[App::getLocale()]['display'] }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="submenu lang" >
                                        @foreach (Config::get('languages') as $lang => $language)
                                            @if ($lang != App::getLocale())
                                                <li class="menu-item" ><a title="hungary" href="{{ route('lang.switch', $lang) }}"><span class="img label-before"><span class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></span></span>{{ $language['display'] }}</a></li>
                                            @endif
                                        @endforeach
									</ul>
								</li>
								<li class="menu-item menu-item-has-children parent" >
									<a title="{{ Config::get('app.devise.devise') }}" href="javascript:void(0);">{{ Config::get('app.devise.devise') }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="submenu curency" >
                                        @foreach (Config::get('devises') as $name => $devise)
                                            @if ($devise['devise'] != Config::get('app.devise.devise'))
                                                <li class="menu-item" >
                                                    <a title="{{ $devise['devise'] }}" href="{{ route('devise.switch', $name) }}">{{ $devise['devise'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
										{{-- <li class="menu-item" >
											<a title="Pound (GBP)" href="javascript:void(0);">Pound (GBP)</a>
										</li>
										<li class="menu-item" >
											<a title="Euro (EUR)" href="javascript:void(0);">Euro (EUR)</a>
										</li>
										<li class="menu-item" >
											<a title="Dollar (USD)" href="javascript:void(0);">Dollar (USD)</a>
										</li> --}}
									</ul>
								</li>
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth::user()->utype === 'ADM' )
                                            <li class="menu-item menu-item-has-children parent" >
                                                <a title="My Account" href="javascript:void(0);">Mon compte ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency" >
                                                    <li class="menu-item" >
                                                        <a title="Dashboard" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Categories" href="{{ route('admin.categories') }}">Categories</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Attributes" href="{{ route('admin.attributes') }}">Attributs</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Products" href="{{ route('admin.products') }}">Tout les Produits</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Manage Home Slider" href="{{ route('admin.homeslider') }}">Gérer les sliders</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Manage Home Catgories" href="{{ route('admin.homecategories') }}">Gérer les catégories d'accueil</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Sale Setting" href="{{ route('admin.sale') }}">Paramètre de vente</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="All Coupon" href="{{ route('admin.coupons') }}">Tous les coupons</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="All orders" href="{{ route('admin.orders') }}">All orders</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="contact messages" href="{{ route('admin.contact') }}">Messages de contact</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Settings" href="{{ route('admin.settings') }}">Parametres</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                    </form>
                                                    <li class="menu-item" >
                                                        <a onclick="event.preventDefault(); getElementById('logout-form').submit();" href="{{ route('logout') }}">Deconnexion</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @else
                                            <li class="menu-item menu-item-has-children parent" >
                                                <a title="My Account" href="javascript:void(0);">Mon compte ({{ Auth::user()->name }})<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency" >
                                                    <li class="menu-item" >
                                                        <a title="Dashboard" href="{{ route('user.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="My orders" href="{{ route('user.orders') }}">My orders</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="My Profile" href="{{ route('user.profile') }}">Mon Profile</a>
                                                    </li>
                                                    <li class="menu-item" >
                                                        <a title="Change password" href="{{ route('user.changepassword') }}">Changer mot de passe</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                    </form>
                                                    <li class="menu-item" >
                                                        <a onclick="event.preventDefault(); getElementById('logout-form').submit();" href="{{ route('logout') }}">Deconnexion</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    @else
                                        <li class="menu-item" ><a title="Register or Login" href="{{ route('login') }}">Login</a></li>
								        <li class="menu-item" ><a title="Register or Login" href="{{ route('register') }}">Register</a></li>
                                    @endauth
                                @endif
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="/" class="link-to-home"><img src="{{ asset('assets/images/logo-top-1.png') }}" alt="mercado"></a>
						</div>

						@livewire('header-search-component')

						<div class="wrap-icon right-section">
							@livewire('wishlist-count-component')

							@livewire('cart-count-component')

							<div class="wrap-icon-section show-up-after-1024">
								<a href="javascript:void(0);" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<div class="nav-section header-sticky">
					<div class="header-nav-section">
						<div class="container">
							<ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
								<li class="menu-item"><a href="javascript:void(0);" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="javascript:void(0);" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="javascript:void(0);" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="javascript:void(0);" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="javascript:void(0);" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
							</ul>
						</div>
					</div>

					<div class="primary-nav-section">
						<div class="container">
							<ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
								<li class="menu-item home-icon">
									<a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
								</li>
								<li class="menu-item">
									<a href="javascript:void(0);" class="link-term mercado-item-title">About Us</a>
								</li>
								<li class="menu-item">
									<a href="/shop" class="link-term mercado-item-title">Shop</a>
								</li>
								<li class="menu-item">
									<a href="{{ route('product.cart') }}" class="link-term mercado-item-title">Cart</a>
								</li>
								<li class="menu-item">
									<a href="{{ route('checkout') }}" class="link-term mercado-item-title">Checkout</a>
								</li>
								<li class="menu-item">
									<a href="{{ route('contact') }}" class="link-term mercado-item-title">Contact Us</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	{{ $slot }}

	@livewire('footer-component')

    @include('sweetalert::alert')
    <script>
        window.addEventListener('swal',function(e){
              Swal.fire(e.detail);
          });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
	<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('js/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('js/date-timepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/nouislider/js/nouislider.min.js') }}"></script>

	<script src="{{ asset('js/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
	<script src="{{ asset('js/tinymce/js/tinymce/tinymce.min.js') }}"></script>    @livewireScripts
    {{-- <script src="{{ asset('js/sweetalert2@10.js') }}"></script> --}}
    <x-livewire-alert::scripts />
    @stack('scripts')
</body>
</html>
