<?php
require 'config.php';

    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $phone = $_POST['phone'];
    // $products = $_POST['products'];
    // $grand_total = $_POST['grand_total'];
    // $address = $_POST['address'];
    // $pmode = $_POST['pmode'];
    function clickMe(){
    $data = '';
    $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
    $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$orderProducts,$amount_paid);
    $stmt->execute();
  //  $stmt2 = $conn->prepare('DELETE FROM cart');
   // $stmt2->execute();
    $data .= '<div class="text-center">
                              <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                              <h2 class="text-success">Your Order Placed Successfully!</h2>
                              <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $orderProducts . '</h4>
                              <h4>Your Name : ' . $name . '</h4>
                              <h4>Your E-mail : ' . $email . '</h4>
                              <h4>Your Phone : ' . $phone . '</h4>
                              <h4>Total Amount Paid : ' . number_format($amount_paid,2) . '</h4>
                              <h4>Payment Mode : ' . $pmode . '</h4>
                        </div>';
    echo $data;

    }
    clickMe();
  
?>