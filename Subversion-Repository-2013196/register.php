<?php

include'../PHPfunctions/Function.php';

include 'dbconnect.php';
// include'dbconnect.php';
createFunctionHeader('Register Page');

//define("PRODUCTCODE_MAX_LENGTH", 12);
define("FIRSTNAME_MAX_LENGTH", 20);
define("LASTNAME_MAX_LENGTH", 20);
define("CITY_MAX_LENGTH", 8);

$error=0;
header("Content-type: text/html");
if(isset($_POST['Register'])){
    
    
    $error=0;
   // $productcode = htmlspecialchars($_POST["ProductCode"]);
    $FirstName = htmlspecialchars($_POST["FirstName"]); 
    $LastName = htmlspecialchars($_POST["LastName"]); 
    $City = htmlspecialchars($_POST["City"]); 
    $Address = htmlspecialchars($_POST["Address"]); 
    $PostalCode = htmlspecialchars($_POST["PostalCode"]);
    $Username = htmlspecialchars($_POST["Username"]); 
    $Password = htmlspecialchars($_POST["Password"]);
	
	
	
	//validation of FirstName
    if(mb_strlen($FirstName) > FIRSTNAME_MAX_LENGTH){
                $FirstNameErrorMessage = "The FirstName cannot contain more than" . FIRSTNAME_MAX_LENGTH . "characters";  $error=1;
    }else{
        if(mb_strlen($FirstName) == 0){
            $FirstNameErrorMessage = "The FirstName cannot be empty"; $error=1;
        }
    }
    
    //validation of LastName
    if(mb_strlen($LastName) > LASTNAME_MAX_LENGTH){
                $LastNameErrorMessage = "The LastName cannot contain more than" . LASTNAME_MAX_LENGTH . "characters";  $error=1;
    }else{
        if(mb_strlen($LastName) == 0){
            $LastNameErrorMessage = "The LastName cannot be empty"; $error=1;
        }
    }
    
    //validation of Citytain the$Taxes
    if(mb_strlen($City) > CITY_MAX_LENGTH){
        $CityErrorMessage = "The City cannot contain more than" . CITY_MAX_LENGTH . "characters";  $error=1;
}else{
        if(mb_strlen($City) == 0){
             $CityErrorMessage = "The City cannot be empty"; $error=1;
            }     }  
	
		if(mb_strlen($Address) == 0){
			$AddressErrorMessage = "The Address cannot be empty"; $error=1;
		}
		
		if(mb_strlen($PostalCode) == 0){
			$PostalCodeErrorMessage = "The PostalCode cannot be empty"; $error=1;
		}
		
		if(mb_strlen($Username) == 0){
			$UsernameErrorMessage = "The Username cannot be empty"; $error=1;
		}
		
		if(mb_strlen($Password) == 0){
			$PasswordErrorMessage = "The Password cannot be empty"; $error=1;
		}
	//$error = 0;
	if( $error == 0 ){
		
		
		$sql = "INSERT INTO customer (firstName, lastName, city,address , postalCode, userName , password)
				VALUES ('".$FirstName."','".$LastName."','".$City."','".$Address."','".$PostalCode."','".$Username."','".$Password."')";
		
		//$conn->query("Insert_Customer(".$FirstName.",".$LastName.",".$City.",".$Address.",".$PostalCode.",".$Username.",".$Password.")");
		
		if ($conn->query($sql) === TRUE) {
		  echo "<center><h2>New record created successfully</h2></center>";
		} else {
		  echo "<strong>Error: " . $sql . "</strong><br>" . $conn->error;
		}

$conn->close();
	}
    
}

if(!isset($_POST['Register']) || $error == 1){
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
<form method="post">

    
    <p class="control">
       <label>First Name:<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="FirstName" value ="<?php if(isset($FirstName)) echo $FirstName; ?>" />
         <?php if(isset($FirstNameErrorMessage)) { ?> <br><span class="red"><?php echo $FirstNameErrorMessage; ?></span> <?php } ?>
    </p>

    
     <p class="control">
       <label>Last Name:<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="LastName" value ="<?php if(isset($LastName)) echo $LastName; ?>" />
         <?php if(isset($LastNameErrorMessage)) { ?> <br><span class="red"><?php echo $LastNameErrorMessage; ?></span> <?php } ?>
    </p>
    
    <p class="control">
       <label>Address:&nbsp;&nbsp;&nbsp;&nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="Address" value ="<?php if(isset($Address)) echo $Address; ?>" />
         <?php if(isset($AddressErrorMessage)) { ?> <br><span class="red"><?php echo $AddressErrorMessage; ?></span> <?php } ?>
    </p>
	
     <p class="control">
       <label>City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="City" value ="<?php if(isset($City)) echo $City; ?>" />
         <?php if(isset($CityErrorMessage)) { ?> <br><span class="red"><?php echo $CityErrorMessage; ?></span> <?php } ?>
    </p>
    
    <p class="control">
       <label>Postal Code:<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="PostalCode" value ="<?php if(isset($PostalCode)) echo $PostalCode; ?>" />
         <?php if(isset($PostalCodeErrorMessage)) { ?><br> <span class="red"><?php echo $PostalCodeErrorMessage; ?></span> <?php } ?>
    </p>
       
    <p class="control">
       <label>Username:<span aria-hidden="true" class="required">*</span></label>
       <input type="text" name="Username" value ="<?php if(isset($Username)) echo $Username; ?>" />
      <?php if(isset($UsernameErrorMessage)) { ?> <br> <span class="red"><?php echo $UsernameErrorMessage; ?></span> <?php } ?>
    </p>
    
    
     <p class="control">
       <label>Password:<span aria-hidden="true" class="required">*</span></label>
        <input type="password" name="Password" value ="<?php if(isset($Username)) echo $Password; ?>" />
          <?php if(isset($PasswordErrorMessage)) { ?> <br><span class="red"><?php echo $PasswordErrorMessage; ?></span> <?php } ?>
    </p>
    <p >
        <input type="submit" value ="Register" name="Register"  class = "button" /> &nbsp;  &nbsp; <input type="reset" value ="Reset" name="Reset"  class = "button" />

</p>
<?php
}    
    displayCopyright();
    
    createFunctionFooter();?>