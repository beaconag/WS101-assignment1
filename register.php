<?php
session_start();

$nameErr = $phoneErr = $emailErr = $passwordErr = $cpasswordErr = "";
$genErr = $countryErr = $skillsErr = $bgraphyErr = " ";

if (isset($_POST['register'])) {

    function sanitizeData($data)
    {
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    $name = sanitizeData($_POST['name']);
    $pnumber = sanitizeData($_POST['pnumber']);
    $email = sanitizeData($_POST['email']);
    $pwd = sanitizeData($_POST['password']);
    $cpass = sanitizeData($_POST['cpassword']);
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $skills = $_POST['skills'];
    $bgraphy = sanitizeData($_POST['biography']);

    $error = false;

    if (empty($name)) {
        $nameErr = "Name is required";
        $error = true;
    } else if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
        $nameErr = "Only letters and spaces are allowed";
        $error = true;
    } else {
        $_SESSION['name'] = $name;
    }

    if (empty($pnumber)) {
        $phoneErr = "Phone number is required";
        $error = true;
    } elseif (!preg_match("/^[0-9]{10,15}+$/", $pnumber)) {
        $phoneErr = "Phone number must be numeric and valid";
        $error = true;
    } else {
        $_SESSION['pnumber'] = $pnumber;
    }

    if (empty($email)) {
        $emailErr = "Email is required";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $error = true;
    } else {
        $_SESSION['email'] = $email;
    }

    if (empty($pwd)) {
        $passwordErr = "Password is required";
        $error = true;
    } elseif (strlen($pwd) < 8 || !preg_match("/[A-Z]/", $pwd) || !preg_match("/[0-9]/", $pwd)) {
        $passwordErr = "Password must be at least 8 characters long, with at least 1 uppercase letter and 1 number.";
        $error = true;
    } else {
        $_SESSION['password'] = $pwd;
    }

    if (empty($cpass)) {
        $cpasswordErr = "Confirmation password is required";
        $error = true;
    } elseif ($pwd !== $cpass) {
        $cpasswordErr = "Passwords do not match";
        $error = true;
    } else {
        $_SESSION['cpassword'] = $cpass;
    }

    if ($gender == "None") {
        $genErr = "Gender is required";
        $error = true;
    } else {
        $_SESSION["gender"] = $gender;
    }

    if (empty($country)) {
        $countryErr = "Country is required";
        $error = true;
    } else {
        $_SESSION['country'] = $country;
    }

    if (count($skills) == 1) {
        $skillsErr = "At least 1 skill must be selected";
        $error = true;
    } else {
        $_SESSION["skills"] = $skills;
    }

    if (empty($bgraphy)) {
        $bgraphyErr = "Biography is required";
        $error = true;
    } elseif (strlen($bgraphy) > 200) {
        $bgraphyErr = "Biography must be less than 200 characters";
        $error = true;
    } else {
        $_SESSION['biography'] = $bgraphy;
    }

    if ($error == false) {
        header("Location: about.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff;
            /* 60% Blue */
        }

        .form-container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #fd7e14;
            /* 10% Orange */
        }

        .error {
            color: red;
            font-size: 0.9em;
        }

        .form-control {
            border: 1px solid #28a745;
            /* 30% Green */
        }

        .form-container input[type="submit"] {
            background-color: #fd7e14;
            /* 10% Orange */
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #e76400;
        }

        .form-container select,
        .form-container textarea,
        .form-container input[type="text"],
        .form-container input[type="password"] {
            border: 1px solid #28a745;
            /* 30% Green */
        }

        .form-container select:focus,
        .form-container textarea:focus,
        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
            border-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h1 class="form-title">Register</h1>
                    <form action="" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                            <span class="error"><?php echo $nameErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="pnumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="pnumber" placeholder="Enter phone number">
                            <span class="error"><?php echo $phoneErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                            <span class="error"><?php echo $emailErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="error"><?php echo $passwordErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm password">
                            <span class="error"><?php echo $cpasswordErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" name="gender" value="None" hidden checked>
                            <input type="radio" name="gender" value="Female"> Female
                            <input type="radio" name="gender" value="Male"> Male
                            <br>
                            <span class="error"><?php echo $genErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country" class="form-select">
                                <option value="" selected>Select Country</option>
                                <option value="Canada">Canada</option>
                                <option value="USA">USA</option>
                                <option value="Japan">Japan</option>
                                <option value="UK">UK</option>
                                <option value="Hongkong">Hongkong</option>
                            </select>
                            <span class="error"><?php echo $countryErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills</label><br>
                            <input type="checkbox" name="skills[]" value="None" hidden checked>
                            <input type="checkbox" name="skills[]" value="C++"> C++
                            <input type="checkbox" name="skills[]" value="Java"> Java
                            <input type="checkbox" name="skills[]" value="Python"> Python
                            <br>
                            <span class="error"><?php echo $skillsErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="biography" class="form-label">Biography</label>
                            <textarea class="form-control" name="biography" rows="3"></textarea>
                            <span class="error"><?php echo $bgraphyErr; ?></span>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="register" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>