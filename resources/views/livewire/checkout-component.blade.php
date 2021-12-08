<main id="main" class="main-site">
<style>
    .summary-item .row-in-form input[type=password] {
        font-size: 13px;
        line-height: 19px;
        display: inline-block;
        height: 43px;
        padding: 2px 20px;
        max-width: 300px;
        width: 100%;
        border: 1px solid #e6e6e6;
    }


    .spinner {
        font-size: 22px;
        margin-bottom: 20px;
        padding-left: 37px;
        color: green;
        display: none;
    }
</style>
    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Accueil</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form wire:submit.prevent='placeOrder' onsubmit="$('#processing').show();" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Adresse de facturation</h3>
                            <div class="billing-address">
                                <p class="row-in-form">
                                    <label for="fname">Prénom<span>*</span></label>
                                    <input type="text" name="fname" value="" placeholder="Votre Prénom" wire:model='firstname'>
                                    @error('firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">Nom<span>*</span></label>
                                    <input type="text" name="lname" value="" placeholder="Votre Nom" wire:model='lastname'>
                                    @error('lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Adresse e-mail:</label>
                                    <input type="email" name="email" value="" placeholder="Entrer votre mail" wire:model='email'>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Numéro de téléphone<span>*</span></label>
                                    <input type="number" name="phone" value="" placeholder="Numéro" wire:model='mobile'>
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Line1:</label>
                                    <input type="text" name="add" value="" placeholder="Street at apartment number" wire:model='line1'>
                                    @error('line1') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Line2:</label>
                                    <input type="text" name="add" value="" placeholder="Street at apartment number" wire:model='line2'>
                                    {{-- @error('line2') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Pays<span>*</span></label>
                                    <input type="text" name="country" value="" placeholder="Cameroun" wire:model='country'>
                                    @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Code postal / ZIP:</label>
                                    <input type="number" name="zip-code" value="" placeholder="Your postal code" wire:model='zipcode'>
                                    @error('zipcode') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Province<span>*</span></label>
                                    <input type="text" name="province" value="" placeholder="City name" wire:model='province'>
                                    @error('province') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Ville<span>*</span></label>
                                    <input type="text" name="city" value="" placeholder="Nom de votre ville" wire:model='city'>
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </p>
                                <p class="row-in-form fill-wife">
                                    <label class="checkbox-field">
                                        <input name="different-add" id="different-add" value="1" type="checkbox" wire:model='ship_to_different'>
                                        <span>Livrer à une adresse différente?</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($ship_to_different)
                        <div class="col-md-12">
                            <div class="wrap-address-billing">
                                <h3 class="box-title">Adresse de livraison</h3>
                                <div class="billing-address">
                                    <p class="row-in-form">
                                        <label for="fname">Prénom<span>*</span></label>
                                        <input type="text" name="fname" value="" placeholder="Votre Prénom" wire:model='s_firstname'>
                                        @error('s_firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="lname">Nom<span>*</span></label>
                                        <input type="text" name="lname" value="" placeholder="Votre Nom" wire:model='s_lastname'>
                                        @error('s_lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="email">Adresse e-mail:</label>
                                        <input type="email" name="email" value="" placeholder="Entrer votre mail" wire:model='s_email'>
                                        @error('s_email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="phone">Numéro de téléphone<span>*</span></label>
                                        <input type="number" name="phone" value="" placeholder="Numéro" wire:model='s_mobile'>
                                        @error('s_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line1:</label>
                                        <input type="text" name="add" value="" placeholder="Street at apartment number" wire:model='s_line1'>
                                        @error('s_line1') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="add">Line2:</label>
                                        <input type="text" name="add" value="" placeholder="Street at apartment number" wire:model='s_line2'>
                                        {{-- @error('s_line2') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </p>
                                    <p class="row-in-form">
                                        <label for="country">Pays<span>*</span></label>
                                        <input type="text" name="country" value="" placeholder="Cameroun" wire:model='s_country'>
                                        @error('s_country') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="zip-code">Code postal / ZIP:</label>
                                        <input type="number" name="zip-code" value="" placeholder="Your postal code" wire:model='s_zipcode'>
                                        @error('s_zipcode') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="city">Province<span>*</span></label>
                                        <input type="text" name="province" value="" placeholder="City name" wire:model='s_province'>
                                        @error('s_province') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="city">Ville<span>*</span></label>
                                        <input type="text" name="city" value="" placeholder="Nom de votre ville" wire:model='s_city'>
                                        @error('s_city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Mode de paiement</h4>
                        @if ($paymentmode == 'card')
                        <div class="wrap-address-billing">
                            <p class="row-in-form">
                                <label for="card-no">Card Number</label>
                                <input type="text" name="card-no" value="" placeholder="Cad Number" wire:model='card_no'>
                                @error('card_no') <span class="text-danger">{{ $message }}</span> @enderror
                            </p>

                            <p class="row-in-form">
                                <label for="exp-month">Expiry Month</label>
                                <input type="text" name="exp-month" value="" placeholder="MM" wire:model='exp_month'>
                                @error('exp_month') <span class="text-danger">{{ $message }}</span> @enderror
                            </p>

                            <p class="row-in-form">
                                <label for="exp-year">Expiry year</label>
                                <input type="text" name="exp-year" value="" placeholder="YYYY" wire:model='exp_year'>
                                @error('exp_year') <span class="text-danger">{{ $message }}</span> @enderror
                            </p>

                            <p class="row-in-form">
                                <label for="cvc">CVC</label>
                                <input type="password" name="cvc" value="" placeholder="CVC" wire:model='cvc'>
                                @error('cvc') <span class="text-danger">{{ $message }}</span> @enderror
                            </p>
                        </div>
                        @endif
                        {{-- <p class="summary-info"><span class="title">Chèque / Mandat</span></p>
                        <p class="summary-info"><span class="title">Carte de crédit (enregistrée)</span></p> --}}
                        <div class="choose-payment-methods">
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-bank" value="cod" type="radio" wire:model="paymentmode">
                                <span>Paiement à la livraison</span>
                                <span class="payment-desc">Commande avec paiement à la livraison</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-visa" value="card" type="radio" wire:model="paymentmode">
                                <span>Carte de débit/crédit</span>
                                <span class="payment-desc">Il existe de nombreuses variantes de passages de Lorem Ipsum disponibles</span>
                            </label>
                            <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio" wire:model="paymentmode">
                                <span>Paypal</span>
                                <span class="payment-desc">Vous pouvez payer avec votre crédit</span>
                                <span class="payment-desc">carte si vous n'avez pas de compte paypal</span>
                            </label>
                            @error('paymentmode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @if (Session::has('checkout'))
                            <p class="summary-info grand-total"><span>Total</span> <span class="grand-total-price">{{ priceFormat(Session::get('checkout')['total']) }}</span></p>
                        @endif

                        @if ($errors->isEmpty())
                            <div wire:ignore id="processing" class="spinner">
                                <i class="fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>
                                <span>Processing...</span>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-medium">Faites votre commande maintenant</button>
                    </div>
                    <div class="summary-item shipping-method">
                        <h4 class="title-box f-title">Mode de livraison</h4>
                        <p class="summary-info"><span class="title">Forfait</span></p>
                        <p class="summary-info"><span class="title">Fixé $0</span></p>
                    </div>
                </div>
            </form>
        </div><!--end main content area-->
    </div><!--end container-->

</main>
