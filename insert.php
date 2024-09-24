<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Check if required keys exist
if (isset($data['sname'], $data['srole'], $data['scity'], $data['sstate'], $data['snumber'], $data['semail'])) {
    
    include "config.php";

    // Check database connection
    if (!$conn) {
        echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database connection failed.']);
        exit;
    }

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $data['sname']);
    $role = mysqli_real_escape_string($conn, $data['srole']);
    $city = mysqli_real_escape_string($conn, $data['scity']);
    $state = mysqli_real_escape_string($conn, $data['sstate']);
    $number = mysqli_real_escape_string($conn, $data['snumber']);
    $email = mysqli_real_escape_string($conn, $data['semail']);

    // Simple SQL query
    $sql = "INSERT INTO student (student_name, role, city, state, number, email, create_date_time) 
            VALUES ('$name', '$role', '$city', '$state', '$number', '$email', NOW())";

    try {
        if (mysqli_query($conn, $sql)) {
            // Get the last inserted ID
            $lastId = $conn->insert_id;

            // Prepare a response with the inserted student details
            $response = [
                'Code' => '200',
                'status' => 'successful',
                'student' => [
                    'id' => $lastId,
                    'student_name' => $name,
                    'role' => $role,
                    'city' => $city,
                    'state' => $state,
                    'number' => $number,
                    'email' => $email,
                ]
            ];
            echo json_encode($response);
        } else {
            // Custom error handling for duplicate email
            if (mysqli_errno($conn) == 1062) { // MySQL error code for duplicate entry
                echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Email already exists.']);
            } else {
                echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred: ' . mysqli_error($conn)]);
            }
        }
    } catch (Exception $e) {
        echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'An error occurred.']);
    }

} else {
    echo json_encode(['Code' => '400', 'status' => 'unsuccessful', 'message' => 'Invalid input.']);
}

$conn->close();
?>
