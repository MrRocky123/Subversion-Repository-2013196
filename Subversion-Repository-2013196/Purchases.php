<?php
session_start();
$customerid = 0;
if(isset($_SESSION['customerid'])) {
	
	//echo "sacasacascascas in session id ---- ".$_SESSION['customerid'];
	$customerid = $_SESSION['customerid'];
}
else{
    echo "<input type='submit' name='logout' value='logout'>";

}
include'../PHPfunctions/Function.php';


header("Content-type: text/html");

//$file = fopen("purchases.txt","r") or die("Error");
//$json_data = file_get_contents('purchases.txt');
createFunctionHeader('Purchases Page');

?>

<link rel="stylesheet" href="../CSS/Styles.css">

<style type ="text/css" >

img#logo {
  width: 10%;
  margin: 50px auto;
  display: block;
}

#purchaseTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#purchaseTable td, #purchaseTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#purchaseTable tr:nth-child(even){background-color: #f2f2f2;}

#purchaseTable tr:hover {background-color: #ddd;}

#purchaseTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
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
</style>
        <center><form action='' name = "searchForm"> <input type='text' placeholder = "2020-03-13"  name='SearchDate' id='SearchDate'  style = "padding: 10px 20px;" /><input type='button' value ='Search By Date' name='Search'  class = 'button' onClick = 'fetchRecord(1)' /></form></center>

<span id = 'purchaseDetails' >

</span>
<span id = 'deleteMsg' > </span>
<br>
	 <br>
<center><form action='logout.php' method='post' name = "logoutForm"> <input type='submit' value ='Logout' name='logout'  class = 'button' /></form></center>

    <script>
	
	
function fetchRecord(flagCall) {
	
	var xmlhttp = new XMLHttpRequest();
	
	var customerid = <?php echo $customerid; ?>;
	
	
	
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("purchaseDetails").innerHTML = this.responseText;
		
      }
    };
	if(flagCall == 1){
		
		var sDate = document.getElementById("SearchDate").value;
		xmlhttp.open("GET", "purchase.php?sDate="+sDate+"&custID="+customerid, true);
	}
    else if(flagCall == 2){
		xmlhttp.open("GET", "purchase.php?custID="+customerid, true);
	}
    xmlhttp.send();
	
}
function deleteRecord(delId) {
	
	//var delId = document.getElementById("Delete").value;
	
	//alert("-----delId--------"+delId);
	
  if (delId.length == 0) {
    //document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("deleteMsg").innerHTML = this.responseText;
		// document.getElementById("purchaseDetails").innerHTML = "";
		fetchRecord(2);
      }
    };
    xmlhttp.open("GET", "purchase.php?delId=" + delId, true);
    xmlhttp.send();
  }
}

</script>

<?php


    displayCopyright();
    
    createFunctionFooter();
    
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
   