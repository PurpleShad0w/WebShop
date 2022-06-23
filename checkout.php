<!DOCTYPE html>
<html lang="en">

<style>
  #calculate {
				width: 200px;
				padding: 10px;
				border: 1px solid black;
				text-align: center;
				background-color: lightgrey;
				display: inline;}
  #calculate:hover {
	  cursor: pointer;}

  #calculate:active {
    box-shadow: 0 3px #666;
    transform: translateY(4px);}
  </style>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>

<?php
	require 'config.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price, qty FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
    if ($row['qty']==8){
      $row['total_price'] = $row['total_price'] * 0.92;
    } elseif ($row['qty']==16)
      $row['total_price'] = $row['total_price'] * 0.84; 
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>

<!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="home.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Home Page</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="loginPage.php"><i class=""></i>Login</a>
        <li class="nav-item">
          <a class="nav-link" href="register.php"><i class=""></i>Register</a>
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="fas fa-mobile-alt mr-2"></i>Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="allOrders.php"><i class="fas fa-money-check-alt mr-2"></i>Previous Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5 id="price"><b>Total Amount Payable : </b><?php echo $grand_total ?> €	</h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
          </div>
          <div class="form-group">
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="cod">Cash On Delivery</option>
              <option value="netbanking">Net Banking</option>
              <option value="cards">Debit/Credit Card</option>
            </select>

            <br>
            <table id="t2">
              <tr>
                <th colspan ="2">Please select shipping method:</th>
              </tr>
              <tr>
                <td><input type="radio" name="wheel" id="DPD" value=0 checked>
                <label for="DPD">DPD</label><br></td>
                <td style="text-align: right">0</td>
              </tr>
              <tr>
                <td><input type="radio" name="wheel" id="DHL" value=24>
                <label for="DHL">DHL</label><br></td>
                <td style="text-align: right">24</td>
              </tr>
              <tr>
                <td><input type="radio" name="wheel" id="DHL Express" value=33>
                <label for="DHL Express">DHL Express</label></td>
                <td style="text-align: right">33</td>
              </tr>
            </table>
            <br>
            <legend>Total Price</legend><br>

            <p id="calculate" > Calculate... </p><br><br>

            <label id="c"><input type="text"></label><br>

            <script type="text/javascript">

                var num = <?php echo $grand_total ?>; 

            
              document.getElementById('calculate').addEventListener('click', function (evt) {

              var ele = document.getElementsByTagName('input');
              
              var total=0;        
                      for(var i = 0; i < ele.length; i++) {
                            
                          if(ele[i].type=="radio") {
                            
                              if(ele[i].checked){
                      var cost = Number(ele[i].value);
                      if (isNaN(cost)==false){
                        total=total+cost;
                      }
                    }
                  }
                }
                totalAmmount=  num + total;
                document.getElementById("c").innerHTML = totalAmmount+"€";
                
              });
            

            </script>

            
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>