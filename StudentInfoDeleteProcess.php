<!DOCTYPE html>
<html lang = "en">
<h1> Delete Info </h1>
<html>
<meta charset = "UTF-8">
<title>Delete Info</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

<?php
include("inc_db_transactions.php");
$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : NULL;

if ($studentID == NULL)
{
    $sql = "DELETE FROM student";
    $query = $db -> query($sql);

    if ($query)
    {
        echo "Records successfully deleted.";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $db -> error();
    }
    $db -> close();
} else
{
    $sql = "DELETE FROM student WHERE studentID = '$studentID'";
    $query = $db -> query($sql);

    if ($query)
    {
        echo "Record successfully deleted.";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $db -> error();
    }
    $db -> close();
}
?>      
<form>
    <br/>
    <label>Delete Another Record?</label>
</form>
<form action = "StudentInfoDeleteForm.html" method = "post">
    <input type = "submit" name = "Delete Another Record" value = "Return To Delete Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>