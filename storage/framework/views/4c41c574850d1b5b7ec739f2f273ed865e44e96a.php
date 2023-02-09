<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add or Remove Input Fields Dynamically using jQuery - MyNotePaper</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #33001a;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #000;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #000;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'details')" style="color:#ccc">Product</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')" style="color:#ccc">Order</button>
</div>
<div id="details" class="tabcontent">
<h2>Product</h2>
<div class="container">
  <div class="container"style="max-width: 700px;">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
        </div>
        <form method="post" action="<?php echo e(url('create-product')); ?>">
          <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div id="inputFormRow">
                        <div class="input-group mb-3">
                            <input type="text" name="product_name[]" id="product_name" class="form-control m-input" placeholder="Enter product name" autocomplete="off">
                            <select id="category" name="category[]">
                              <option value="">select category</option>
                              <option value="Television">Television</option>
                              <option value="Headphones">Headphones</option>
                            </select>
                            <input type="text" name="price[]" id="price" class="form-control m-input" placeholder="Enter price" autocomplete="off">
                            <div class="input-group-append">
                                <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    </div>

                    <div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Add Row</button>
                </div>
            </div><br>
            <input type="submit" value="Submit">
            <a href="<?php echo e(url('list-product')); ?>">Product list</a>
        </form>
    </div>
</div>
</div>

<div id="Paris" class="tabcontent">
  <h3>Order</h3>
  <form method="POST" action="<?php echo e(url('create-order')); ?>">
    <?php echo csrf_field(); ?>
    <label>Order ID</label>
    <input type="text" id="order_id" name="order_id" placeholder="Enater Order ID">

    <label>Customer name</label>
    <input type="text" id="customer_name" name="customer_name" placeholder="Enater Customer name">

    <label>Phone</label>
    <input type="text" id="phone" name="phone" placeholder="Enater phone">

    <label>Net amount</label>
    <input type="text" id="net_amount" name="net_amount" placeholder="Enater Net amount">

    <label>Product Name</label>
    <select id="product_name" name="product_name">
      <option value="">select category</option>
      <option value="1">Soni TV</option>
      <option value="2">Oneplas Buds</option>
    </select>

    <label>Order date</label>
    <input type="date" id="order_date" name="order_date" placeholder="Enater Order date"><br><br>

    <input type="submit" value="Submit">
    <a href="<?php echo e(url('list-order')); ?>">Order list</a>
  </form>

  
</div>

<script>
  $(document).ready(function() {
    openCity(event, 'details');
  });
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


$("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="product_name[]" id="product_name" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<select id="category" name="category[]">'
            html +='<option value="">select category</option>';
            html +='<option value="Television">Television</option>';
            html +='<option value="Headphones">Headphones</option>';
            html +='</select>';
            html += '<input type="text" name="price[]" id="price" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
</script>
   
</body>
</html> 
<?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/welcome.blade.php ENDPATH**/ ?>