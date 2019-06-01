<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

require_once 'config.php';
//$shippingAddress = $_REQUEST['shippingAddress'] != null ? htmlspecialchars($_REQUEST['shippingAddress']) : null;
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        $qty = $_REQUEST['qty'];
        $query = $conn->query("SELECT * FROM products WHERE productID = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'productID' => $row['productID'],
            'productName' => $row['productName'],
            'productPrice' => $row['productPrice'],
            'productImage' => $row['productImage'],
            'qty' => $qty
        );
        $insertItem = $cart->insert($itemData);

        $redirectLoc = $insertItem ?'viewcart.php':'index.php';

        header("Location: ".$redirectLoc);
    }
    else if($_REQUEST['action'] == 'continueShopping' && !empty($_REQUEST['id'])){
          $productID = $_REQUEST['id'];
          $qty = $_REQUEST['qty'];
          $query = $conn->query("SELECT * FROM products WHERE productID = ".$productID);
          $row = $query->fetch_assoc();
          $itemData = array(
              'productID' => $row['productID'],
              'productName' => $row['productName'],
              'productPrice' => $row['productPrice'],
              'productImage' => $row['productImage'],
              'qty' => $qty
          );
          $insertItem = $cart->insert($itemData);
          $itemID = $_REQUEST['id'];
          if($insertItem){
            header("Location: single-product.php?id=".$itemID);
          }
        #  header("Location: ".$redirectLoc);
      }
    elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'productID' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';
    }
    elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }
    elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['cart_contents'])){
        // insert order details into database
          $email = $_COOKIE['userLogged'] != null ? $_COOKIE['userLogged'] : null;
      //    $shippingAddress = htmlspecialchars($_REQUEST['shippingAddress']);
          $sql = "SELECT userID  FROM users where email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $email);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($uID);
          $row = $stmt->fetch();
          $dateNow = date("Y-m-d H:i:s");
          $status = 1;


        $insertOrder = $conn->query("INSERT INTO transactions (transactionAmount, customerID, address,  transactionStatusID) VALUES ('".($cart->total() + 50)."', '".$uID."', '".$shippingAddress."',  '".$status."')");

        if($insertOrder){
            $transactionID = $conn->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $tempItem = $item['productID'];
                $tempQty = $item['qty'];
            //   $sql .= "INSERT INTO transactions (productID, productQuantity, transactionAmount, customerID, merchantID, dateOrdered) VALUES ('".$item['id']."', '".$item['qty']."', '".($item['subtotal']) + 50"');";
                  $sql .= "INSERT INTO transactionitems (transactionID, productID, quantity) VALUES ('".$transactionID."', '".$tempItem."', '".$tempQty."');";
            }
            // insert order items into database
            $insertOrderItems = $conn->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: confirmation.php?id=$transactionID");
            }else{
              //  header("Location: checkout.php");
              echo ("Mali si insertorderitems");
               echo("Error description: " . mysqli_error($conn));
            }
        }else{
            echo ("Mali si insert order");
          //  header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
  header("Location: index.php");
}
?>
<!-- Delete Modal Box -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" style="color:red"><u>Delete</u></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: white">What do you want to do next?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Shopping</button>
        <a class="btn btn-danger btn-ok">Proceed to Checkout</a>
      </div>
    </div>
  </div>
</div>
