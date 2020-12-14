

<?php
session_start();

include'../PHPfunctions/Function.php';
include 'dbconnect.php';
createFunctionHeader('Account Page');
define("FIRSTNAME_MAX_LENGTH", 20);
define("LASTNAME_MAX_LENGTH", 20);
define("CITY_MAX_LENGTH", 8);

header("Content-type: text/html");

$customerid = 0;
$FirstName = '';
$LastName = '';
$City = '';
$Username = '';
$Password = '';
$error = 0;
if(isset($_SESSION['customerid'])){
	
	
	if(isset($_POST['checkPost'])){
		
		$customerid = $_SESSION['customerid'];
		$FirstName = htmlspecialchars($_POST['FirstName']);
		$LastName = htmlspecialchars($_POST['LastName']);
		$City = htmlspecialchars($_POST['City']);
		$Address = htmlspecialchars($_POST['Address']);
		$PostalCode = htmlspecialchars($_POST['PostalCode']);
		$Username = htmlspecialchars($_POST['Username']);
		$Password = htmlspecialchars($_POST['Password']);
		
		
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
	
	if(mb_strlen($Address) == 0){
			$AddressErrorMessage = "The Address cannot be empty"; $error=1;
		}
		
		if(mb_strlen($PostalCode) == 0){
			$PostalCodeErrorMessage = "The PostalCode cannot be empty"; $error=1;
		}
		
    
    //validation of Citytain the$Taxes
    if(mb_strlen($City) > CITY_MAX_LENGTH){
        $CityErrorMessage = "The City cannot contain more than" . CITY_MAX_LENGTH . "characters";  $error=1;
}else{
        if(mb_strlen($City) == 0){
             $CityErrorMessage = "The City cannot be empty"; $error=1;
            }     }  
	
		if(mb_strlen($Username) == 0){
			$UsernameErrorMessage = "The Username cannot be empty"; $error=1;
		}
		
		if(mb_strlen($Password) == 0){
			$PasswordErrorMessage = "The Password cannot be empty"; $error=1;
		}
		
		if($error == 0){
			
			$sql = "UPDATE customer SET firstName='".$FirstName."',lastName='".$LastName."',address = '".$Address."',city='".$City."',postalCode='".$PostalCode."', userName='".$Username."',password='".$Password."' WHERE customerid=".$customerid;

			if ($conn->query($sql) === TRUE) {
			  echo "<center><h2>Record updated successfully</center></h2>";
			} else {
				$error = 1;
			  echo "<center><h2>Error updating record: </center></h2>" . $conn->error;
			}
		}
		
		
	}
	else{
	
		$customerDetails = $_SESSION['custDetails'];
		$customerid = $_SESSION['customerid'];
		$FirstName = $customerDetails['firstName'];
		$LastName = $customerDetails['lastName'];
		$City = $customerDetails['city'];
		$Address = $customerDetails['address'];
		$PostalCode = $customerDetails['postalCode'];
		$Username = $customerDetails['userName'];
		$Password = $customerDetails['password'];
	}
	
if(!isset($_POST['checkPost']) || $error == 1)
{
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
<form action="" method="post">

     
    <p class="control">
       <label>First Name:<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="FirstName" value ="<?php echo $FirstName; ?>" />
       <?php if(isset($FirstNameErrorMessage)) { ?>  <br><span class="red"><?php echo $FirstNameErrorMessage; ?></span> <?php } ?>
    </p>

     <p class="control">
       <label>Last Name:<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="LastName" value ="<?php echo $LastName; ?>" />
        <?php if(isset($LastNameErrorMessage)) { ?> <br><span class="red"><?php echo $LastNameErrorMessage; ?></span> <?php } ?>
    </p>
    
	<p class="control">
       <label>Address: &nbsp; &nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="Address" value ="<?php echo $Address; ?>" />
        <?php if(isset($AddressErrorMessage)) { ?> <br><span class="red"><?php echo $AddressErrorMessage; ?></span> <?php } ?>
    </p>
    
     <p class="control">
       <label>City: &nbsp; &nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="City" value ="<?php echo $City; ?>" />
        <?php if(isset($CityErrorMessage)) { ?> <br><span class="red"><?php echo $CityErrorMessage; ?></span> <?php } ?>
    </p>
	
	<p class="control">
       <label>Postal Code: &nbsp; &nbsp;<span aria-hidden="true" class="required">*</span></label>
        <input type="text" name="PostalCode" value ="<?php echo $PostalCode; ?>" />
        <?php if(isset($PostalCodeErrorMessage)) { ?> <br><span class="red"><?php echo $PostalCodeErrorMessage; ?></span> <?php } ?>
    </p>
      
     <p class="control">
       <label>Username:<span aria-hidden="true" class="required">*</span></label>
       <input type="text" name="Username" value ="<?php echo $Username; ?>" />
        <?php if(isset($UsernameErrorMessage)) { ?> <br><span class="red"><?php echo $UsernameErrorMessage; ?></span> <?php } ?>
    </p>
    
    
     <p class="control">
       <label>Password:<span aria-hidden="true" class="required">*</span></label>
        <input type="password" name="Password" value ="<?php echo $Password; ?>" />
        <?php if(isset($PasswordErrorMessage)) { ?> <br><span class="red"><?php echo $PasswordErrorMessage; ?></span> <?php } ?>
    </p>
    
    
    
    
    
     <p >
	 <input type="hidden" value ="1" name="checkPost" />
        <input type="submit" value ="Update info" name="submit" class = "button" />
        
    </p>
    
    
     
     </form>
	 
	 <br>
	 <br>
<center><form action='logout.php' method='post'> <input type='submit' value ='Logout' name='logout'  class = 'button' /></form></center>

     <?php
	 
	}
}
    displayCopyright();
    
    createFunctionFooter();?>