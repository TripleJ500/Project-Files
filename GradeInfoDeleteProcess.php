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
$gradeID = isset($_POST['gradeID']) ? $_POST['gradeID'] : NULL;

if ($gradeID == NULL)
{
    $sql = "DELETE FROM grade";
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
    $sql = "DELETE FROM grade WHERE gradeID = '$gradeID'";
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
<form action = "GradeInfoDeleteForm.html" method = "post">
    <input type = "submit" name = "Delete Another Record" value = "Return To Delete Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>