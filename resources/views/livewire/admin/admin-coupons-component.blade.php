<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Tous les coupons
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.addcoupon') }}" class="btn btn-success pull-right">Ajouter un coupon</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Code Coupon</th>
                                    <th>Type Coupon</th>
                                    <th>Coupon Value</th>
                                    <th>Cart Value</th>
                                    <th>Date d'expiration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type == 'fixed' ? 'Fixe' : 'Pourcentage' }}</td>
                                        @if ($coupon->type == 'fixed')
                                                <td>{{ priceFormat($coupon->value) }}</td>
                                        @else
                                            <td>{{ $coupon->value }} %</td>
                                        @endif
                                        <td>{{ priceFormat($coupon->cart_value) }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.editcoupon', $coupon->id) }}"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0)" wire:click.prevent="deleteCoupon({{ $coupon->id }})" style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $coupons->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
