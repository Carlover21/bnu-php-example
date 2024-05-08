<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Retrieve form data
$studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$DOB = $_POST["dob"];
$house = mysqli_real_escape_string($conn, $_POST['house']);
$town = mysqli_real_escape_string($conn, $_POST['town']);
$county = mysqli_real_escape_string($conn, $_POST['county']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

// Prepare SQL statement
$sql = "INSERT INTO student (studentid, password, firstname, lastname, DOB, house, town, county, country, postcode) 
    VALUES ('$studentid', '$password', '$firstname', '$lastname', '$DOB', '$house', '$town', '$county', '$country', '$postcode')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "New student record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
