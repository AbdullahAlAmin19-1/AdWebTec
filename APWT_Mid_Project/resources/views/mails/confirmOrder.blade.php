{{-- Customer Name: {{$c_name}}<br>
Product Name: {{$p_name}}<br>
Product Quantity: {{$p_quantity}}<br>
Delivery address: {{$c_address}}<br> --}}

<center>
    <h3>Hi! {{$c_name}}</h3>
<h4>Your product will be delivered with in 3-5 days!</h4>

<table border="2px" style="width: 90%; border-collapse: collapse;">
    <tr>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Product Quantity</th>
        <th>Delivery address</th>
    </tr>
    <tr>
        <th>{{$c_name}}</th>
        <th>{{$p_name}}</th>
        <th>{{$p_quantity}}</th>
        <th>{{$c_address}}</th>
    </tr>
</table>
</center>