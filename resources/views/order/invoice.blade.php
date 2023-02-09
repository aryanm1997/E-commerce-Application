<!DOCTYPE html>
<html>
<style>
table, td, th {
  border: 1px solid black;
  height:3%;
}
table {
  border-collapse: collapse;
  width: 100%;
}
th {
  text-align: left;
}
</style>
<body>
    <hr><br>
    <table>
  <tr>
    <th>Order ID</th>
    <td>{{ $invoice->order_id }}</td>
  </tr>
  <tr>
    <th>Products</th>
    <td>{{$invoice->product_name}}</td>
  </tr>
  <tr>
    <th>Total</th>
    <td>{{$invoice->net_amount}}</td>
  </tr>
</table>

    </body>
</html>