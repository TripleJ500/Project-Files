<!DOCTYPE html>
<html lang = "en">
<h2> Search Result </h2>
<html>
<meta charset = "UTF-8">
<title>Search Results</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</html>

<?php
include("inc_db_transactions.php");
echo " <table border = 10 cellspacing = 1 cellpadding = 2><tr align = 'center'>";
$ID = isset($_POST['advisorID']) ? $_POST['advisorID'] : NULL;
$response = isset($_POST['response']) ? $_POST['response'] : NULL;

if ($ID == '' && $response == 0) 
{ 
?> 
    <form action = "AdvisorInfoQueryForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value="Return To Last Page" />
    </form>
<?php
exit();
}

if ($ID != '' && $response == 1)
{
?>
    <form action = "AdvisorInfoQueryForm.html" method = "post">
        <label>You cannot search for a specific record and show all records at the same time.</label> 
            <input type = "submit" name = "return" value="Return To Last Page" />
    </form>
<?php
die(mysqli_error($db));
}

$sql;
$query;

if ($response == 1)
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
}

else
{
    $i = 0;
    $statement = mysqli_stmt_init($db);
    $sql = "SELECT * FROM advisor WHERE advisorID = ?";   

    if (! mysqli_stmt_prepare($statement, $sql))
    {
    ?>
        <form action = "AdvisorInfoQueryForm.html" method = post>
            <label> Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
    <?php
        die(mysqli_error($db));
    }

    $headers = array("Advisor ID", "Last Name", "First Name", "Initials",
                        "Job Title", "Department");
    echo '<table style = "width:150%">';
    echo nl2br("<b>\nAdvisor's Info:</b>");
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    mysqli_stmt_bind_param($statement, "s", $ID);
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
    echo"</table>";
    echo nl2br("<b>\nStudents advised by this advisor:</b>");

    $i = 0;
    $sql = "SELECT studentID, lastName, firstName, major,
            classification FROM student WHERE advisorID = ?";   

    if (! mysqli_stmt_prepare($statement, $sql))
    {
    ?>
        <form action = "AdvisorInfoQueryForm.html" method = post>
            <label> Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
    <?php
        die(mysqli_error($db));
    }

    $headers = array("Student ID", "Last Name", "First Name", "Major    ",
                        "Classification");
    echo '<table style = "width:150%">';
    while($i < count($headers))
    {
        $columnInfo = current($headers);
        echo '<th>' .  $columnInfo . '</th>';
        next($headers);
        $i = $i + 1;
    }

    mysqli_stmt_bind_param($statement, "s", $ID);
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
}
?>
    </body>
        <form>
            <br/>
            <label>Do Another Search?</label>
        </form>
        <form action = "AdvisorInfoQueryForm.html" method = "post">
            <input type = "submit" name = "Add Another Record" value = "Return To Search Form"/>
            <br/>
        </form>
        <form action = "MainMenu.html" method = "post">
            <input type = "submit" name = "Return to Menu" value = "Return to Main Menu"/>
        </form>
</html>