<?php
if (empty($_POST)) {
    $form = '
        <form action="addStudent.php" method="post">
        <h1>Add a new Student</h1>
        <label for="sid">SID</label>
        <input type="number" name="sid">
        <br>
        <label for="first">First</label>
        <input type="text" name="first">
        <br>
        <label for="last">Last</label>
        <input type="text" name="last">
        <br>
        <label for="birthdate">Birthdate</label>
        <input type="date" name="birthdate">
        <br>
        <label for="gpa">GPA</label>
        <input type="number" name="gpa">
        <br>
        <label for="advisor">Advisor</label>
        <input type="number" name="advisor">
        <br>
        <input type="submit">
        </form>
    ';
    echo $form;

}
else {
    // Turn on error reporting
    ini_set('display_errors', 1 );
    error_reporting(E_ALL);

    require_once ($_SERVER['DOCUMENT_ROOT'].'/../config.php');

    try {
        // Instantiate our PDO database object
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        // echo 'Connected to database!!!!';
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    // PDO
    // get form data
    $sid = $_POST['sid'];
    $last = $_POST['last'];
    $first = $_POST['first'];
    $birthdate = $_POST['birthdate'];
    $gpa = $_POST['gpa'];
    $advisor = $_POST['advisor'];

    // 1. Define the query
    $sql = 'INSERT INTO student (sid, last, first, birthdate, gpa, advisor)
        VALUES (:sid, :last, :first, :birthdate, :gpa, :advisor)';

    // 2. Prepare the statement
    $statement = $dbh->prepare($sql);

    // 3. Bind the parameters
    $statement->bindParam(':sid', $sid);
    $statement->bindParam(':last', $last);
    $statement->bindParam(':first', $first);
    $statement->bindParam(':birthdate', $birthdate);
    $statement->bindParam(':gpa', $gpa);
    $statement->bindParam(':advisor', $advisor);

    // 4. Execute the query
    if ($statement->execute()) {
        echo "<p>Student $sid was inserted successfully!</p>";
        echo '<a href="index.php">Home</a>';
    } else {
        echo "<p>Error inserting student $sid</p>";
        echo '<a href="index.php">Home</a>';
    }
}
