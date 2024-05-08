<?php

// Function to generate a 9-digit primary key
function generatePrimaryKey() {
    return mt_rand(100000000, 999999999);
}

// Function to hash the password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to validate email address
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate phone number (assuming UK phone number format)
function isValidPhone($phone) {
    return preg_match("/^(\+44|0)\d{10}$/", $phone);
}

// Function to validate password (at least 8 characters, containing at least one uppercase letter, one lowercase letter, one number, and one special character)
function isValidPassword($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "rayan";
$password = ""; // No password in this case
$dbname = "oss-cw2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $studentid = generatePrimaryKey();
    $dob = $_POST['dob'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $house = $_POST['house'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];

    if (empty($dob) || empty($firstname) || empty($lastname) || empty($house) || empty($town) || empty($county) || empty($country) || empty($postcode)) {
        $errors[] = "All fields are required";
    }

    if (empty($errors)) {
        // Prepare SQL statement to insert student details
        $sql = "INSERT INTO student (studentid, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sssssssss", $studentid, $dob, $firstname, $lastname, $house, $town, $county, $country, $postcode);

        // Execute statement
        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>New student record created successfully</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        // Close statement
        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
    }
}

// Close connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h2 class="mb-4">Add Student</h2>
        <form name="frmdetails" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID:</label>
                <input type="text" name="studentid" class="form-control" readonly value="<?php echo generatePrimaryKey(); ?>">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="house" class="form-label">House/Flat Number:</label>
                <input type="text" name="house" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town/City:</label>
                <input type="text" name="town" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County:</label>
                <input type="text" name="county" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" name="country" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" name="postcode" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>

</body>

</html>
