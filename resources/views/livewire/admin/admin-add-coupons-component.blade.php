<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Ajouter un nouveau coupon
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.coupons') }}" class="btn btn-success pull-right">Toute les Coupons</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form class="form-horizontal"  wire:submit.prevent='storeCoupon'>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Code Coupon</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Code Coupon" class="form-control input-md" wire:model="code" />
                                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Type Coupon</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model='type'>
                                        <option value="">selectionner un type</option>
                                        <option value="fixed">Fixe</option>
                                        <option value="percent">Pourcentage</option>
                                    </select>
                                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Valeur Coupon</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Valeur Coupon" class="form-control input-md" wire:model="value" />
                                    @error('value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Valeur Panier</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Valeur Panier" class="form-control input-md" wire:model="cart_value" />
                                    @error('cart_value') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Date d'expiration</label>
                                <div class="col-md-4" wire:ignore>
                                    <input type="text" id="expiry-date" placeholder="Date d'expiration" class="form-control input-md" wire:model="expiry_date" />
                                    @error('expiry_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $("#expiry-date").datetimepicker({
                format: 'Y-MM-DD'
            })
            .on("dp.change", function(ev) {
                var data = $('#expiry-date').val();
                @this.set('expiry_date', data);
            });
        });
    </script>
@endpush
