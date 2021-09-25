<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Changer mot de passe
                    </div>
                    <div class="panel-body">
                        <form wire:submit.prevent='changePassword' class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Mot de passe actuel</label>
                                <div class="col-md-4">
                                    <input type="password" placeholder="Mot de passe actuel" class="form-control input-md" name="current_password" wire:model='current_password' />
                                    @error('current_password') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nouveau mot de passe</label>
                                <div class="col-md-4">
                                    <input type="password" placeholder="Nouveau mot de passe" class="form-control input-md" name="password" wire:model='password' />
                                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirmer le mot de passe</label>
                                <div class="col-md-4">
                                    <input type="password" placeholder="Confirmer le mot de passe" class="form-control input-md" name="password_confirmation" wire:model='password_confirmation' />
                                    @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Changer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
