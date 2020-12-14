<?php
session_start();



// include'dbconnect.php';
// constant
define("PRODUCTCODE_MAX_LENGTH", 12);
define("FIRSTNAME_MAX_LENGTH", 20);
define("LASTNAME_MAX_LENGTH", 20);
define("CITY_MAX_LENGTH", 8);
define("MESSAGE_MAX_LENGTH", 200);
define("MESSAGE_MIN_LENGTH", 0);
define("PRICE_MAX_LENGTH", 10000);
define("PRICE_MIN_LENGTH", 0); 
define("QUANTITY_MAX_LENGTH", 99);
define("QUANTITY_MIN_LENGTH", 1);
define("TAXES",0.152);

//empty variable

$productcode = "";
$FirstName = "";
$LastName = "";
$City = "";
$Message = "";
$Price = "";
$Quantity = "";
$Sum = "";
$GrandTotal = ""; 
$Taxes = "";
$Tax = "";


//variable to store error message
$productcodeErrorMessage = ""; 
$FirstNameErrorMessage = ""; 
$LastNameErrorMessage = ""; 
$CityErrorMessage = "";
$MessageErrorMessage = "";
$PriceErrorMessage = ""; 
$QuantityErrorMessage = "";
$TaxesErrorMessage = "";

//login


// submit method
include 'dbconnect.php';
include '../PHPfunctions/Function.php';
createFunctionHeader('Buying Page');
$error = 0;
//echo '----in 52----------------------------<br>';

//print_r($_SESSION);


if (isset($_SESSION['customerid'])){
	
		//echo '----in bying 54----------------------------<br>';

	$sqlSelectP = "SELECT * FROM product";
	$resultSelectP = $conn->query($sqlSelectP);
	$productArr = array();
	$index = 0;
	if($resultSelectP->num_rows > 0){
        while($product = $resultSelectP->fetch_assoc()) {
			$productArr[$index]['productid'] = $product['productid'];
			$productArr[$index]['productcode'] = $product['productcode'];
			$productArr[$index]['productDescription'] = $product['productDescription'];
			$productArr[$index]['productPrice'] = $product['productPrice'];
			$index++;
		}
		
	}
	
if(isset($_POST['checkPost'])){

	$ProductCode = htmlspecialchars($_POST["ProductCode"]); 
    $Comments = htmlspecialchars($_POST["Comments"]); 
    $Quantity = htmlspecialchars($_POST["Quantity"]); 
	
	
	 if(mb_strlen($ProductCode) == 0){
            $ProductCodeErrorMessage = "Selecta a Product"; $error=1;
        }
		
	
	if(mb_strlen($Comments) > MESSAGE_MAX_LENGTH){
                $CommentsErrorMessage = "The Comments cannot contain more than" . MESSAGE_MAX_LENGTH . "characters";  $error=1;
    }
	
	if($Quantity < QUANTITY_MIN_LENGTH || $Quantity > QUANTITY_MAX_LENGTH){
                $QuantityErrorMessage = "The Quantity should be between ".QUANTITY_MIN_LENGTH." and " . QUANTITY_MAX_LENGTH . "";  $error=1;
    }else{
        if(mb_strlen($Quantity) == 0){
            $QuantityErrorMessage = "The Quantity cannot be empty"; $error=1;
        }
    }

	
	if($error == 0){
		
		$selectProductDetails = array();
		
		foreach($productArr as $rowVal){
			
			if($rowVal['productid'] == $ProductCode){
				
				$selectProductDetails = $rowVal;
				break;
			}
			
		}
		
		if(count($selectProductDetails)> 0){
			
			$productPrice = $selectProductDetails['productPrice'];
			
			$subtotal = $productPrice * $Quantity;
			
			$taxesAmount = $subtotal * TAXES;
			
			$grandTotal = $subtotal + $taxesAmount;
			
			$customerId = $_SESSION['customerid'];
			
			
			$dateCurr = date('Y-m-d');
			
			$sqlPurchase = "INSERT INTO purchase (product_uuid, customer_uuid, quantity,price , comments, subtotal , taxes_amount,grandtotal,createdDate)
				VALUES (".$ProductCode.",".$customerId.",".$Quantity.",".$productPrice.",'".$Comments."',".$subtotal.",".$taxesAmount.",".$grandTotal.",'".$dateCurr."' )";
		
		
		
		if ($conn->query($sqlPurchase) === TRUE) {
		  echo "<center><h2>New Purchase added successfully</h2></center>";
		} else {
		  echo "<strong>Error: " . $sql . "</strong><br>" . $conn->error;
		}
		}
		
		//displayCopyright();
    
		//createFunctionFooter();
	}

}	

if(!isset($_POST['checkPost']) || $error == 1)
{
//echo '----in bying 132----------------------------<br>';

?>
<link rel="stylesheet" href="../CSS/Styles.css">

<style>

img#logo {
  width: 10%;
  margin: 50px auto;
  display: block;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  margin: 2px 1px;
  cursor: pointer;
}

input[type] {
  width: 20%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>

<form action="Buying.php" method="post">

    <p class="control">
        <label>Product Code:<span aria-hidden="true" class="required">*</span></label>
		
		<select name="ProductCode" ><option value="">Select</option>
    <?php 
	
    for($i=0; $i<count($productArr); $i++)
     {
      ?>

     <option value="<?php echo $productArr[$i]['productid'];?>"><?php echo $productArr[$i]['productcode'] .'-'.$productArr[$i]['productDescription'];?></option>
    <?php
        }
        ?> 
		</select>
        <!--<input type="text" name="ProductCode" value ="<?php //echo $productcode; ?>" /> -->
        <?php if(isset($ProductCodeErrorMessage)) { ?>  <br><span class="red"><?php echo $ProductCodeErrorMessage; ?></span> <?php } ?>
    </p>
    
    

    
     <p class="control">
       <label>Comments:&nbsp; &nbsp;&nbsp; &nbsp;</label>
       <input type="text" name="Comments" value ="<?php if(isset($Comments)) echo $Comments; ?>" />
      <?php if(isset($CommentsErrorMessage)) { ?> <br> <span class="red"><?php echo $CommentsErrorMessage; ?></span> <?php } ?>
    </p>
    
    
     <p class="control">
       <label>Quantity:&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="number" name="Quantity" value ="<?php if(isset($Quantity)) echo $Quantity; ?>" />
      <?php if(isset($QuantityErrorMessage)) { ?>  <br><span class="red"><?php echo $QuantityErrorMessage; ?></span> <?php } ?>
    </p>
    
    
    
     <input type="hidden" value ="1" name="checkPost" />
    
     <p >
        <center><input type="submit" value ="Buy" name="submit" class = "button" /></center>
        
    </p>
    
    
     
     </form>
   <center><form action='logout.php' method='post'> <input type='submit' value ='Logout' name='logout'  class = 'button' /></form></center>;
    <?php
	
}	

//echo '----in bying 189----------------------------<br>';
}
else   {
			//echo '----in bying 193----------------------------<br>';
			//die();
	$redirectURL = 'index.php';
	header("Location: ".$redirectURL);
	//login();
}  
    displayCopyright();
    
    createFunctionFooter();
    ?>
	