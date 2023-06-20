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

$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : NULL;
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : NULL;
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : NULL;
$initials = isset($_POST['initials']) ? $_POST['initials'] : NULL;
$major = isset($_POST['major']) ? $_POST['major'] : NULL;
$classification = isset($_POST['classification']) ? $_POST['classification'] : NULL;
$advisorID = isset($_POST['advisorID']) ? $_POST['advisorID'] : NULL;

$stmt = $db -> stmt_init();

$sql = "UPDATE student SET lastName = ?, firstName = ?, initials = ?, major = ?,
        classification = ?, advisorID = ? WHERE studentID = '$studentID'";

if (! $stmt -> prepare($sql))
{
    ?>
    <form action ="StudentInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> error());
}

$stmt -> bind_param("ssssss", $lastName
                            , $firstName
                            , $initials
                            , $major
                            , $classification
                            , $advisorID);
$stmt -> execute();

if ($stmt -> execute())
{
    echo "Records updated successfully.";
} else{
    echo "Error: " . $sql . "<br>" . $db -> error();
}
$db -> close();
?>      
<form>
    <br/>
    <label>Modify Another Record??</label>
</form>
<form action = "StudentInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Another Record" value = "Return To Modify Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>