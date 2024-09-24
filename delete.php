<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Check if the required key exists
if (isset($data['id'])) {
    
    include "config.php";

    // Check database connection
    if (!$conn) {
        echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database connection failed.']);
        exit;
    }

    // Sanitize the input
    $id = intval($data['id']); // Convert to integer for safety

    // Prepare the SQL statement
    $sql = "DELETE FROM student WHERE id = $id";

    try {
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                echo json_encode(['Code' => '200', 'status' => 'successful', 'message' => 'Student record deleted successfully.']);
            } else {
                echo json_encode(['Code' => '404', 'status' => 'unsuccessful', 'message' => 'No record found with the given ID.']);
            }
        } else {
            echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred: ' . mysqli_error($conn)]);
        }
    } catch (Exception $e) {
        echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred.']);
    }

} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

$conn->close();
?>
