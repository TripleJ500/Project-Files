<!DOCTYPE html>
<html>
    <head>
        <title>Grade Information</title>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    </head>
</html>

<?php
include("inc_db_transactions.php");
$studentID = $_POST['studentID'];
$coursePrefix = $_POST['coursePrefix'];
$semester = $_POST['semester'];
$grade = $_POST['grade'];
$submit = $_POST['submit'];

if ($studentID == '' ||
    $coursePrefix == '' || 
    $semester == '' ||
    $grade == '0') 
{ 
    ?>
    <form action = "GradeInfoAddForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php    
    exit();
}

$sql = "INSERT INTO grade (studentID, 
                           coursePrefix, 
                           semester,
                           grade)
        VALUES (?, ?, ?, ?)";

$stmt = $db -> stmt_init();

if(! $stmt -> prepare($sql))
{
    ?>
    <form action = "GradeInfoAddForm.html" method = "post">
        <label> Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> error());
}

$stmt -> bind_param("sssd", $studentID,
                            $coursePrefix,
                            $semester,
                            $grade);

$stmt -> execute();

echo "The Record Has Been Saved"
?>
<form>
    <br/>
    <label>Add Another Record?</label>
</form>
<form action = "GradeInfoAddForm.html" method = "post">
        <input type = "submit" name = "Add Another Record" value = "Return To Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
        <input type = "submit" name = "Return to Menu" value = "Return Home"/>
</form>