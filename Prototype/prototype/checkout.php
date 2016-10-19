<?php
session_start();

$page_title="Checkout";
include '../Includes/layout_header.php';

$db = StoreDB::getInstance();

//$action = isset($_GET['action']) ? $_GET['action'] : "";
//$name = isset($_GET['name']) ? $_GET['name'] : "";
//$quantity = $isset($_GET['quantity']) ? $_GET['quantity'] : "1";
$cart = $_SESSION['cart_products'];


if(count($cart) > 0){
//    $PIDs = "";
//    $quantities = "";
//    echo "Cart count: " . count($cart);
    $subtotal = 0;
    $price = 0;
    $quantity = 0;
    $name = '';
    echo "<p><h3>1. Review Cart Items</h3><p>
    <table class= 'table table-hover table-responsive table-bordered' id='cartTable'>
        <tr>
            <th class='textAlignLeft'>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
        </tr>";
    
    foreach($cart as $PID => $value){
        
//        foreach($value as $key => $final_val) {
//            echo "KEY: " . $key . "<br>";
//            echo "VALUE: " . $final_val . "<br>";
//            if ($key == 'PID') {
//                echo "PID: " . $PID;
//                echo "quantity: " . $value;
                //$PIDS = $PIDs . $final_val . ",";
                $result = $db->get_cart_variables($PID);
                while($row = mysqli_fetch_array($result)) {
                    $name = htmlentities($row["name"]);
                    $price = htmlentities($row["price"]);
                }
                mysqli_free_result($result);
////            } else {
////                $quantity = $final_val;
////            }
//            
            $total = $price * (int)$value;

            
//            
        
        echo "<tr>
                <td>" . $name . "</td>
                <td>" . $price . "</td>
                <td>" . $value . "</td>
                <td>" . $total . "</td>
                <td><form name='removeForm'>
                    <input type='hidden' name='id' value='" . $PID . "'/>
                    <button class='btnRemove' type='submit' value='remove'>Remove</button></td>
                    </form>
                </td>
            </tr>";
        
        $subtotal += $total;
    }  
    
    echo "<tr>
            <td><strong>Subtotal</strong></td>
            <td></td>
            <td></td>
            <td><strong>" . $subtotal . "</strong></td>
        </tr>
    </table>
    <a href='store.php' class='btn btn-default'>Continue Shopping</a>";
    
//    echo "<a href='checkout.php' class='btn btn-default'>Checkout</a>
//        <button onclick='showDiv(checkoutDiv)'>Checkout</button>
//        <div id='checkoutDiv' style='display:none;'>
//            <a href='#' class='btn btn-default'>Checkout as Guest</a>
//            <a href='#' class='btn btn-default'>Login</a>
//        </div>";
}
else {
    echo "<div class='alert alert-danger'>
        <form action='store.php'>
        <button type='submit' class='close' aria-label='close'>&times;</button>
        Shopping cart is <strong>empty</strong>!
        </form>
    </div>";    
}
?>
<hr class="top-pad-50">
<p class="top-pad-50"><h3>2. Enter Customer Details</h3></p>
<form class="form-horizontal bottom-pad-50" method="post" action="order_process.php">
  <div class="form-group">      
      <div class="col-md-4">
        <label for="inputFirst">First Name</label>
        <input type="text" class="form-control" id="inputFirst" name="inputFirst" placeholder="Bob">
      </div>
      <div class="col-md-4">
        <label for="inputLast">Last Name</label>
        <input type="text" class="form-control" id="inputLast" name="inputLast" placeholder="Dole">
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-8">
        <label for="inputAddress1">Address Line 1</label>
        <input type="text" class="form-control" id="inputAddress1" name="inputAddress1" placeholder="123 Sesame Street">
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-8">
        <label for="inputAddress2">Address Line 2</label>
        <input type="text" class="form-control" id="inputAddress2" name="inputAddress2" placeholder="Apt 5">
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-3">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="Kansas City">
      </div>
      <div class="col-md-2">
	<label for="inputState">State</label>	
        <select class="form-control" id="inputState" name="inputState">
            <option value="">N/A</option>
            <option value="AK">Alaska</option>
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="AZ">Arizona</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DC">District of Columbia</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="IA">Iowa</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="MA">Massachusetts</option>
            <option value="MD">Maryland</option>
            <option value="ME">Maine</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MO">Missouri</option>
            <option value="MS">Mississippi</option>
            <option value="MT">Montana</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="NE">Nebraska</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NV">Nevada</option>
            <option value="NY">New York</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="PR">Puerto Rico</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VA">Virginia</option>
            <option value="VT">Vermont</option>
            <option value="WA">Washington</option>
            <option value="WI">Wisconsin</option>
            <option value="WV">West Virginia</option>
            <option value="WY">Wyoming</option>
        </select>	
      </div>
      <div class="col-md-3">
        <label for="inputZip">Zip Code</label>
        <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="12345" pattern="[0-9]{5}|[0-9]{9}" required title="Not a valid zip code">
      </div>
  </div>
  <div class="form-group">      
      <div class="col-md-4">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="bobdole@email.com">
      </div>
      <div class="col-md-4">
        <label for="inputPhone">Phone Number</label>
        <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="1234567890">
      </div>
  </div>
    
  <hr class="top-pad-50">
  <p class="top-pad-50"><h3>3. Enter Payment Information</h3></p>
  <div class="form-group">
      <div class="col-md-8">
        <label for="inputCardName">Name on Card</label>
        <input type="text" class="form-control" id="inputCardName" name="inputCardName" placeholder="Bob Dole">
      </div>
  </div>

  <div class="form-group">      
      <div class="col-md-4">
        <label for="inputCC">Credit Card Number</label>
        <input type="text" class="form-control" id="inputCC" name="inputCC" pattern="[0-9]{16}" required title="Not a valid credit card number">
      </div>
      <div class="col-md-2">
        <label for="inputCCExp">Expiration Date</label>
        <input type="text" class="form-control" id="inputCCExp" name="inputCCExp" placeholder="MMYY" pattern="[0-9]{4}" required title="Format must be MMYY">
      </div>
      <div class="col-md-2">
        <label for="inputCCV">CCV</label>
        <input type="text" class="form-control" id="inputCCV" name="inputCCV" pattern="[0-9]{3}" required title="Not a valid CCV">
      </div>
  </div>
  
  <input type="submit" class="btn btn-primary">
</form>


<?php include '../Includes/layout_footer.php';?>