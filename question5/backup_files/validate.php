<?php
// Fetching Values from URL.
$number2 = $_POST['number1'];
echo $number2; 
$result = '';

$link = new mysqli('localhost','root','','biznow_test');

if($link->connect_error)
    die('connection error: '.$link->connect_error);

    if(is_digit($number2)) {
	    $result = multiPlex($number2); 	
		$isNumber = true; 
	    $sql = "insert into tracking(number,isNumber,result) values ('$number2','$isNumber','$result')"; //Insert Query
    } else if(!is_digit($number2)) {
		$result = "Not a Number"; 
		$number2 = 0; 
		$isNumber = false; 
		$sql = "insert into tracking(number,isNumber,result) values('$number2','$isNumber','$result')";//Insert Query
    }
	echo $sql;
	$result = $link->query($sql); 

   
   if($result){
	    $link->close();
   } else {
	   echo "Error Inserting into the Database\n";
   } 
            
function is_digit($element) {
	$isNumber = false; 
	if(is_numeric($element)) {
	    if($element >= 1 && $element <= 1000) {
			$isNumber = true;
			echo "Is Digit\n";
            return $isNumber; 			
		} else {
			echo "Not a Digit\n";
			return $isNumber; 
	   }
    } else {
		
		return $isNumber; 
	}	   
} 

function multiPlex($element) {
	   $result = "";
       if($element%3==0 && $element%5==0) {
			$result = "Biznow Media"; 
			return $result; 
		} else if($element%3==0 && $element%5!=0) {
			$result = "Biznow";
			return $result; 
		} else if($element%3!=0 && $element%5==0) {
			$result = "Media";
			return $result; 
		}
		
}

?>