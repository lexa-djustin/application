<?php

require_once 'Autoloader.php';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerObject = new \Components\Register();
    $errors = [];
    $params = [];

    $params['username'] = trim($_POST["username"]);
    if (empty($params['username'])) {
        $errors['username'] = "Please enter a username.";
    }

    $params['email'] = trim($_POST["email"]);
    if (empty($params['email'])) {
        $errors['email'] = "Please enter a email.";
    } elseif ($registerObject->isEmailExist(trim($_POST["email"]))) {
        $errors['email'] = "This email is already taken.";
    }

    $params['department'] = trim($_POST["department"]);
    if (empty($params['department'])) {
        $errors['department'] = "Please enter a department.";
    }

    $params['password'] = trim($_POST["password"]);
    if (empty($params['password'])) {
        $errors['password'] = "Please enter a password.";
    } elseif (strlen($params['password']) < 6) {
        $errors['password'] = "Password must have atleast 6 characters.";
    }

    $params['confirm_password'] = trim($_POST["confirm_password"]);
    if (empty($params['confirm_password'])) {
        $errors['confirm_password'] = "Please confirm password.";
    } else {
        if (empty($errors['confirm_password']) && ($params['password'] != $params['confirm_password'])) {
            $errors['confirm_password'] = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($errors)) {
        $result = $registerObject->register($params);
        if ($result->getStatus() == 1) {
            header("location: login.php");
        } else {
            $errors = $result->getMessages();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($errors['username'])) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $params['username'] ?>">
            <span class="help-block"><?= $errors['username'] ?></span>
        </div>
        <div class="form-group <?= (!empty($errors['email'])) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?= $params['email'] ?>">
            <span class="help-block"><?= $errors['email'] ?></span>
        </div>
        <div class="form-group <?php echo (!empty($errors['department'])) ? 'has-error' : ''; ?>">
            <label>Department</label>
            <input type="text" name="department" class="form-control" value="<?= $params['department'] ?>">
            <span class="help-block"><?= $errors['department'] ?></span>
        </div>
        <div class="form-group <?php echo (!empty($errors['password'])) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?= $params['password'] ?>">
            <span class="help-block"><?= $errors['password']; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($errors['confirm_password'])) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control"
                   value="<?= $params['confirm_password'] ?>">
            <span class="help-block"><?= $errors['confirm_password']; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>