<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Accueil</a></li>
                <li class="item-link"><span>Panier</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if (Cart::instance('cart')->count() > 0)
            <div class="wrap-iten-in-cart">
                @if (Session::has('sucess_message'))
                    <div class="alert alert-success">
                        <strong>Success</strong> {{ Session::get('sucess_message') }}
                    </div>
                @endif
                @if (Cart::instance('cart')->count() > 0)
                    <h3 class="box-title">Nom des produits</h3>
                    <ul class="products-cart">
                        @foreach (Cart::instance('cart')->content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ route('product.details', $item->model->slug) }}">{{ $item->model->name }}</a>
                                </div>

                                @foreach ($item->options as $key => $value)
                                    <div style="vertical-align: middle; width: 180px;">
                                        <p><b>{{ $key }}: {{ $value }}</b></p>
                                    </div>
                                @endforeach

                                <div class="price-field produtc-price"><p class="price">{{ priceFormat($item->model->regular_price) }}</p></div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{ $item->qty }}" data-max="120" pattern="[0-9]*" >
                                        <a class="btn btn-increase" href="javascript:void(0);" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')"></a>
                                        <a class="btn btn-reduce" href="javascript:void(0);" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')"></a>
                                    </div>
                                    <p class="text-center"><a href="javascript:void(0);" wire:click.prevent="switchToSaveForlater('{{ $item->rowId }}')">Garder pour plus tard</a></p>
                                </div>
                                <div class="price-field sub-total"><p class="price">{{ priceFormat($item->subtotal) }}</p></div>
                                <div class="delete">
                                    <a href="javascript:void(0);" wire:click.prevent="destroy('{{ $item->rowId }}')" class="btn btn-delete" title="">
                                        <span>supprimer le produit du panier</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Pas de produit dans le panier</p>
                @endif

            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Récapitulatif de la commande</h4>
                    <p class="summary-info"><span class="title">Sous-total</span><b class="index">{{ priceFormat(Cart::instance('cart')->subtotal()) }}</b></p>
                    @if (Session::has('coupon'))
                        <p class="summary-info"><span class="title">Remise ({{ Session::get('coupon')['code'] }}) <a href="javascript:void(0);" wire:click.prevent="removeCoupon"><i class="fa fa-times text-danger" aria-hidden="true"></i></a> </span><b class="index">- {{ priceFormat($discount) }}</b></p>
                        <p class="summary-info"><span class="title">Tax ({{ config('cart.tax') }} %)</span><b class="index">{{ priceFormat($taxAfterDiscount) }}</b></p>
                        <p class="summary-info"><span class="title">Sous-total avec remise</span><b class="index">{{ priceFormat($subtotalAfterDiscount) }}</b></p>
                        <p class="summary-info"><span class="title">Total</span><b class="index">{{ priceFormat($totalAfterDiscount) }}</b></p>
                    @else
                        <p class="summary-info"><span class="title">Tax</span><b class="index">{{ priceFormat(Cart::instance('cart')->tax()) }}</b></p>
                        <p class="summary-info"><span class="title">Expédition</span><b class="index">livraison gratuite</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{ priceFormat(Cart::instance('cart')->total()) }}</b></p>
                    @endif
                </div>


                <div class="checkout-info">
                    @if (!Session::has('coupon'))
                        <label class="checkbox-field">
                            <input class="frm-input" name="have-code" id="have-code" value="" type="checkbox" wire:model="haveCouponCode" ><span>J'ai un coupon de reduction</span>
                        </label>
                        @if ($haveCouponCode == 1)
                            <div class="summary-item">
                                <form wire:submit.prevent="applyCouponCode">
                                    <h4 class="title-box">Code Coupon</h4>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Code du coupon:</label>
                                        <input type="text" autocomplete="off" name="coupon-code" wire:model="couponCode">
                                    </p>
                                    <button class="btn btn-small" type="submit">Appliquer</button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <a class="btn btn-checkout" href="javascript:void(0);" wire:click.prevent="checkout">Check out</a>
                    <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" wire:click.prevent="destroyAll()" href="javascript:void(0);">Supprimer le panier</a>
                    <a class="btn btn-update" href="javascript:void(0);">Update Shopping Cart</a>
                </div>
            </div>
            @else
                <div class="text-center" style="padding: 30px 0;">
                    <h1>Your cart is empty!</h1>
                    <p>Ajoutez-y des éléments maintenant</p>
                    <a href="/shop" class="btn btn-success">Achetez maintenant</a>
                </div>
            @endif

            <div class="wrap-iten-in-cart">
                <h3 class="title-box" style="border-bottom: 1px solid; padding-bottom: 15px;">@if (Cart::instance('saveForLater')->count() == 1) Un produit enregistré pour plus tard @else {{Cart::instance('saveForLater')->count()}} produits enregistrés pour plus tard @endif</h3>
                @if (Cart::instance('saveForLater')->count() > 0)
                    <h3 class="box-title">Nom des produits</h3>
                    <ul class="products-cart">
                        @foreach (Cart::instance('saveForLater')->content() as $item)
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets/images/products') }}/{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ route('product.details', $item->model->slug) }}">{{ $item->model->name }}</a>
                                </div>
                                <div class="price-field produtc-price"><p class="price">{{ priceFormat($item->model->regular_price) }}</p></div>
                                <div class="quantity">
                                    <p class="text-center"><a href="javascript:void(0);" wire:click.prevent="moveToCart('{{ $item->rowId }}')">Passer au panier</a></p>
                                </div>
                                <div class="price-field sub-total"><p class="price">{{ priceFormat($item->subtotal) }}</p></div>
                                <div class="delete">
                                    <a href="javascript:void(0);" wire:click.prevent="deleteFromSaveForLater('{{ $item->rowId }}')" class="btn btn-delete" title="">
                                        <span>Supprimer de sauvegarder pour plus tard</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Pas de produit sauvegarder pour plus tard</p>
                @endif

            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Most Viewed Products</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_4.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_17.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_15.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_1.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_21.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_3.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_4.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label">new</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>

                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="javascript:void(0);" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                    <figure><img src="{{ asset('assets/images/products/digital_5.jpg') }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item bestseller-label">Bestseller</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="javascript:void(0);" class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0);" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                <div class="wrap-price"><span class="product-price">$250.00</span></div>
                            </div>
                        </div>
                    </div>
                </div><!--End wrap-products-->
            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>
