{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<x-base-layout>
    <main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">Accueil</a></li>
					<li class="item-link"><span>Inscription</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
					<div class=" main-content-area">
						<div class="wrap-login-item ">
							<div class="register-form form-item ">
								<x-jet-validation-errors class="mb-4" />
								<form class="form-stl" action="{{ route('register') }}" name="frm-login" method="post" >
									@csrf
									<fieldset class="wrap-title">
										<h3 class="form-title">CRÉER UN COMPTE</h3>
										<h4 class="form-subtitle">Information personnel</h4>
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-lname">Nom</label>
										<input type="text" id="frm-reg-lname" name="name" placeholder="Nom" :value="old('name')" required autofocus autocomplete="name">
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-reg-email">Address Email</label>
										<input type="email" id="frm-reg-email" name="email" placeholder="Address Email" :value="old('email')" required>
									</fieldset>
									{{-- <fieldset class="wrap-functions ">
										<label class="remember-field">
											<input name="newletter" id="new-letter" value="forever" type="checkbox"><span>Sign Up for Newsletter</span>
										</label>
									</fieldset> --}}
									<fieldset class="wrap-title">
										<h3 class="form-title">Information de connection</h3>
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="frm-reg-pass">Mot de passe</label>
										<input type="password" id="frm-reg-pass" name="password" placeholder="Mot de passe" required autocomplete="new-password" >
									</fieldset>
									<fieldset class="wrap-input item-width-in-half ">
										<label for="frm-reg-cfpass">Confirmer le mot de passe</label>
										<input id="frm-reg-cfpass" placeholder="Confirmer le mot de passe" type="password" name="password_confirmation" required autocomplete="new-password" >
									</fieldset>
									<input type="submit" class="btn btn-sign" value="S'enregistrer" name="register">
								</form>
							</div>
						</div>
					</div><!--end main products area-->
				</div>
			</div><!--end row-->
		</div><!--end container-->
	</main>
</x-base-layout>
