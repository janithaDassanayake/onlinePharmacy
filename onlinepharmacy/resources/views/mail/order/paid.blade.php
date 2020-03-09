@component('mail::message')
# Invoice Paid

<h1>Thanks for the purchase</h1>

<h3>Here is your receipt</h3>

<table class="table">
    <thead>
        <tr>
            <th>Product names</th>
            <th>quantity </th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td scope="row">{{ $item->name }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->pivot->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Total : {{$order->grand_total}}</h2>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

