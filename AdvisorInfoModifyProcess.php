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
$advisorID = isset($_POST['ID']) ? $_POST['ID'] : NULL;

if ($advisorID == '') 
{ 
?> 
    <form action = "AdvisorInfoModifyForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
<?php
exit();
}

$statement = mysqli_stmt_init($db);
$sql = "SELECT * FROM advisor WHERE advisorID = ?";

if (! mysqli_stmt_prepare($statement, $sql))
{
    ?>
    <form action = "AdvisorInfoModifyForm.html" method = "post">
        <label>Faulty Statement, Please Try Again.</label>
            <input type = "submit" name = "Return" value = "Return To Form"/>
    </form>
    <?php
    die(mysqli_error($db));
}

mysqli_stmt_bind_param($statement, "s", $advisorID);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

if (mysqli_num_rows($result) > 0)
{
    $result = mysqli_fetch_assoc($result);
    $lastName = $result["lastName"];
    $firstName = $result["firstName"];
    $initials = $result["initials"];
    $jobTitle = $result["jobTitle"];
    $department = $result["department"];
    
    echo 
    "
    <html>
    <body>
    <form action = 'AdvisorInfoModifyScript.php' method = 'post'>
        Advisor ID: <br>$advisorID</br>
            <input type = 'hidden' name = 'advisorID' value = $advisorID>
        <br>
        Last Name:
            <input type = 'text' name = lastName value = '$lastName'>
        First Name:
            <input type = 'text' name = firstName value = '$firstName'>
        Initials:
            <input type = 'text' name = initials value = '$initials'>
        Job Title:
            <input type = 'text' name = jobTitle value = '$jobTitle'>
        Department
            <input type = 'text' name = department value = '$department'>
        <input type = 'submit' name = 'submit' value = 'Submit Information'>
        </form>
        </body>
        </html>
        ";
} else 
{
    ?> 
    <form action = "AdvisorInfoModifyForm.html" method = "post">
        <label>Advisor record not found; please try again:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page" />
    </form>
    <?php
}
mysqli_close($db);
?>
<form>
    <br/>
    <label>Modify A Different Record?</label>
</form>
<form action = "AdvisorInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Different Record" value = "Return To Modify Form"/>
    <br/>
</form>