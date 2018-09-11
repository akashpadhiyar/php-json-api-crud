<?php
include 'ai-class.php';


if (isset($_SERVER['PHP_AUTH_USER'])==$GLOBALS['tokenname'] && $_SERVER['PHP_AUTH_PW']==$GLOBALS['tokenvalue']) 
{         
    $response = array();
    $table_name = "student";
  
    $response[$table_name] = array();
            
        
            $select_query="select * from $table_name  where is_active=1 and is_delete=0 order by student_name";
            $result=mysqli_query($GLOBALS['con'],$select_query);
            
            // Perform a query, check for error
            if (!mysqli_query($GLOBALS['con'],$select_query))
            {
                $response["success"] = 0;
                $response["message"] = mysqli_error($GLOBALS['con']);
                //echo("Error description: " . mysqli_error($con));
            }
            else
            {                                
                // Fetch all
               // $response[$table_name]= mysqli_fetch_all($result,MYSQLI_ASSOC);                               
                
                    $data = [];
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    $response[$table_name]=$data;
            }   
            
            echo json_encode($response);               
}
else
{
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Sorry You Are not Allow to access';
    exit;   
}

?>
