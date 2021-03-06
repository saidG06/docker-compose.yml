@section('title', 'S\'inscrire - Flouka')
@section('header_title', 'S\'inscrire - Flouka')

{{-- Start Main --}}
<main class="main-content">

	<!-- Start Cart -->
	<section class="cart">
		<header class="header-cart">
			<div class="overlay"></div>
			<div class="container">
				<h1 class="wow bounceInDown">S'inscrire</h1>
			</div>
		</header>

		<section class="container">
            <section class="cart-content">
				<header class="card-header card-header-lg">
					S'inscrire
				</header>
				<div class="card-block">
                    {{-- Start Alert --}}
                    @include('layouts.frontend.partials.alerts')
                    {{-- End Alert --}}
                    <form class="form" wire:submit.prevent='submit'>
                        <div class="row">
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="text" class="form-control" id="name" placeholder="Nom et Prénom" wire:model.defer="form.name">
                                    <i class="fa fa-user-circle"></i>
                                </div>
                                @error('form.name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="email" class="form-control" id="email" placeholder="E-Mail" wire:model.defer="form.email">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                @error('form.email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="tel" class="form-control flex-grow-1" id="phone" placeholder="Téléphone" wire:model.defer="form.tel">
                                    <i class="fa fa-phone-alt"></i>
                                </div>
                                @error('form.tel')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="password" class="form-control" id="password" placeholder="Mot de Passe" wire:model="form.password">
                                    <i class="fa fa-key"></i>
                                </div> 
                                @error('form.password')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4">
                                <div class="form-control-wrapper form-control-icon-right">
                                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirmez Mot de Passe" wire:model="form.password_confirm">
                                    <i class="fa fa-key"></i>
                                </div>
                                @error('form.password_confirm')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-4 offset-md-4 checkbox">
                                <div class="form-control-wrapper">
                                    <input type="checkbox" class="form-control" id="agree" value="1" wire:model="form.agree">
                                    <label for="agree" class="reset">I agree <a href="terms.php" target="_blank">Terms of Use</a> &amp; <a href="privacy.php" target="_blank">Privacy Policy</a></label>
                                </div>
                                @error('form.agree')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 offset-md-4 text-center">
                                <div class="form-control-wrapper">
                                    <button type="submit" class="btn btn-primary btn-rounded btn-inline">S'inscrire</button>
                                    <button type="reset" class="btn btn-secondary btn-rounded btn-inline">Réinitialiser</button>
                                </div>
                            </div>
                        </div>
                    <form>
				</div>
			</section>
		</section>
	</section>
	<!-- End Cart -->
</main>
<!-- End Main -->