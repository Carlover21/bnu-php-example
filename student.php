<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Function to generate random UK state
function getRandomUKState() {
    $uk_states = array("England", "Scotland", "Wales", "Northern Ireland");
    return $uk_states[array_rand($uk_states)];
}

// Initialize $selected_students array
$selected_students = [];

// Check if delete button is clicked and checkboxes are selected
if(isset($_POST['delete']) && isset($_POST['student_checkbox'])){
    $selected_students = $_POST['student_checkbox'];
    if(empty($selected_students)){
        echo "Please select at least one student to delete.";
    } else {
        // Prepare SQL statement to delete selected students
        $sql_delete = "DELETE FROM student WHERE studentid IN ('" . implode("','", $selected_students) . "')";

        // Execute delete query
        if ($conn->query($sql_delete) === TRUE) {
            echo "Selected student records deleted successfully.";
        } else {
            echo "Error deleting records: " . $conn->error;
        }
    }
}

// Fetch student records from the database
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// Start HTML output
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Student Records</title>";
// Bootstrap CSS link
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "</head>";
echo "<body>";

// Display delete form
echo "<div class='container'>";
echo "<form method='post'>";
echo "<table class='table'>";
echo "<thead class='table-dark'>";
echo "<tr>";
echo "<th>Select</th>";
echo "<th>Student ID</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>DOB</th>";
echo "<th>House</th>";
echo "<th>Town</th>";
echo "<th>Country</th>";
echo "<th>State</th>";
echo "<th>Postcode</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input class='form-check-input' type='checkbox' name='student_checkbox[]' value='".$row["studentid"]."'></td>";
        echo "<td>" . $row["studentid"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["house"] . "</td>";
        echo "<td>" . $row["town"] . "</td>";
        echo "<td>UK</td>"; // Fixed "Country" column to "UK"
        echo "<td>" . getRandomUKState() . "</td>"; // Generate random UK state for "State" column
        echo "<td>" . $row["postcode"] . "</td>";
        echo "</tr>";
    }
    
    // Display delete button
    echo "<tr><td colspan='11'><button type='submit' name='delete' class='btn btn-danger'>Delete</button></td></tr>";
    
} else {
    echo "<tr><td colspan='11'>No student records found.</td></tr>";
}

// Close table and form
echo "</tbody>";
echo "</table>";
echo "</form>";
echo "</div>";

// Bootstrap JS (Optional, for certain features like dropdowns, modals, etc.)
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>";

// Close database connection
$conn->close();

// Close HTML
echo "</body>";
echo "</html>";
?>
