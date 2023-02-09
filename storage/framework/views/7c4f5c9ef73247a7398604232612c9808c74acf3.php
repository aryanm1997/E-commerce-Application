<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
  <a class="active" href="<?php echo e(url('/')); ?>">Home</a>
</div>
<div style="padding-left:16px"><br>
<h2>Product Management</h2>
<table>
  <tr>
    <th>SL.NO</th>
    <th>Product name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Actions</th>
  </tr>
  <?php if($product->count() > 0): ?>
  <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td> <?php echo e((($product->currentPage() - 1 ) * $product->perPage() ) + $loop->iteration); ?></td>
    <td><?php echo e($value->product_name ? $value->product_name : '--'); ?></td>
    <td><?php echo e($value->category ? $value->category : '--'); ?></td>
    <td><?php echo e($value->price ? $value->price : '--'); ?></td>
    <td>
        <a href="<?php echo e(url('edit-product/'.encrypt($value->id))); ?>"><i class="fa fa-edit"></i> </a>
        <a class="cursor-pointer" onClick="deleteProduct(<?php echo e($value->id); ?>)"><i class="fa fa-trash-o"></i></a>
    </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php else: ?>
  <tr>
      <td colspan="8" class="text-bold text-danger text-center">
          No Data Found
      </td>
  </tr>
  <?php endif; ?>
</table> 
</div>

</body>
</html>
<script>
  let token = "<?php echo e(csrf_token()); ?>";
  function deleteProduct(id) {
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
                        url: '/delete-product/id',
                        async: true,
                        data: {
                            '_token': token,
                            'productId': id,
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
</script><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/list.blade.php ENDPATH**/ ?>