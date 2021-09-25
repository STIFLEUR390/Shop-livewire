<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation de commande</title>
</head>
<body>
    <p>Salut {{ $order->firstname }} {{ $order->lastname }}</p>
    <p>Votre commande a été passée avec succès.</p>
    <br/>

    <table style="width: 600px; text-align:right;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td><img src="{{ asset('assets/images/products') }}/{{ $item->product->image }}" width="100" /></td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top: 1px solid #ccc;"></td>
                <td style="font-size: 15px;font-weight: bold;border-top: 1px solid #ccc;">Sous-total: {{ priceFormat($order->subtotal) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight: bold;">Tax: {{ priceFormat($order->tax) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight: bold;">Livraison : Livraison gratuite</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size: 15px;font-weight: bold;">Total: {{ priceFormat($order->total) }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
