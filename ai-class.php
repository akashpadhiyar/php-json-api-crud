<?php
global  $tokenname,$tokenvalue,$con;
  
// for webservice 
$tokenname ='tokenname';
$tokenvalue='tokenvalue';
$con=mysqli_connect("localhost","root","","mysqli-api");   // connection string



function check_connection()
{ 
    // Check connection
    if (mysqli_connect_errno($GLOBALS['con']))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error($GLOBALS['con']);
    }    
}

//Check Connection Function Called
check_connection();

