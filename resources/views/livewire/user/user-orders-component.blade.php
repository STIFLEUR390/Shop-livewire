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
                        All Oders
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Sous-total</th>
                                    <th>Réduction</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Zipcode</th>
                                    <th>Statut</th>
                                    <th>Date de commande</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ priceFormat($order->subtotal) }}</td>
                                        <td>{{ priceFormat($order->discount) }}</td>
                                        <td>{{ priceFormat($order->tax) }}</td>
                                        <td>{{ priceFormat($order->total) }}</td>
                                        <td>{{ $order->firstname }}</td>
                                        <td>{{ $order->lastname }}</td>
                                        <td>{{ $order->mobile }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->zipcode }}</td>
                                        <td>
                                            @if ($order->status == 'ordered') commandé @endif
                                            @if ($order->status == 'delivered') livré @endif
                                            @if ($order->status == 'canceled') annulé @endif
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <a href="{{ route('user.orderdetails', $order->id) }}" class="btn btn-info btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
