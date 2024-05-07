<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $studentId = $_SESSION['id'];
      $moduleCode = $_POST['selmodule'];
      
      // Check if the entry already exists
      $checkSql = "SELECT * FROM studentmodules WHERE studentid = '$studentId' AND modulecode = '$moduleCode'";
      $checkResult = mysqli_query($conn, $checkSql);
      
      if(mysqli_num_rows($checkResult) > 0) {
         // Entry already exists, show error message
         $data['content'] .= "<div class='alert alert-warning' role='alert'>The module $moduleCode has already been assigned to you.</div>";
      } else {
         // Entry does not exist, insert into the database
         $sql = "INSERT INTO studentmodules VALUES ('$studentId', '$moduleCode')";
         $result = mysqli_query($conn, $sql);
         if ($result) {
            $data['content'] .= "<div class='alert alert-success' role='alert'>The module $moduleCode has been assigned to you.</div>";
         } else {
            $data['content'] .= "<div class='alert alert-danger' role='alert'>An error occurred while assigning the module. Please try again.</div>";
         }
      }
   }
   else  // If a module has not been selected
   {

     // Build SQL statement that selects all the modules
     $sql = "SELECT * FROM module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<div class='container mt-4'>";
     $data['content'] .= "<form name='frmassignmodule' action='' method='post' >";
     $data['content'] .= "<label for='selmodule' class='form-label'>Select a module to assign</label><br/>";
     $data['content'] .= "<select name='selmodule' class='form-select'>";
     // Display the module names in a dropdown selection box
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br/>";
     $data['content'] .= "<button type='submit' name='confirm' class='btn btn-primary'>Save</button>";
     $data['content'] .= "</form>";
     $data['content'] .= "</div>";
   }

   // Render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
