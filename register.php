<?php
require ("database.php");
$error = [];
$success = "";
$errorName = $errorEmail = $errorPassword = $errorConfirmPassword = "";
$username = $email = $password = $confirmPassword = "";

if (isset($_POST['create'])) {

    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (isset($user_name) && isset($email) && isset($password) && isset($confirmPassword)) {

        if ($user_name == "" || empty($username)) {
            $errorName = "Username is required.";
        }
        if ($email == "" || empty($email)) {
            $errorEmail = "Email is required.";
        }

        if ($password == "" || empty($password)) {
            $errorPassword = "Password is required.";
        }

        if ($confirmPassword == "" || empty($confirmPassword)) {
            $errorConfirmPassword = "Confirm Passeword is required.";
        }


        if (strlen($user_name) > 0 && (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) && strlen($password) >= 0 && strlen($confirmPassword) >= 0) {
          
            if ($password == $confirmPassword ) {
               
       
                $query=sprintf("SELECT * FROM users WHERE email = '%s'",
                     mysqli_real_escape_string($conn,$email));
                       

                $result = mysqli_query($conn,$query);
                $row  = mysqli_fetch_assoc($result);

                if(!empty($row)){
                    $error['body']="Email Already exist.";
                }else{
                    $query= sprintf("INSERT INTO users (username,email,password,created_at) VALUES ('%s','%s','%s',NOW())",
                            mysqli_real_escape_string($conn,$user_name),
                            mysqli_real_escape_string($conn,$email),
                            mysqli_real_escape_string($conn,password_hash($password,PASSWORD_BCRYPT))
                );
                    $result=mysqli_query($conn,$query);

                    if($result){
                        $success = "Register Successful!.";                       
                        $username="";
                        $email="";
                        $password="";
                        $confirmPassword="";
                        header("Location: /login");
                        exit();
                    }
                }                

            } else {
                $error['body'] = "Password do not match!";
            }
        }else{
            $error['body']="Enter valid email and password.";
        }

    }

}

?>

<?php require("view/htmlHeader.php");?>

    <div class="container justify-content-center" style="margin-top: 2%; width: 500px;border: ridge 1.5px white;padding: 30px;background-color: #f5f5f5;">
        <?php if (!empty($success)): ?>
            <div class="text-success mb-2">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="text-danger mb-2">
                <?= $error['body']; ?>
            </div>
        <?php endif; ?>


        <h3>Create an account</h3>

        <form action="register" method="post">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                <div class="text-danger">
                    <?= $errorName; ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                    value="<?php echo $email; ?>">
                <div class="text-danger">
                    <?= $errorEmail; ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                <div class="text-danger">
                    <?= $errorPassword; ?>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword"
                    value="<?php echo $confirmPassword; ?>">
                <div class="text-danger">
                    <?= $errorConfirmPassword; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="create">Sign up</button>
        </form>
        <div class="mt-3">
            Already have an account? <a href="login"> Sign In</a>
        </div>
    </div>

    <?php require("view/htmlFooter.php"); ?>