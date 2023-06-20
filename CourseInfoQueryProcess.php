<!DOCTYPE html>
<html lang = "en">
<h2> Search Result </h2>
<html>
<meta charset = "UTF-8">
<title>Search Results</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    
<?php
include("inc_db_transactions.php");
echo "<table border = 10 cellspacing = 1 cellpadding = 2><tr align = 'center'>";
$ID = isset($_POST['coursePrefix']) ? $_POST['coursePrefix'] : NULL;
$response = isset($_POST['response']) ? $_POST['response'] : NULL;

if ($ID == '' && $response == 0) 
{ 
?> 
    <form action = "CourseInfoQueryForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page" />
    </form>
<?php
    exit();
}

if ($ID != '' && $response == 1)
{
?>
    <form action = "CourseInfoQueryForm.html" method = "post">
        <label>You cannot search for a specific record and show all records at the same time.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
<?php
    die();
}

if ($response == 1)
{
    $i = 0;
    $sql = "SELECT student.lastName, student.firstName, student.major, grade.studentID, 
            coursePrefix, semester, grade FROM student RIGHT JOIN grade 
            ON student.studentID = grade.studentID";
    $query = $db -> query($sql);
    $headers = array("Last Name", "First Name", "Major", "Student ID",
                        "Course Prefix", "Semester", "Grade");
    echo '<table style = "width:150%">';
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    $i2 = 0;

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
    }
    echo "</table>";
}

else
{
    $i = 0;
    $stmt = $db -> stmt_init();
    $sql = "SELECT student.lastName, student.firstName, student.major, grade.studentID, 	   
            course.coursePrefix, course.courseName, grade.semester, grade.grade, 	   
            course.creditHours FROM student JOIN grade ON student.studentID = grade.studentID
            JOIN course ON course.coursePrefix = grade.coursePrefix WHERE grade.coursePrefix = ?";   

    if ($stmt -> prepare($sql))
    {
    ?>
        <form action = "CourseInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
    <?php
        die($db -> error());
    }

    $headers = array("Last Name", "First Name", "Major", "Student ID",
                        "Course Prefix", "Course Name", "Semester", "Grade", "Credit Hours");
    echo '<table style = "width:150%">';
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    $stmt -> bind_param("s", $ID);
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
}
?>

<form>
    <br/>
    <label>Do Another Search?</label>
</form>
<form action = "CourseInfoQueryForm.html" method = "post">
    <input type = "submit" name = "Add Another Record" value = "Return To Search Form"/>
    <br/>
</form>
<form action = "MainMenu.html" method = "post">
    <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
</form>
