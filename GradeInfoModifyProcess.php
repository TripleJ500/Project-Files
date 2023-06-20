<!DOCTYPE html>
<html lang = "en">
<h1> Modify Info </h1>
<html>
<meta charset = "UTF-8">
<title>Modify Info</title>
<meta name = "viewport" content = "width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">

<?php
$gradeID = isset($_POST['gradeID']) ? $_POST['gradeID'] : NULL;
$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : NULL;
$coursePrefix = isset($_POST['coursePrefix']) ? $_POST['coursePrefix'] : NULL;

if ($gradeID == '' && $studentID == '' && $coursePrefix == '') 
{ 
    ?> 
    <form action = "GradeInfoModifyForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page" />
    </form>
    <?php
exit();
}

if ($studentID == '' || $coursePrefix == '') 
{ 
    ?> 
    <form action = "GradeInfoModifyForm.html" method = "post">
        <label>You are missing information. Please fill out every field:</label> 
            <input type = "submit" name = "return" value = "Return To Last Page" />
    </form>
    <?php
exit();
}

$stmt = $db -> stmt_init();

if ($gradeID == NULL)
{
    $sql = "SELECT * FROM grade WHERE studentID = ? AND coursePrefix = ?";

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "GradeInfoModifyForm.html" method = "post">
            <label>Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }

    $stmt -> bind_param("ss", $studentID, $coursePrefix);
    $stmt -> execute();
    $result =$stmt -> get_result();

    if ($result -> num_rows() > 0)
    {
        $result = $result -> fetch_assoc($result);
        $gradeID = $result["gradeID"];
        $semester = $result["semester"];
        $grade = $result["grade"];
        echo 

        "
        <html>
        <body>
        <form action = 'GradeInfoModifyScript.php' method = 'post'>
            Grade ID: <br>$gradeID</br>
                <input type = 'hidden' name = 'gradeID' value = '$gradeID'>
            Student ID: <br>$studentID</br>
                <input type = 'hidden' name = 'studentID' value = '$studentID'>
            <br>
            Course Name (Prefix): <br>$coursePrefix</br>
                <input type = 'hidden' name = 'coursePrefix' value = '$coursePrefix'>
            <br>
            <label for = 'semester'> Semester: </label>
            <br>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = '$semester' checked> $semester </input>
                    <br>
                </label
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Fall'> Fall </input> 
                    <br>
                </label>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Spring'> Spring </input>
                    <br>
                </label>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Summer'> Summer </input>
                    <br>
                </label>
                <br>
                <br>
            <label for = 'grade'> Grade: </label>
                <input type = 'number' id = 'grade' name = 'grade' min = '0' max = '120' step = '0.01' value = '$grade'>
            <input type = 'submit' name = 'submit' value = 'Submit Information'>
            </form>
            </body>
            </html>
            ";
    } else 
    {
        ?> 
        <form action = "GradeInfoModifyForm.html" method = "post">
            <label>Grade record not found; please try again:</label> 
                <input type = "submit" name = "return" value = "Return To Last Page" />
        </form>
    <?php
    }
    $db -> close();
} else
{
    $sql = "SELECT * FROM grade WHERE gradeID = ?";

    if (! $stmt -> prepare($sql))
    {
        ?>
        <form action = "GradeInfoModifyForm.html" method = "post">
            <label>Faulty Statement, Please Try Again</label>
                <input type = "submit" name = "Return" value = "Return To Form"/>
        </form>
        <?php
        die($db -> error());
    }

    $stmt -> bind_param("s", $gradeID);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if ($result -> num_rows() > 0)
    {
        $result = $result -> fetch_assoc();
        $studentID = $result["studentID"];
        $coursePrefix = $result["coursePrefix"];
        $semester = $result["semester"];
        $grade = $result["grade"];
        echo 

        "
        <html>
        <body>
        <form action = 'GradeInfoModifyScript.php' method = 'post'>
            Grade ID: <br>$gradeID</br>
                <input type = 'hidden' name = 'gradeID' value = '$gradeID'>
            <br>
            Student ID: <br>$studentID</br>
                <input type = 'hidden' name = 'studentID' value = '$studentID'>
            <br>
            Course Name (Prefix): <br>$coursePrefix</br>
                <input type = 'hidden' name = 'coursePrefix' value = '$coursePrefix'>
            <br>
            <label for = 'semester'> Semester: </label>
            <br>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = '$semester' checked> $semester </input>
                    <br>
                </label
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Fall'> Fall </input> 
                    <br>
                </label>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Spring'> Spring </input>
                    <br>
                </label>
                <label>
                    <input type = 'radio' id = 'semester' name = 'semester' value = 'Summer'> Summer </input>
                    <br>
                </label>
                <br>
                <br>
            <label for = 'grade'> Grade: </label>
                <input type = 'number' id = 'grade' name = 'grade' min = '0' max = '120' step = '0.01' value = '$grade'>
            <input type = 'submit' name = 'submit' value = 'Submit Information'>
            </form>
            </body>
            </html>
            ";
    } else 
    {
        ?> 
        <form action = "GradeInfoModifyForm.html" method = "post">
            <label>Grade record not found; please try again:</label> 
                <input type = "submit" name = "return" value = "Return To Last Page" />
        </form>
    <?php
    }
    $db -> close();
}
?>
<form>
    <br/>
    <label>Modify A Different Record?</label>
</form>
<form action = "GradeInfoModifyForm.html" method = "post">
    <input type = "submit" name = "Modify Different Record" value = "Return To Modify Form"/>
    <br/>
</form>