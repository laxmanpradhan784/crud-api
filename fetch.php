<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include "config.php"; // Include your database configuration

// Check database connection
if (!$conn) {
    echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database connection failed.']);
    exit;
}

// Construct the SQL query to fetch all records
$sql = "SELECT * FROM student";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Fetch all records
if ($result) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the results
    if ($students) {
        echo json_encode(['Code' => '200', 'status' => 'successful', 'students' => $students]);
    } else {
        echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No records found.']);
    }
} else {
    echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database query error.']);
}

// Close the database connection
$conn->close();
?>
