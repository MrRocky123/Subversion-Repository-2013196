<?php 
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
define("TAXES",0.1250);

class customer{
private $fName;
private $lName;
private $city;
private $province;
private $pCode;
private $uName;
private $password;
//variable to store error message
public $productcodeErrorMessage=""; 
public $FirstNameErrorMessage="";  
public $LastNameErrorMessage=""; 
public $CityErrorMessage="";
public $MessageErrorMessage = "";
public $PriceErrorMessage = ""; 
public $QuantityErrorMessage = "";
public $TaxesErrorMessage = "";

function __constuct(){


}
function validate(){
    $error=0;
    
    
    //validation of productcode
    
    if(mb_strlen($productcode) > PRODUCTCODE_MAX_LENGTH){
        $productErrorMessage = "The productcode cannot contain more than"  . PRODUCTCODE_MAX_LENGTH  . "characters";$error=1;
        
          
    }
     else{
            if(mb_strlen(productcode) == 0){
             $productcodeErrorMessage = "The productcode cannot be empty";$error=1;
             
         }

         
    }    
    
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
    if(mb_strlen($City) > LASTNAME_MAX_LENGTH){
        $CityErrorMessage = "The LastName cannot contain more than" . LASTNAME_MAX_LENGTH . "characters";  $error=1;
}else{
        if(mb_strlen($City) == 0){
             $CityErrorMessage = "The City cannot be empty"; $error=1;
            }     }  
         
    
    
    //validation of comment
    if(mb_strlen($Message) < MESSAGE_MIN_LENGTH || mb_strlen($Message) > MESSAGE_MAX_LENGTH){
        $MessageErrorMessage = "The comment section must contain  the character between "  . MESSAGE_MIN_LENGTH. "and" . MESSAGE_MAX_LENGTH ."."; $error=1;
    }
    
    //validation of Price
    if(is_numeric($Price)&&$Price < PRICE_MIN_LENGTH || $Price > PRICE_MAX_LENGTH){
        $PriceErrorMessage = "The Price must contain  the number between "  . Price_MIN_LENGTH. "and" . Price_MAX_LENGTH ."."; $error=1;
    }else{
        if(mb_strlen($Price) == 0){
            $PriceErrorMessage = "The Price cannot be empty"; $error=1;
        }
    }
     
    if(is_numeric($Quantity) && $Quantity < QUANTITY_MIN_LENGTH  || $Quantity > QUANTITY_MAX_LENGTH){
      $QuantityErrorMessage = "The Quantity must contain  the number between "  . Quantity_MIN_LENGTH. "and" . QUANTITY_MAX_LENGTH.".";   $error=1;
      
    } else{
        if(mb_strlen($Quantity) == 0){
         $QuantityErrorMessage = "The Quantity cannot be empty";     
        }
    }        
return $error;
}


}