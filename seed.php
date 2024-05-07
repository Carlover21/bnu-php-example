<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$students = [
    ["20000001", "test", "John", "Doe", "1999-05-15", "123 Main St", "Springfield", "State", "Country", "12345"],
    ["20000002", "test", "Jane", "Smith", "2000-03-20", "456 Elm St", "Riverside", "County", "Country", "23456"],
    ["20000003", "test", "Alice", "Johnson", "1998-12-10", "789 Oak St", "Hilltown", "County", "Country", "34567"],
    ["20000004", "test", "Bob", "Brown", "2001-08-05", "101 Pine St", "Lakeside", "County", "Country", "45678"],
    ["20000005", "test", "Emma", "Davis", "1997-09-25", "202 Maple St", "Meadowview", "County", "Country", "56789"]
];

$sql = "INSERT INTO student (studentid, password, firstname, lastname, DOB, house, town, county, country, postcode) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    foreach ($students as $student) {
        $checkSql = "SELECT studentid FROM student WHERE studentid = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $student[0]);
        $checkStmt->execute();
        $checkStmt->store_result();
        
        if ($checkStmt->num_rows === 0) {
            $stmt->bind_param("ssssssssss", ...$student);
            $stmt->execute();
        } else {
            echo "Student with ID {$student[0]} already exists. Skipping insertion.<br>";
        }
        
        $checkStmt->close();
    }
    
    echo "Student records inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

