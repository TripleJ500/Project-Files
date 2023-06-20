<!DOCTYPE html>
<html>
    <head>
        <title>Course Information</title>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    </head>
</html>

<?php
include("inc_db_transactions.php");
$coursePrefix = $_POST['coursePrefix'];
$courseName = $_POST['courseName'];
$creditHours = $_POST['creditHours'];
$submit = $_POST['submit'];

if ($coursePrefix == '' ||
    $courseName == '' || 
    $creditHours == '0') { 
?> 
    <form action = "CourseInfoAddForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
<?php
exit();
}


$sql = "INSERT INTO course (coursePrefix, 
                            courseName, 
                            creditHours)
        VALUES (?, ?, ?)";

$db -> mysqli_stmt_init();

if(! $db -> mysqli_stmt_prepare($sql))
{
    ?>
    <form action = "CourseInfoAddForm.html" method = "post">
        <label> Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> mysqli_error());
}

$db -> mysqli_stmt_bind_param("ssi",
                              $coursePrefix,
                              $courseName,
                              $creditHours);

$db -> mysqli_stmt_execute();

echo "The Record Has Been Saved"
?>

<form>
    <br/>
    <label>Add Another Record?</label>
</form>
<form action = "CourseInfoAddForm.html" method = "post">
        <input type = "submit" name = "Add Another Record" value = "Return To Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
        <input type = "submit" name = "Return to Menu" value = "Return Home"/>
</form>