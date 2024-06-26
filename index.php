<?php
    session_start();
    if(!isset($_SESSION['username'])){


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chikchat App-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">

</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-400 p-5 shadow rounded ">
        <form method="post" action="app/http/auth.php">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <img src="img/logo.png" alt="No image" class="w-25">
                <h3 class="display-4 fs-1 text-center">
                    LOGIN
                </h3>

            </div>
            <?php if(isset($_GET['error'])){ ?>
                        
                        <div class="alert alert-warning" role="alert">
                            <?php echo htmlspecialchars($_GET['error']);?>
                        </div>
            <?php } ?>
            <?php if(isset($_GET['success'])){ ?>
                        
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($_GET['success']);?>
                        </div>
            <?php } ?>
            <div class="form-group">
                <label >User name</label>
                <input type="text" class="form-control" 
                placeholder="Enter User name"
                name="username">
            </div>

            <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" 
                placeholder="Enter password"
                name="password">
            </div>
            <br>
            <button button type="submit" class="btn btn-primary">LOGIN</button>
            <a href="signup.php">Sign Up</a>
        </form>
    </div>
</body>
</html>
<?php
    }else{
        header("Location: home.php");
        exit;
    }
?>