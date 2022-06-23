<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <title>Cart</title>
  <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#title{
   
    color: #04AA6D;
     font-family:  Verdana;

}
#buyButton{

    background-color: #04AA6D;

    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>

</head>


<body>
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
          <a class="nav-link active" href="allOrders.php"><i class="fas fa-money-check-alt mr-2"></i>Previous Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->
    <?php
         session_start();
         require_once "configfile.php";
         $registeredUserEmail = $_SESSION["username"];
         $sql = "SELECT email,id,amount_paid,products,name,phone,address,pmode FROM orders ";
         $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
            // output data of each row 
            ?>
            <h2 id="title">All your previous orders!</h2>
            <table id="customers">
            
            <tr>
                <th><b>ID</b></th>
                <th><b>Products</b></th>
                <th><b>Amount Paid</b></th>
             </tr>
             <?php
                // require 'config.php';
                //     function clickMe(){
                //      $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
                //     $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$orderProducts,$amount_paid);
                //     $stmt->execute();
                //   };
             ?>
                <script>
                    $(document).ready(function(){
                    $('.button').click(function(){
                        var clickBtnValue = $(this).val();
                        var ajaxurl = 'newOrder.php',
                        data =  {'action': clickBtnValue};
                        $.post(ajaxurl, data, function (response) {
                            // Response div goes here.
                            alert("action performed successfully");
                        });
                    });
                });
                </script>

                <?php
                    if (isset($_POST['action'])) 
                                clickMe();
                                
                        
                    }
                    ?>
            <?php
            while($row = $result->fetch_assoc()) {
                
                



                $email= $row["email"]; 
                $id = $row["id"];
                $amount_paid= $row["amount_paid"];
                $orderProducts = $row["products"];
                $name = $row["name"];
                $phone = $row["phone"];
                $address= $row["address"];
                $pmode = $row["pmode"];
                if($email==$registeredUserEmail){ ?>
                    
                    <tr>
                        
                        <td><?=$id;?></td>
                        <td><?=$orderProducts;?></td>
                        <td><?=$amount_paid;?></td>
                        <td><input type="submit" id="buyButton" name="clickMe" value="clickMe"> </td> 
                    
                    </tr>
               
                <?php  

                    
                }
            
            ?> </table><?php 
            
        }
           //echo $allorders;
           $conn->close();
    ?>

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