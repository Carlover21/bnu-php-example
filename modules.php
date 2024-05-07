<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Include header and navigation
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");
?>
<div class="container mt-4">
    <h2 class="text-center mb-4">Modules</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Build SQL statement that selects a student's modules
                $sql = "SELECT * FROM studentmodules sm INNER JOIN module m ON m.modulecode = sm.modulecode WHERE sm.studentid = '" . $_SESSION['id'] . "';";
                $result = mysqli_query($conn, $sql);

                // Display the modules within the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['modulecode'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['level'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    // Include footer
    echo template("templates/partials/footer.php");
} else {
    header("Location: index.php");
}
?>
