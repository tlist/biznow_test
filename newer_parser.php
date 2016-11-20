<?php



function text_file_parser($filename) {
    
    $handle = @fopen($filename, "r");
    if ($handle) {
        //$buffer = fgets($handle, 4096);
        while (($buffer = fgets($handle, 4096)) !== false) {
            // process the line read.
     	    //echo $buffer ."\n";
		    $newString = str_to_address($buffer);
	     	//echo $newString . "\n";
        }		
	fclose($handle);
	}
}

function str_to_address($context) { 
    $newString="";
    $zipValue = "";
    $streetAddressValue = ""; 
    $phoneNumberValue = ""; 
    $emailValue = "";
    $cityName = "";
    $stateValue = "";
    $userName = ""; 
    $userNameFinal = ""; 	
	$potentialUserNameValue = "";
    if($context != "") {
        $address_parts = explode(",", $context);
        //var_dump($address_parts);
		//echo "------------------\n";
		//var_dump($address_space); 
        
		foreach($address_parts as $key=>$str) {
	        $address_piece = explode(" ", $str);
			//var_dump($address_piece);
			//echo "------------------\n";
            //find the state 
			if($address_piece != "") {
			    $stateKey = ""; 
			    foreach($address_piece as $key=>$str) {
				     if(!is_numeric($str) && strlen($str)===2 && strtoupper($str) == $str) {
					     $stateValue = $str; 
					     $stateKey = $key;
					     unset($address_piece[$stateKey]);
					     var_dump($address_piece);
					     //break; 
				    }
			    }
			
			    //echo "stateValue:" . $stateValue . "\n";
			
                //find the zip code
			    $zipKey = ""; 
		        foreach($address_piece as $key=>$str) { 
                    if(strlen($str)===5 && is_numeric($str)) { 
			            $zipValue = $str;  
                        $zipKey = $key;
				        unset($address_piece[$zipKey]);
                    }
                }

	            //echo "zipValue: " . $zipValue . "\n";
         
    		    $streetAddressKey = ""; 
                foreach($address_piece as $key=>$str) { 
                    if(strlen($str)===2 && is_numeric($str)) { 
	                    $streetAddressValue = $str . ' ' . $address_piece[$key+1];
                        unset($address_piece[$key]);
					    unset($address_piece[$key+1]);
					        if($address_piece[$key+2] != ''){
					        $streetAddressValue = $streetAddressValue . ' ' . $address_piece[$key+2]; 
                            unset($address_piece[$key+2]);
					    }
                    }
                }

	            //echo "streetAddressValue: " . $streetAddressValue . "\n"; 
	
                $phoneNumberKey = "";
	            foreach($address_piece as $key=>$str) {
	                if (preg_match('/^\(?[0-9]{3}\)?|[0-9]{3}[-. ]? [0-9]{3}[-. ]?[0-9]{4}$/', $str)&& strlen($str)>5) {
				        $phoneNumberValue = $str; 
				        $phoneNumberKey = $key; 
				        unset($address_piece[$phoneNumberKey]);
			      	    //break; 
			        } 
	            }
	
	            echo "phoneNumberValue: " . $phoneNumberValue . "\n";
	
	            $emailKey = ""; 
	            foreach($address_piece as $key=>$str) {
	                if(preg_match('#^[^\.][\w-\.]{1,64}[^\.]@([\w-\.]*)(\.\w{2,6})$#i', $str)) {
                        $emailValue = $str; 
			            $emailKey = $key;
					    unset($address_piece[$emailKey]);
					    $emailParts = explode("@", $emailValue);
						//var_dump($emailParts);
						//userId
					    $userName = $emailParts[0];
			        }
	            }
	
	             
	            //echo "emailValue: " . $emailValue . "\n";
               // echo "userName: " . $userName . "\n";
				$first = ''; 
				$next = ''; 
				$matchValue = ''; 
		     	foreach($address_piece as $key=>$str) {
			        if(isset($address_piece[$key]) && $str!='') {
						if(!preg_match('/[A-Z]+[a-z]+[0-9]+/',$str)) {
							$first = $str;
                                if(contains($first,$emailValue)) {
								    $firstName = $first; 
							    } else {
								    $cityName = $first; 
							    }                          							
							if(isset($address_piece[$key+1]) && $address_piece[$key+1] != '') {
					            $next = $address_piece[$key+1];
                                if(contains($next,$emailValue)) {
								   $lastName = $next; 
								   $userName = $firstName . ' ' . $lastName;
                                   break;								   
							    } else {
								   $cityName = $cityName . ' ' . $next;
                                   break; 								   
								}
							   }							   
							} else {
								$next = '';
                                 break; 								
							}
							 
						} else if($str=='') {
						      if(isset($address_piece[$key+1]) && $address_piece[$key+1] != '') {
							      $first = $address_piece[$key+1];
                                  if(contains($first,$emailValue)) {
								      $firstName = $first; 
							       } else {
								      $cityName = $first; 
							       }     							
							        if(isset($address_piece[$key+2]) && $address_piece[$key+2] != '') {
								        $next = $address_piece[$key+2];
									    if(contains($next,$emailValue)) {
										    $lastName = $next; 
										    $userName = $firstName . ' ' . $lastName; 
                                            break; 										
									    } else {
										     $cityName = $cityName . ' ' . $next;
										     break; 
								     	}
									}       									
							} else {
								$next = '';
                                break; 								
							}
						}
					}   
		                      				
		    }
			
		}
			    echo "stateValue:"          . $stateValue . "\n";
			    echo "zipValue: "           . $zipValue . "\n";
                echo "phoneNumberValue : "  . $phoneNumberValue . "\n";
				echo "streetAddressValue: " . $streetAddressValue . "\n"; 
                echo "emailValue: "         . $emailValue . "\n";  
				echo "userNameFinal: " . $userName . "\n"; 
				echo "cityName: "     . $cityName . "\n"; 
				
				//write values to the db 
				
				$result = insert_user_info($stateValue,$zipValue,$phoneNumberValue,$streetAddressValue,$emailValue,$userName,$cityName);
	            
				if($result)
				
				return $result; 

 	    }	
    }

/**
* I know the exercise say to write to a Sqlite table, 
* i'm running wamp/mysql on my laptop, and testing 
* using that.  
*
*/

function insert_user_info($stateValue,$zipValue,$phoneNumberValue,$streetAddressValue,$emailValue,$userName,$cityName) {
    $link = new mysqli('localhost','root','','biznow_test');

    if($link->connect_error)
       die('connection error: '.$link->connect_error);

    $sql = "INSERT INTO user_info(user_name, street_address, city, state, zip, phone, email) 
                 VALUES('$userName', '$streetAddressValue', '$cityName', '$stateValue', '$zipValue', '$phoneNumberValue','$emailValue')";

    echo $sql;    

    $result = $link->query($sql); 

    if($result){
	    $link->close();    
        return true; 
	
    }else{
		 $link->close(); 
        return false;  
    }

  
}
	
/**
* Checks to see of a string contains a particular substring
* @param $substring the substring to match
* @param $string the string to search 
* @return true if $substring is found in $string, false otherwise
*/
function contains($substring, $string) {
        $pos = strpos($string, $substring);
 
        if($pos === false) {
                // string needle NOT found in haystack
                return false;
        }
        else {
                // string needle found in haystack
                return true;
        }
 
}	

	
text_file_parser("textparse_exercise.txt");