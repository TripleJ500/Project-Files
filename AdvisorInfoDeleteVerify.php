<!DOCTYPE html>
<html lang = "en">
<h1> Delete Info </h1>
<html>
<meta charset = "UTF-8">
<title>Delete Info</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

<?php
include("inc_db_transactions.php");
$advisorID = isset($_POST['advisorID']) ? $_POST['advisorID'] : NULL;
$response = isset($_POST['response']) ? $_POST['response'] : NULL;

if ($advisorID == '' && $response == 0) 
{ 
?> 
    <form action = "AdvisorInfoDeleteForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
<?php
exit();
}
if ($advisorID != '' && $response == 1) 
{ 
?> 
    <form action = "AdvisorInfoDeleteForm.html" method = "post">
        <label>Please enter an Advisor ID OR delete all records:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
<?php
exit();
}

if ($advisorID == NULL)
{
    $i = 0;
    $sql = "SELECT * FROM advisor";
    $query = mysqli_query($db, $sql);
    $headers = array("Advisor ID", "Last Name", "First Name", "Initials",
                     "Job Title", "Department");
    echo '<table style = "width:150%">';

    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    while($row = mysqli_fetch_row($query))
    {
        echo '<tr align = "center">';
        $count = count($row);
        $y = 0;
        while($y < $count)
        {
            $c_row = current($row);
            if ($c_row == NULL){echo '<td> N/A </td>';}
            else
                echo '<td>' . $c_row . '</td>';
            next($row);
            $y = $y + 1;
        }
        echo '</tr>';
        next($row);
    }
    echo "</table>";
    echo
    "
    <form action = 'AdvisorInfoDeleteProcess.php' method = 'post'>
        <label for = 'yes'> Are you SURE you want to delete all records?: </label>
            <input type = 'submit' id = 'yes' name = 'yes' value = 'Yes'>
    </form>
    <form action = 'AdvisorInfoDeleteForm.html' method = 'post'>
            <input type = 'submit' id = 'no' name = 'no' value = 'No'> 
    </form>
    ";
    exit();
} else
{
    $i = 0;
    $statement = mysqli_stmt_init($db);
    $sql = "SELECT * FROM advisor WHERE advisorID = ?";
    $headers = array("Advisor ID", "Last Name", "First Name", "Initials",
                     "Job Title", "Department");
    echo '<table style = "width:150%">';

    if (! mysqli_stmt_prepare($statement, $sql))
    {
    ?>
        <form action = "AdvisorInfoDeleteForm.html" method = post>
            <label> Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
    <?php
        die(mysqli_error($db));
    }
    
    echo '<table style = "width:150%">';
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    mysqli_stmt_bind_param($statement, "s", $advisorID);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    while($array = mysqli_fetch_assoc($result))
    {
        echo '<tr align = "center">';
        $count = count($array);
        $y = 0;
        while($y < $count)
        {
            $c_row = current($array);
            if ($c_row == NULL){echo '<td> N/A </td>';}
            else
                echo '<td>' . $c_row . '</td>';
            next($array);
            $y = $y + 1;
        }
        echo '</tr>';
    }
    echo "</table>";
    echo
    "
    <form action = 'AdvisorInfoDeleteProcess.php' method = 'post'>
        <label for = 'yes'> Are you sure you want to delete this record?: </label>
            <input type = 'hidden' id = 'yes' name = 'advisorID' value = '$advisorID'>
            <input type = 'submit' id = 'yes' name = 'response' value = 'Yes'>
    </form>
    <form action = 'AdvisorInfoDeleteForm.html' method = 'post'>
            <input type = 'submit' id = 'no' name = 'no' value = 'No'> 
    </form>
    ";
    exit();
}