<?php
include 'ai-class.php';


if (isset($_SERVER['PHP_AUTH_USER'])==$GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW']==$GLOBALS['tokenvalue']) 
{         
    $response = array();
    $table_name = "student";
    
    if(isset($_POST['student_name']) && !empty($_POST['student_name']) &&
       isset($_POST['student_mobile']) && !empty($_POST['student_mobile']) &&
       isset($_POST['student_address']) && !empty($_POST['student_address']))
     {         
            $student_name=mysqli_real_escape_string($GLOBALS['con'],$_POST['student_name']);      
            $student_mobile=mysqli_real_escape_string($GLOBALS['con'],$_POST['student_mobile']);                  
            $student_address=mysqli_real_escape_string($GLOBALS['con'],$_POST['student_address']);              
            
            $insert_query="INSERT INTO $table_name(`student_name`, `student_mobile`, `student_address`) "
                    . " VALUES('{$student_name}','{$student_mobile}','{$student_address}')";

            // Perform a query, check for error
            if (!mysqli_query($GLOBALS['con'],$insert_query))
            {
                $response["success"] = 0;
                $response["message"] = mysqli_error($GLOBALS['con']);
                //echo("Error description: " . mysqli_error($con));
            }
            else
            {    
                mysqli_query($GLOBALS['con'],$insert_query);
                
                $response["success"] = 1;
                $response["message"] = "$table_name table record inserted successfully.";
            }

            // Print auto-generated id
             echo json_encode($response);
            
    }
    else
    {
             $response["success"] = 0;
             $response["message"] = "Required field(s) is missing";             
             
             // Print auto-generated id
             echo json_encode($response);        
    }
}
else
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Sorry You Are not Allow to access';
    exit;   
}

?>
