<!DOCTYPE html>
<html>
<head>
<title>Font Awesome Icons</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #33001a;
}

.topnav a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  border-bottom: 3px solid transparent;
}

.topnav a:hover {
  border-bottom: 3px solid red;
}

.topnav a.active {
  border-bottom: 3px solid red;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<body>
<div class="topnav">
  <a class="active" href="{{ url('/')}}">Home</a>
</div>
<div style="padding-left:16px"><br>
<h2>Order Management</h2>
<table>
  <tr>
    <th>SL.NO</th>
    <th>Order ID</th>
    <th>Customer name</th>
    <th>Phone</th>
    <th>Net amount</th>
    <th>Order date</th>
    <th>Actions</th>
  </tr>
  @if($order->count() > 0)
  @foreach($order as $value)
  <tr>
    <td> {{ (($order->currentPage() - 1 ) * $order->perPage() ) + $loop->iteration }}</td>
    <td>{{ $value->order_id ? $value->order_id : '--' }}</td>
    <td>{{ $value->customer_name ? $value->customer_name : '--' }}</td>
    <td>{{ $value->phone ? $value->phone : '--' }}</td>
    <td>{{ $value->net_amount ? $value->net_amount : '--' }}</td>
    <td>{{ $value->order_date ? $value->order_date : '--' }}</td>
    <td>
        <a href="{{ url('edit-order/'.encrypt($value->id)) }}"><i class="fa fa-edit"></i> </a>
        <a class="cursor-pointer" onClick="deleteOrder({{$value->id}})"><i class="fa fa-trash-o"></i></a>
        <a href="{{ url('generate-invoice/'.encrypt($value->id)) }}"><i class="fa fa-download"></i> </a>
    </td>
  </tr>
  @endforeach
  @else
  <tr>
      <td colspan="8" class="text-bold text-danger text-center">
          No Data Found
      </td>
  </tr>
  @endif
 
</table> 

</div>

</body>
</html>
<script>
     let token = "{{ csrf_token() }}";
  function deleteOrder(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) { 
                    $.ajax({
                        type: "DELETE",
                        url: '/delete-order/id',
                        async: true,
                        data: {
                            '_token': token,
                            'orderId': id,
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                if (response == "Success") {
                                    swal("Success!", "claim deleted successfully.", "success", {
                                        button: "Ok",
                                    }).then(function() {
                                        location.reload();
                                    });
                                }
                                if (response == "Error") {
                                    swal("Error!", "Error deleting claims!.", "error", {
                                        button: "Ok",
                                    })
                                }
                            } else {
                                console.log("Error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled!", "You cancelled the operation.", "error", {
                        button: "Ok",
                    })
                }
            });
    }
</script>