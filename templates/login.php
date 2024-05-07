<?php
// Database connection
include("_includes/config.inc");
include("_includes/dbconnect.inc");

// Initialize message variable
$message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $studentId = $_POST['txtid'];
    $password = $_POST['txtpwd'];

    // Prepare SQL statement with parameters
    $sql = "SELECT * FROM users WHERE student_id = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $studentId, $password);

    // Execute query
    $stmt->execute();

    // Store result
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // User found, redirect to dashboard or home page
        // For example:
        header("Location: dashboard.php");
        exit();
    } else {
        // User not found, display error message
        $message = "Invalid student ID or password.";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center mb-4">Login</h2>
            <!-- Display login failed message if present -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <!-- Login form -->
            <form name="frmLogin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="txtid" class="form-label">Student ID:</label>
                    <input name="txtid" type="text" class="form-control" id="txtid" required>
                </div>
                <div class="mb-3">
                    <label for="txtpwd" class="form-label">Password:</label>
                    <input name="txtpwd" type="password" class="form-control" id="txtpwd" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="btnlogin">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
