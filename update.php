<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

// Check if required keys exist
if (isset($data['id'], $data['sname'], $data['srole'], $data['scity'], $data['sstate'], $data['snumber'], $data['semail'])) {
    
    include "config.php";

    // Check database connection
    if (!$conn) {
        echo json_encode(['Code' => '500', 'status' => 'unsuccessful', 'message' => 'Database connection failed.']);
        exit;
    }

    // Sanitize inputs
    $id = intval($data['id']); // Convert to integer for safety
    $name = mysqli_real_escape_string($conn, $data['sname']);
    $role = mysqli_real_escape_string($conn, $data['srole']);
    $city = mysqli_real_escape_string($conn, $data['scity']);
    $state = mysqli_real_escape_string($conn, $data['sstate']);
    $number = mysqli_real_escape_string($conn, $data['snumber']);
    $email = mysqli_real_escape_string($conn, $data['semail']);

    // Check current data for the student
    $currentSql = "SELECT student_name, role, city, state, number, email FROM student WHERE id = $id";
    $currentResult = mysqli_query($conn, $currentSql);
    
    if ($currentResult && mysqli_num_rows($currentResult) > 0) {
        $currentData = mysqli_fetch_assoc($currentResult);
        
        // Compare the current data with the new data
        if ($currentData['student_name'] === $name && 
            $currentData['role'] === $role && 
            $currentData['city'] === $city && 
            $currentData['state'] === $state && 
            $currentData['number'] === $number && 
            $currentData['email'] === $email) {
                
            echo json_encode(['Code' => '200', 'status' => 'unchanged', 'message' => 'Student record is already up-to-date.']);
            exit;
        }
    }

    // Prepare the SQL statement for updating
    $sql = "UPDATE student SET 
            student_name = '$name', 
            role = '$role', 
            city = '$city', 
            state = '$state', 
            number = '$number', 
            email = '$email' 
            WHERE id = $id";

    try {
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
                // Prepare response with updated student details
                $updatedStudent = [
                    'id' => $id,
                    'student_name' => $name,
                    'role' => $role,
                    'city' => $city,
                    'state' => $state,
                    'number' => $number,
                    'email' => $email
                ];
                echo json_encode(['Code' => '200', 'status' => 'successful', 'message' => 'Student record updated successfully.', 'student' => $updatedStudent]);
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
