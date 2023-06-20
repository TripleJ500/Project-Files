<!DOCTYPE html>
<html>
    <head>
        <title>Advisor Information</title>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    </head>
</html>

<?php
include("inc_db_transactions.php");
$ID = $_POST['ID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$initials = $_POST['initials'];
$jobTitle = $_POST['jobTitle'];
$department = $_POST['department'];
$submit = $_POST['submit'];

if ($ID == '' ||
    $firstName == '' || 
    $lastName == '' || 
    $initials == '' || 
    $jobTitle == '' || 
    $department == 0) { 
?>
    <form action = "AdvisorInfoAddForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value="Return To Last Page" />
    </form>
<?php
    exit();
}

$sql = "INSERT INTO advisor (advisorID, 
                             lastName, 
                             firstName, 
                             initials, 
                             jobTitle, 
                             department)
        VALUES (?, ?, ?, ?, ?, ?)";

$statement = mysqli_stmt_init($db);

if(! mysqli_stmt_prepare($statement, $sql))
{
    ?>
    <form action = "AdvisorInfoAddForm.html" method = "post">
        <label>Faulty Statement, Please Try Again.</label>
            <input type = "submit" name = "Return" value = "Return To Form" />
    </form>
    <?php
    die(mysqli_error($db));
}

mysqli_stmt_bind_param($statement, "ssssss",
                       $ID,
                       $lastName,
                       $firstName,
                       $initials,
                       $jobTitle,
                       $department);

mysqli_stmt_execute($statement);

echo "The Record Has Been Saved."
?>

<form>
    <br/>
    <label>Add Another Record?</label>
</form>
<form action = "AdvisorInfoAddForm.html" method = "post">
        <input type = "submit" name = "Add Another Record" value = "Return To Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
        <input type = "submit" name = "Return to Menu" value = "Return Home"/>
</form>