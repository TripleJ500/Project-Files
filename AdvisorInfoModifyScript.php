<!DOCTYPE html>
<html lang = "en">
<h1> Modify Info </h1>
<html>
<meta charset = "UTF-8">
<title>Modify Info</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

<?php
include("inc_db_transactions.php");
$advisorID = isset($_POST['advisorID']) ? $_POST['advisorID'] : NULL;
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : NULL;
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : NULL;
$initials = isset($_POST['initials']) ? $_POST['initials'] : NULL;
$jobTitle = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : NULL;
$department = isset($_POST['department']) ? $_POST['department'] : NULL;

$db -> mysqli_stmt_init();

$sql = "UPDATE advisor SET lastName = ?, firstName = ?, 
        initials = ?, jobTitle = ?, department = ?
        WHERE advisorID = '$advisorID'";

if (! $db -> mysqli_stmt_prepare($sql))
{
    ?>
    <form action = "AdvisorInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again.</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> mysqli_error());
}

$db -> mysqli_stmt_bind_param("sssss", $lastName,
                                       $firstName,
                                       $initials,
                                       $jobTitle,
                                       $department);
$db-> mysqli_stmt_execute();

if ($db -> mysqli_stmt_execute())
{
    echo "Records updated successfully.";
} else{
    echo "Error: " . $sql . "<br>" . $db -> mysqli_error();
}
$db -> mysqli_close();
?>      
<form>
    <br/>
    <label>Modify Another Record??</label>
</form>
<form action = "AdvisorInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Another Record" value = "Return To Modify Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>