<?php
include 'ai-class.php';


if (isset($_SERVER['PHP_AUTH_USER'])==$GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW']==$GLOBALS['tokenvalue']) 
{         
    $response = array();
  
    $table_name = "student";
  
    if(isset($_POST['student_id']) && !empty($_POST['student_id']))
    {                
            $student_id=mysqli_real_escape_string($GLOBALS['con'],$_POST['student_id']); 
                                
           
            if(!check_User($student_id))  // Check in Database User Old Password
            {
                $response["success"] = 0;
                $response["message"] = 'Sorry Student not found';
            }
            else
            {                
                    $update_query="update  $table_name set `is_delete`=1 "
                    ."where student_id='{$student_id}'";


                    // Perform a query, check for error
                    if (!mysqli_query($GLOBALS['con'],$update_query))
                    {
                        $response["success"] = 0;
                        $response["message"] = mysqli_error($GLOBALS['con']);
                        //echo("Error description: " . mysqli_error($con));
                    }
                    else
                    {    
                      //  mysqli_query($GLOBALS['con'],$insert_query);
                        $response["success"] = 1;
                        $response["message"] = "$table_name  deleted successfully.";
                    }
               
            }

                // Print auto-generated id
                 echo json_encode(array("student"=>array($response)));            
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


function check_User($user_id)
{
     $select_query="select student_id from student  where student_id='{$user_id}'";
        
     $result=mysqli_query($GLOBALS['con'],$select_query);
     
     if(!mysqli_num_rows($result))      
     {
         return false;
     }
     else
     {        
         $user_details=mysqli_fetch_assoc($result);             
         if($user_details)
         {
//             echo 'call' ;
//             die();
//             
            return true;                        
         }                           
     }
}

?>
