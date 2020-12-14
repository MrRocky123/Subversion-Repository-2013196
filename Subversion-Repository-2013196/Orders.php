<?php
session_start();
if(isset($_SESSION['customerid'])) {
}
else{
    echo "<input type='submit' name='logout' value='logout'>";

}
include'../PHPfunctions/Function.php';

createFunctionHeader('Orders Page');

header("Content-type: text/html");

$file = fopen("purchases.txt","r") or die("Error");
$json_data = file_get_contents('purchases.txt');
if ($_SESSION!=NULL){?>

<table>
 
    <tr>
        
        <th>Purchase Code</th>
        
        <th>First Name</th>
        
        <th>Last Name</th>
        
        <th>City</th>
        
        <th>Comment</th>
        
        <th>Price</th>
        
        <th>Quantity</th>
        
        <th>Subtotal</th>

        <th>Taxes</th>
                
        <th>Total</th>
    </tr>    

    <?php
    $jsonIterator =json_decode($json_data, TRUE);
    
    foreach ($jsonIterator as $key => $val) {
        echo"<tr>";
        echo "<td>".($val["ProductCode"])."</td>";
        echo "<td>".($val["FirstName"])."</td>";
        echo "<td>".($val["LastName"])."</td>";
        echo "<td>".($val["City"])."</td>";
        echo "<td>".($val["Message"])."</td>";
        echo "<td>".($val["Price"])."$"."</td>";
        echo "<td>".($val["Quantity"])."</td>";
        if($_GET['command']=='color'||'print'){
        if($val["Subtotal"]<100)
        echo "<td>"."<font color ='red'>".($val["Subtotal"])."$"."</font>"."</td>";
        if($val["Subtotal"]<999.99&&$val["Subtotal"]>=100)
        echo "<td>"."<font color ='#FFA500'>".($val["Subtotal"])."$"."</font>"."</td>";
        if($val["Subtotal"]>1000)
        echo "<td>"."<font color ='green'>".($val["Subtotal"])."$"."</font>"."</td>";
    }

        echo "<td>".($val["Taxes"])."$"."</td>";
        echo "<td>".($val["GrandTotal"])."$"."</td>";
        echo"</tr>";
    }
   
    
       
}?>
</table>
</body>
</html>
    
<a id ="cheet" href="cheat-sheet.txt">Cheat Sheet</a>


<?php


    displayCopyright();
    
    createFunctionFooter();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   