<?php

include 'dbconnect.php';

if(isset($_GET['delId'])){
	
	$sqlDel = "DELETE FROM purchase WHERE purchaseid=".$_GET['delId'];

if ($conn->query($sqlDel) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
	
	die();
}
else{
	
	if (isset($_GET['custID'])){
		
		
		$customerid = $_GET['custID'];
		//echo '----$customerid-----'.$customerid;
		
		$sDate = "";
		
		
		
		$sqlSelect = "SELECT * FROM customer where customerid = ".$customerid;
		
		
		$resultSelect = $conn->query($sqlSelect);
		$custDetails = array();
		if($resultSelect->num_rows > 0){
			while($customer = $resultSelect->fetch_assoc()) {
				
				$custDetails = $customer;
			}
			
		}
	
	
	if (isset($_GET['sDate']) && strlen(trim($_GET['sDate'])) > 0){
			
			$sDate = trim($_GET['sDate']);
			
			$sqlSelectPurchase = "SELECT * FROM purchase where customer_uuid = ".$customerid." and createdDate='".$sDate."' ";
		}
		else{
			$sqlSelectPurchase = "SELECT * FROM purchase where customer_uuid = ".$customerid;
		}
	//echo '<br> ---sqlSelect----'.$sqlSelectPurchase;
	$sqlSelectPurchase = $conn->query($sqlSelectPurchase);
	$purchaseDetailsArr = array();
	$index = 0;
	
	
	
		if($sqlSelectPurchase->num_rows > 0){
			
			while($purchaseRow = $sqlSelectPurchase->fetch_assoc()) {
				
				
				$purchaseDetailsArr[$index]['purchaseid'] = $purchaseRow['purchaseid'];
				
				$purchaseDetailsArr[$index]['FirstName'] = $custDetails['firstName'];
				$purchaseDetailsArr[$index]['LastName'] = $custDetails['lastName'];
				
				$product_uuid = $purchaseRow['product_uuid'];
				
				$sqlSelectP = "SELECT * FROM product where productid =".$product_uuid;
				$resultSelectP = $conn->query($sqlSelectP);
				$productArr = array();
				if($resultSelectP->num_rows > 0){
					while($product = $resultSelectP->fetch_assoc()) {
						
						$productArr['productid'] = $product['productid'];
						$productArr['productcode'] = $product['productcode'];
						$productArr['productDescription'] = $product['productDescription'];
						$productArr['productPrice'] = $product['productPrice'];
					}
					
				}
				
				$purchaseDetailsArr[$index]['ProductCode'] = $productArr['productcode'];
				$purchaseDetailsArr[$index]['LastName'] = $custDetails['lastName'];
				$purchaseDetailsArr[$index]['FirstName'] = $custDetails['firstName'];
				$purchaseDetailsArr[$index]['City'] = $custDetails['city'];
				$purchaseDetailsArr[$index]['Message'] = $purchaseRow['comments'];
				$purchaseDetailsArr[$index]['Price'] = $purchaseRow['price'];
				$purchaseDetailsArr[$index]['Quantity'] = $purchaseRow['quantity'];
				$purchaseDetailsArr[$index]['Subtotal'] = $purchaseRow['subtotal'];
				$purchaseDetailsArr[$index]['Taxes'] = $purchaseRow['taxes_amount'];
				$purchaseDetailsArr[$index]['GrandTotal'] = $purchaseRow['grandtotal'];

				
				$index ++;
			}
			   
			echo "<table id ='purchaseTable' > <tr><th>Delete</th><th>Product Code</th><th>First Name</th><th>Last Name</th><th>City</th><th>Comment</th><th>Price</th> <th>Quantity</th><th>Subtotal</th><th>Taxes</th><th>Total</th></tr>";
			
			foreach ($purchaseDetailsArr as $key => $val) {
				echo"<tr>";
				echo "<td><input type='button' value='Delete'  onClick = 'deleteRecord(".$val["purchaseid"].")'></td>";
				echo "<td>".($val["ProductCode"])."</td>";
				echo "<td>".($val["FirstName"])."</td>";
				echo "<td>".($val["LastName"])."</td>";
				echo "<td>".($val["City"])."</td>";
				echo "<td>".($val["Message"])."</td>";
				echo "<td>".($val["Price"])."$"."</td>";
				echo "<td>".($val["Quantity"])."</td>";
				if($val["Subtotal"]<100)
				echo "<td>"."<font color ='red'>".($val["Subtotal"])."$"."</font>"."</td>";
				if($val["Subtotal"]<999.99&&$val["Subtotal"]>=100)
				echo "<td>"."<font color ='#FFA500'>".($val["Subtotal"])."$"."</font>"."</td>";
				if($val["Subtotal"]>1000)
				echo "<td>"."<font color ='green'>".($val["Subtotal"])."$"."</font>"."</td>";
				echo "<td>".($val["Taxes"])."$"."</td>";
				echo "<td>".($val["GrandTotal"])."$"."</td>";
				echo"</tr>";
			}
	   
			echo "</table>";
			
			
		}
	}
	
	
	die();
}

?>