<?php
$host = "localhost";
$user = "root";
$password = "Password123!";
$DBName = "transactions"; 

// Create a mysqli object that can be used by other PHP process files.
$db = new mysqli($host, $user, $password);

if ($db->connect_error)
{
    echo "<p>Connection error: " . $db->connect_error . "</p>\n";
} else {
    if (! $db->select_db($DBName)) 
    {
        echo "<p>Could not select the \"$DBName\" " . "database: " . $db->error . "</p>\n";
        $db->close(); 
        $db = FALSE;
    }
}
?>