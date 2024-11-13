<?php
session_start();
require_once('../config.php'); 
$errors = array('password' => '', 'username' => '');

if(isset($_POST['submit'])){
    // Sanitize input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate inputs
    if(empty($username)){
        $errors['username'] = 'Username is required!';
    }
    
    if(empty($password)){
        $errors['password'] = 'Password is required!';
    }
    
    if(!array_filter($errors)){
        // Prepare SQL statement to avoid SQL injection
        if($con) {
            $stmt = $con->prepare("SELECT * FROM user_accounts WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                // Verify the hashed password
                if($password == $row['password']) {
                    // Set session user_id and redirect
                    $_SESSION['ID'] = $row['ID'];
                    echo "<script>
                            alert('Login Successful! Redirecting to main page.');
                            window.location.href = 'dashboard.php';
                          </script>";
                    exit;
                } else {
                    $errors['password'] = 'Incorrect password!';
                }
            } else {
                $errors['username'] = 'Username does not exist!';
            }

            $stmt->close();
        } else {
            $errors['username'] = 'Database connection error!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-u3h5SFn5baVOWbh8UkOrAaLXttgSF0vXI15ODtCSxl0v/VKivnCN6iHCcvlyTL7L" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.2.0/dist/js/coreui.bundle.min.js" integrity="sha384-JdRP5GRWP6APhoVS1OM/pOKMWe7q9q8hpl+J2nhCfVJKoS+yzGtELC5REIYKrymn" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
     <link rel="stylesheet" href="css/admincss/adminlogin.css">
    <title>Home</title>
</head>
<body>

    <section class="vh-100" style="background-color: black;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

                <form method="post">
                    <h3 class="mb-5">Sign in</h3>

                    <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="typeEmailX-2" name="username" class="form-control form-control-lg" />
                    <label class="form-label" for="typeEmailX-2" >Username</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX-2" >Password</label>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-start mb-4">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                    </div>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
                </form>

            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>