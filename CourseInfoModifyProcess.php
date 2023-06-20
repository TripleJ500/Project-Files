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
$coursePrefix = isset($_POST['coursePrefix']) ? $_POST['coursePrefix'] : NULL;

if ($coursePrefix == '') 
{ 
?> 
    <form action = "CourseInfoModifyForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page" />
    </form>
<?php
exit();
}

$stmt = $db -> stmt_init();
$sql = "SELECT * FROM course WHERE coursePrefix = ?";

if (! $stmt -> prepare($sql))
{
    ?>
    <form action = "CourseInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> mysqli_error());
}

$stmt -> bind_param("s", $coursePrefix);
$stmt -> execute();
$result = $stmt -> get_result();

if (mysqli_num_rows($result) > 0)
{
    $result = mysqli_fetch_assoc($result);
    $courseName = $result["courseName"];
    $creditHours = $result["creditHours"];
    
    echo 

    "
    <html>
    <body>
    <form action = 'CourseInfoModifyScript.php' method = 'post'>
        Course Prefix: <br>$coursePrefix</br>
            <input type = 'hidden' name = 'coursePrefix' maxlength = '9' value = '$coursePrefix'>
        <br>
        Course Name:
            <input type = 'text' name = courseName maxlength = '50' value = '$courseName'>
        Credit Hours:
        <select id = 'creditHours' name = 'creditHours'> 
            <option value = '$creditHours' selected>$creditHours</option>
            <option value = '0'></option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            <option value = '6'>6</option>
        </select>
        <input type = 'submit' name = 'submit' value = 'Submit Information'>
        </form>
        </body>
        </html>
        ";
} else 
{
    echo "Course Not Found. Please Try Again.";
}
$db -> mysqli_close();
?>
<form>
    <br/>
    <label>Modify A Different Record?</label>
</form>
<form action = "CourseInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Different Record" value = "Return To Modify Form"/>
    <br/>
</form>