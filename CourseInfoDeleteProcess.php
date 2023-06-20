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
$coursePrefix = isset($_POST['coursePrefix']) ? $_POST['coursePrefix'] : NULL;

if ($coursePrefix == NULL)
{
    $sql = "DELETE FROM course";
    $query = $db -> mysqli_query($sql);

    if ($query)
    {
        echo "Records successfully deleted.";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $db -> mysqli_error();
    }
    $db -> mysqli_close();
} else
{
    $sql = "DELETE FROM course WHERE coursePrefix = '$coursePrefix'";
    $query = $db -> mysqli_query($sql);

    if ($query)
    {
        echo "Record successfully deleted.";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $db -> mysqli_error();
    }
    $db -> mysqli_close();
}
?>      
<form>
    <br/>
    <label>Delete Another Record?</label>
</form>
<form action = "CourseInfoDeleteForm.html" method = "post">
    <input type = "submit" name = "Delete Another Record" value = "Return To Delete Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>