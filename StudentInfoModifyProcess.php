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

if ($studentID == '') 
{ 
?> 
    <form action = "StudentInfoModifyForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
<?php
exit();
}

$stmt = $db -> stmt_init();
$sql = "SELECT * FROM student WHERE studentID = ?";

if (! $stmt -> prepare($sql))
{
    ?>
    <form action = "StudentInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again.</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die($db -> error());
}

$stmt -> bind_param("s", $studentID);
$stmt -> execute();
$result = $stmt -> get_result();

if ($result -> num_rows() > 0)
{
    $result = $result -> fetch_assoc();

    $lastName = $result["lastName"];
    $firstName = $result["firstName"];
    $initials = $result["initials"];
    $major = $result["major"];
    $classification = $result["classification"];
    $advisorID = $result["advisorID"];
    
    echo 
    "
    <html>
    <body>
    <form action = 'StudentInfoModifyScript.php' method = 'post'>
        Student ID: <br>$studentID</br>
            <input type = 'hidden' name = 'studentID' value = '$studentID'>
        <br>
        Last Name:
            <input type = 'text' name = lastName value = '$lastName'>
        First Name:
            <input type = 'text' name = firstName value = '$firstName'>
        Initials:
            <input type = 'text' name = initials value = '$initials'>
        Major:
            <input type = 'text' name = major value = '$major'>
        <label for = 'classification'> Classification </label>
            <select id = 'classification' name = 'classification'> 
                <option value = '$classification' selected>$classification</option>
                <option value = 'Freshman'>Freshman</option>
                <option value = 'Sophomore'>Sophomore</option>
                <option value = 'Junior'>Junior</option>
                <option value = 'Senior'>Senior</option>
                <option value = '5th Year Senior'>5th Year Senior</option>
                <option value = 'Multi-Year Senior'>Multi-Year Senior</option>
            </select>
        Advisor ID: 
           <input type = 'text' name = 'advisorID' value = '$advisorID'>
           <br>
        <input type = 'submit' name = 'submit' value = 'Submit Information'>
        </form>
        </body>
        </html>
        ";
} else 
{
    ?> 
    <form action = "StudentInfoModifyForm.html" method = "post">
        <label>Student record not found; please try again:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
    <?php
    exit();
} 
$db -> close();
?>
<form>
    <br/>
    <label>Modify A Different Record?</label>
</form>
<form action = "StudentInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Different Record" value = "Return To Modify Form"/>
    <br/>
</form>