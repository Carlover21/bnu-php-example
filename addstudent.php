<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Custom CSS for styling */
        body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Student</h2>
        <form id="studentForm" action="process_student.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="house">House:</label>
                        <input type="text" id="house" name="house" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="town">Town:</label>
                        <input type="text" id="town" name="town" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="county">County:</label>
                        <input type="text" id="county" name="county" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery (for Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Client-side validation for email and phone number
        $(document).ready(function() {
            $('#studentForm').submit(function() {
                var email = $('#email').val();
                var phone = $('#phone').val();

                if (!validateEmail(email)) {
                    alert('Invalid email address');
                    return false;
                }

                if (!validatePhone(phone)) {
                    alert('Invalid phone number');
                    return false;
                }

                return true;
            });

            function validateEmail(email) {
                // Regular expression for email validation
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }

            function validatePhone(phone) {
                // Regular expression for UK phone number validation
                var re = /^(\+44|0)\d{10}$/;
                return re.test(phone);
            }
        });
    </script>
</body>
</html>
