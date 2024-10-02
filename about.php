<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff;

        }

        .info-container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .info-title {
            text-align: center;
            margin-bottom: 30px;
            color: #fd7e14;

        }

        .info-item {
            font-size: 1.2em;
            margin-bottom: 10px;
            border-bottom: 2px solid #28a745;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="info-container">
                    <h1 class="info-title">User Information</h1>
                    <div class="info-item">
                        <strong>Name:</strong> <?php echo $_SESSION['name']; ?>
                    </div>
                    <div class="info-item">
                        <strong>Phone Number:</strong> <?php echo $_SESSION['pnumber']; ?>
                    </div>
                    <div class="info-item">
                        <strong>Email:</strong> <?php echo $_SESSION['email']; ?>
                    </div>
                    <div class="info-item">
                        <strong>Gender:</strong> <?php echo $_SESSION['gender']; ?>
                    </div>
                    <div class="info-item">
                        <strong>Country:</strong> <?php echo $_SESSION['country']; ?>
                    </div>
                    <div class="info-item">
                        <strong>Skills:</strong>
                        <?php
                        foreach ($_SESSION['skills'] as $skill) {
                            if ($skill != "None") {
                                echo $skill . ", ";
                            }
                        }
                        ?>
                    </div>
                    <div class="info-item">
                        <strong>Biography:</strong> <?php echo $_SESSION['biography']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>