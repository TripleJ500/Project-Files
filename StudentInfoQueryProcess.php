<!DOCTYPE html>
<html lang = "en">
<h2> Search Result </h2>
<html>
<meta charset = "UTF-8">
<title>Search Results</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</html>
    
<?php
include("inc_db_transactions.php");

echo "<table border = 10 cellspacing = 1 cellpadding = 2><tr align = 'center'>";
$ID = isset($_POST['studentID']) ? $_POST['studentID'] : NULL;
$class = isset($_POST['class']) ? $_POST['class'] : NULL;
$major = isset($_POST['major']) ? $_POST['major'] : NULL;
$response = isset($_POST['response']) ? $_POST['response'] : NULL;

if ($ID == '' &&
    $class == '' &&
    $major == '' && 
    $response == 0) 
{ 
    ?> 
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value="Return To Last Page" />
    </form>
    <?php
    die();
}

if ($response == 1 && $major != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}

if ($response == 1 && $class != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}
if ($response == 1 && $ID != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}
if ($ID != NULL && $major != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}
if ($ID != NULL && $class != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}
if ($class != NULL && $major != NULL)
{
    ?>
    <form action = "StudentInfoQueryForm.html" method = "post">
        <label>You must chose only one method for searching records.</label> 
            <input type = "submit" name = "return" value="Return To Last Page"/>
    </form>
    <?php
    die();
}

$stmt = $db -> stmt_init();

if ($response == 1)
{
    $i = 0;
    $sql = "SELECT * FROM student";
    $query = $db -> query($sql);
    $headers = array("Student ID"
                    ,"Last Name"
                    ,"First Name"
                    ,"Initials"
                    ,"Major"
                    ,"Classification"
                    ,"Advisor ID");
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
    }
    echo "</table>";
} elseif($class != NULL)
{
    $i = 0;
    $sql = "SELECT * FROM student WHERE classification = ?";   

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "StudentInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }

    $headers = array("Student ID"
                    ,"Last Name"
                    ,"First Name"
                    ,"Initials"
                    ,"Major"
                    ,"Classification"
                    ,"Advisor ID");
        echo '<table style = "width:150%">';

    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    $stmt -> bind_param("s", $class);
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
elseif($major != NULL)
{
    $i = 0;
    $sql = "SELECT * FROM student WHERE major = ?";   

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "StudentInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }

    $headers = array("Student ID"
                    ,"Last Name"
                    ,"First Name"
                    ,"Initials"
                    ,"Major"
                    ,"Classification"
                    ,"Advisor ID");
    
    echo '<table style = "width:150%">';
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    $stmt -> bind_param("s", $major);
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
else
{
    $i = 0;
    $sql = "SELECT * FROM student WHERE studentID = ?";   

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "StudentInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }
    $headers = array("Student ID"
                    ,"Last Name"
                    ,"First Name"
                    ,"Initials"
                    ,"Major"
                    ,"Classification"
                    ,"Advisor ID");
    
    echo '<table style = "width:150%">';
    echo nl2br("<b>\nStudent Information:</b>");

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
    echo nl2br("<b>\nCourses taken by this student:</b>");
    $i = 0;
    $sql = "SELECT grade.gradeID, grade.coursePrefix, course.courseName, 
            course.creditHours, grade.semester FROM grade JOIN course 
            ON course.coursePrefix = grade.coursePrefix WHERE studentID = ?";   

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "StudentInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }
    $headers = array("Grade ID"
                    ,"Course Prefix"
                    ,"Course Name"
                    ,"Credit Hours"
                    ,"Semester");
    
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

    $sql = "SELECT student.studentID, SUM(course.creditHours) AS 'Total Credit Hours'
            FROM student RIGHT JOIN grade ON student.studentID = grade.studentID
            JOIN course ON course.coursePrefix = grade.coursePrefix 
            WHERE student.studentID = ? GROUP BY student.studentID";
    
    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "StudentInfoQueryForm.html" method = "post">
            <label>Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }
    
    $stmt -> bind_param("s", $ID);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $array = $result -> fetch_assoc();

    echo nl2br("<b>\nTotal Credit Hours Taken by This Student:</b>");
    
    if($array != NULL){
        echo '
        <table style = "width:100%">
            <th> Student ID </th>
            <th> Total Credit Hours </th>
            <tr align  = "center">
            <td>' . current($array) . '</td>
            <td>' . next($array) . '</td>
        </table>
        ';
    } else {
        echo '
        <table style = "width:100%">
            <th> Student ID </th>
            <th> Total Credit Hours </th>
            <tr align  = "center">
            <td> N/A </td>
            <td> N/A </td>
        </table>
        ';
    }

}
?>
<html>
<form>
    <br>
    <label>Do Another Search?</label>
</form>
<form action = 'StudentInfoQueryForm.html' method = 'post'>
    <input type = 'submit' name = 'Add Another Record' value = 'Return To Search Form'/>
    <br/>
</form>
<form action = 'MainMenu.html' method = 'post'>
    <input type = 'submit' name = 'Return to Menu' value = 'Return to Main Menu'/>
</form>
</html>