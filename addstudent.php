<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles can be added here */
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Add Student</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID:</label>
                <input type="text" id="studentid" name="studentid" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" id="firstname" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" id="lastname" name="lastname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">DOB:</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="house" class="form-label">House:</label>
                <input type="text" id="house" name="house" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="town" class="form-label">Town:</label>
                <input type="text" id="town" name="town" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="county" class="form-label">County:</label>
                <input type="text" id="county" name="county" class="form-control" required>
            </div>

            <!-- Renamed "Country" label to "State" -->
            <div class="mb-3">
                <label for="state" class="form-label">State:</label>
                <input type="text" id="state" name="state" class="form-control" required>
            </div>

            <!-- Changed the input type to text to allow free text entry -->
            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" id="country" name="country" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" id="postcode" name="postcode" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional, for certain features like dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
