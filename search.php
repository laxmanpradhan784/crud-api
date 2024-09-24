<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check if the search parameter is provided
if (isset($data['search'])) {
    include "config.php"; // Include your database configuration

    // Check database connection
    if (!$conn) {
        echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database connection failed.']);
        exit;
    }

    // Sanitize the input
    $search = mysqli_real_escape_string($conn, $data['search']);
    
    // Construct the SQL query for the student table
    $sql = "SELECT * FROM student WHERE id = '$search' OR student_name LIKE '%$search%'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Fetch matching records
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

} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

// Close the database connection
$conn->close();
?>
