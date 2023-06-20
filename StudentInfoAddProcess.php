<!DOCTYPE html>
<html>
    <head>
        <title>Student Information</title>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    </head>
</html>

<?php
include("inc_db_transactions.php");
$ID = $_POST['studentID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$initials = $_POST['initials'];
$major = $_POST['major'];
$classification = $_POST['class'];
$advisorID = $_POST['advisorID'];
$submit = $_POST['submit'];

if ($ID == '' ||
    $firstName == '' || 
    $lastName == '' || 
    $initials == '' || 
    $major == '' || 
    $classification == '' ||
    $advisorID =='') 
{ 
    ?> 
    <form action = "StudentInfoAddForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    exit();
}

$sql = "INSERT INTO student (studentID, 
                             lastName, 
                             firstName, 
                             initials, 
                             major, 
                             classification,
                             advisorID)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $db -> stmt_init();

if(!$stmt -> prepare($sql))
{
    ?>
    <form action = "StudentInfoAddForm.html" method = "post">
        <label>Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> error());
}

$stmt -> bind_param("sssssss", $ID,
                                $lastName,
                                $firstName,
                                $initials,
                                $major,
                                $classification,
                                $advisorID);

$stmt -> execute();

echo "The Record Has Been Saved."
?>
<html>
    <footer> 
        <form>
            <br/>
            <label>Add Another Record?</label>
        </form>
        <form action = "StudentInfoAddForm.html" method = "post">
            <input type = "submit" name = "Add Another Record" value = "Return To Form"/>
            <br/>
        </form>
        <form action = "MainMenu.html" method = post>
            <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
        </form>
    </footer>
<html>