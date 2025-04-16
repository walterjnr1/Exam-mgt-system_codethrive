<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign Up</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .signup-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.2);
        }
        .signup-card h3 {
            color: #333;
            margin-bottom: 20px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #6a11cb;
        }
        .btn-primary {
            background: #6a11cb;
            border: none;
        }
        .btn-primary:hover {
            background: #2575fc;
        }
    </style>
</head>
<body>

<div class="signup-card">
    <h3 class="text-center">Student Sign Up</h3>

    <form action="register_student.php" method="POST">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="firstName" required>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="lastName" required>
        </div>

        <div class="mb-3">
            <label for="admissionNo" class="form-label">Admission Number</label>
            <input type="text" name="admission_no" class="form-control" id="admissionNo" required>
        </div>

        <div class="mb-3">
            <label for="className" class="form-label">Class</label>
            <select name="class_id" id="className" class="form-select" required>
                <option value="">Select Class</option>
                <option value="1">SS1</option>
                <option value="2">SS2</option>
                <option value="3">SS3</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" id="dob" required>
        </div>

        <div class="mb-3">
            <label for="emailAddress" class="form-label">Email (optional)</label>
            <input type="email" name="email" class="form-control" id="emailAddress">
        </div>

        <button type="submit" class="btn btn-primary w-100">Create Account</button>
    </form>
</div>

<!-- Bootstrap 5 JS (optional for dropdown animations) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
