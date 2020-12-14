<?php
session_start();


include '../PHPfunctions/Function.php';

createFunctionHeader('Home Page');


echo "<h1>Volkswagon's Story</h1>";

echo "<p>On May 28, 1937, the government of Germany–then under the control of Adolf Hitler of the National Socialist (Nazi) Party–forms a new state-owned automobile company, then known as Gesellschaft zur Vorbereitung des Deutschen Volkswagens mbH.</p>";

echo"<p>It is known for the iconic Beetle and headquartered in Wolfsburg. It is the flagship brand of the Volkswagen Group, the largest automaker by worldwide sales in 2016 and 2017.</p>";

echo"<p>The group's biggest market is in China, which delivers 40% of its sales and profits.</p>";

echo"<p>The meaning of volk is people therefore volkswagon represents peoples car</p>";


shuffle($advertisingPictures);

//echo "<a href= 'https://www.wowhoverboard.com/'>";
//echo '<img class = "pictures" src =" ' . $advertisingPictures[0]."</img>";
//echo"</a>";
 
 $isPostSucess = 0;
 //print_r($_SESSION);
    if(isset($_POST['login'])){
       // echo '----in 55----------------------------<br>';
    $username = htmlspecialchars($_POST["Username"]);
    $password = htmlspecialchars($_POST["Password"]);

	$sqlSelect = "SELECT * FROM customer where username = '".$username."' and password ='".$password."' ";
	$resultSelect = $conn->query($sqlSelect);

    if($resultSelect->num_rows > 0){
        while($customer = $resultSelect->fetch_assoc()) {
                $_SESSION['customerid']=$customer['customerid'];
				$_SESSION['custDetails'] = $customer;
				$isPostSucess = 1;
				break;
        }
        

}
else{
	$loginErrorMessage = "Invalid credentials!! Please try again!!";
}
}
if($isPostSucess){
	
	$redirectURL = 'Buying.php';
	header("Location: ".$redirectURL);
}
else
{
	if(isset($_SESSION['customerid'])){
		
		$redirectURL = 'Buying.php';
		header("Location: ".$redirectURL);
		
	}
	else{
		
	
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
 
 <form action ='<?php echo $_SERVER['PHP_SELF']; ?>' method="post" >
    <p class="control">
       <label>Username:<span aria-hidden="true" class="required">*</span></label>
       <input type="text" name="Username" value ="<?php if(isset($Username)) echo $Username; ?>" />
<?php if(isset($UsernameErrorMessage)) { ?> <br><span class="red"><?php echo $UsernameErrorMessage; ?></span> <?php } ?>
    </p>
    
    
     <p class="control">
       <label>Password:<span aria-hidden="true" class="required">*</span></label>
        <input type="password" name="Password" value ="<?php if(isset($Username)) echo $Password; ?>" />
        <?php if(isset($PasswordErrorMessage)) { ?> <br><span class="red"><?php echo $PasswordErrorMessage; ?></span> <?php } ?>
    </p>
    <p >
        <input type="submit" value ="login" name="login" class = "button" />
		<?php if(isset($loginErrorMessage)) { ?> <br><span class="red"><?php echo $loginErrorMessage; ?></span> <?php } ?>
</p>
<p>
Need a user account ? <a  href='register.php' class = 'button'>Register</a></p>
    </form>
 
<?php 
} 

}
displayCopyright();

createFunctionFooter();

