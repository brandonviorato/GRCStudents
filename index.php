<?php
/* 328/GRCStudents/index.php
 *
 */

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

echo "<h1>Student List</h1>";
echo "<a href='addStudent.php'>Add a student</a>";

// PDO
// SElECT multiple rows Query
// 1. Define the query
$sql = "SELECT * FROM student ORDER BY `last`";

// 2. Prepare the statement
$statement = $dbh->prepare($sql);

// 3. Execute the query
$statement->execute();

// 4. Process the result
$count = 1;
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    echo "<p>" . $count++ . ". " . $row['last'] . ", " . $row['first'] . "</p>";
}

