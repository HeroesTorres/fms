<?php
header("Content-Type: application/json");

// Load the students data
$studentsData = file_get_contents('../data/students.json');
$students = json_decode($studentsData, true);

// Routing
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $student = null;
        foreach ($students as $s) {
            if ($s['id'] === $id) {
                $student = $s;
                break;
            }
        }
        if ($student) {
            echo json_encode($student);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Student not found"]);
        }
    } else {
        // Return all students
        echo json_encode($students);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed"]);
}
?>