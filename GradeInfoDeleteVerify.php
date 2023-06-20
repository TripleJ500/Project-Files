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
$gradeID = isset($_POST['gradeID']) ? $_POST['gradeID'] : NULL;
$response = isset($_POST['response']) ? $_POST['response'] : NULL;

if ($gradeID == '' && $response == 0) 
{ 
    ?> 
    <form action = "GradeInfoDeleteForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
    <?php
exit();
}
if ($gradeID != '' && $response == 1)
{ 
    ?> 
    <form action = "GradeInfoDeleteForm.html" method = "post">
        <label>Please either enter a Grade ID OR Student ID and Coure Prefix OR delete all records.:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page"/>
    </form>
    <?php
exit();
}

if ($gradeID == NULL)
{
    $i = 0;
    $sql = "SELECT * FROM grade";
    $query = $db -> query($sql);
    $headers = array("Grade ID", "Student ID", "Course Prefix", "Semester", "Grade");
    echo '<table style = "width:150%">';

    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    while($row = $query -> fetch_row())
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
    <html>
    <body>
        <form action = 'GradeInfoDeleteProcess.php' method = 'post'>
            <label for = 'yes'> Are you sure you want to delete all records in this table?: </label>
                <input type = 'submit' id = 'yes' name = 'yes' value = 'Yes'>
        </form>
        <form action = 'GradeInfoDeleteForm.html' method = 'post'>
                <input type = 'submit' id = 'no' name = 'no' value = 'No'> 
    </body>
    </html>
    ";
    exit();
} else
{
    $i = 0;
    $stmt = $db -> stmt_init();
    $sql = "SELECT * FROM grade WHERE gradeID = ?";
    $headers = array("Grade ID", "Student ID", "Course Prefix", "Semester", "Grade");
    echo '<table style = "width:150%">';

    if (! $stmt -> prepare($sql))
    {
    ?>
        <form action = "GradeInfoDeleteForm.html" method = post>
            <label> Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
    <?php
        die($db -> error());
    }
    
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    $stmt -> bind_param("s", $gradeID);
    $stmt -> execute();
    $result = $stmt -> get_result();

    while($array = $result -> fetch_assoc())
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
    <html>
    <body>
        <form action = 'GradeInfoDeleteProcess.php' method = 'post'>
            <label for = 'yes'> Are you sure you want to delete this record?: </label>
                <input type = 'hidden' id = 'yes' name = 'gradeID' value = '$gradeID'>
                <input type = 'submit' id = 'yes' name = 'response' value = 'Yes'>
        </form>
        <form action = 'GradeInfoDeleteForm.html' method = 'post'>
                <input type = 'submit' id = 'no' name = 'no' value = 'No'> 
    </body>
    </html>
    ";
    exit();
}