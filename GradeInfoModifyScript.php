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
$gradeID = isset($_POST['gradeID']) ? $_POST['gradeID'] : NULL;
$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : NULL;
$coursePrefix = isset($_POST['coursePrefix']) ? $_POST['coursePrefix'] : NULL;
$semester = isset($_POST['semester']) ? $_POST['semester'] : NULL;
$grade = isset($_POST['grade']) ? $_POST['grade'] : NULL;

$stmt = $db -> stmt_init();

$sql = "UPDATE grade SET semester = ?, grade = ?
        WHERE gradeID = '$gradeID'";

if (! $stmt -> prepare($sql))
{
    ?>
    <form action ="CourseInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> error());
}

$stmt -> bind_param("sd", $semester, $grade);
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
<form action = "GradeInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Another Record" value = "Return To Modify Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>