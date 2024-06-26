<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Retrieve student information including image path
    $sql = "SELECT * FROM student WHERE studentid='" . $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Display profile picture if available
    if (!empty($row['image'])) {
        echo "<div class='container mt-4 text-center'><img src='uploads/{$row['image']}' alt='Profile Picture' style='max-width: 150px;' class='rounded-circle'></div>";
    }

    // if the form has been submitted
    if (isset($_POST['submit'])) {

        // Check if a file is uploaded
        if (isset($_FILES['updateFile']) && $_FILES['updateFile']['error'] === UPLOAD_ERR_OK) {
            // File upload path
            $uploadDir = "uploads/";
            $uploadedFile = $uploadDir . basename($_FILES['updateFile']['name']);

            // Move uploaded file to the upload directory
            if (move_uploaded_file($_FILES['updateFile']['tmp_name'], $uploadedFile)) {
                // File uploaded successfully, update the database
                $file = basename($_FILES['updateFile']['name']);

                // Build an SQL statement to update the student image
                $sql = "UPDATE student SET image = ? WHERE studentid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $file, $_SESSION['id']);
                $stmt->execute();
                $stmt->close();

                $data['content'] = "<div class='alert alert-success' role='alert'>File updated successfully</div>";
            } else {
                // Error uploading file
                $data['content'] = "<div class='alert alert-danger' role='alert'>Error updating file</div>";
            }
        } else {
            // File not uploaded, update the database without the file name
            $sql = "UPDATE student SET firstname = ?, lastname = ?, house = ?, town = ?, county = ?, country = ?, postcode = ? WHERE studentid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $_POST['txtfirstname'], $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'], $_POST['txtcountry'], $_POST['txtpostcode'], $_SESSION['id']);
            $stmt->execute();
            $stmt->close();

            $data['content'] = "<div class='alert alert-success' role='alert'>Your details have been updated</div>";
        }

    } else {
        // Form for updating student details
        $imagePreview = '';
        if (!empty($row['image'])) {
            $imagePreview = "<img src='uploads/{$row['image']}' alt='Student Image' style='max-width: 200px;'>";
        }

        $data['content'] = <<<EOD
        <div class="container mt-4">
           <h2 class="mb-4">My Details</h2>
           $imagePreview <!-- Display image preview -->
           <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                 <label for="txtfirstname" class="form-label">First Name:</label>
                 <input name="txtfirstname" type="text" class="form-control" value="{$row['firstname']}" required>
              </div>
              <div class="mb-3">
                 <label for="txtlastname" class="form-label">Surname:</label>
                 <input name="txtlastname" type="text" class="form-control" value="{$row['lastname']}" required>
              </div>
              <div class="mb-3">
                 <label for="txthouse" class="form-label">Number and Street:</label>
                 <input name="txthouse" type="text" class="form-control" value="{$row['house']}" required>
              </div>
              <div class="mb-3">
                 <label for="txttown" class="form-label">Town:</label>
                 <input name="txttown" type="text" class="form-control" value="{$row['town']}" required>
              </div>
              <div class="mb-3">
                 <label for="txtcounty" class="form-label">County:</label>
                 <input name="txtcounty" type="text" class="form-control" value="{$row['county']}" required>
              </div>
              <div class="mb-3">
                 <label for="txtcountry" class="form-label">Country:</label>
                 <input name="txtcountry" type="text" class="form-control" value="{$row['country']}" required>
              </div>
              <div class="mb-3">
                 <label for="txtpostcode" class="form-label">Postcode:</label>
                 <input name="txtpostcode" type="text" class="form-control" value="{$row['postcode']}" required>
              </div>
              <!-- Add file input for image -->
              <div class="mb-3">
                 <label for="file" class="form-label">Upload Image:</label>
                 <input type="file" id="file" name="file" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Save</button>
           </form>
        </div>
EOD;
    }

    // render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
