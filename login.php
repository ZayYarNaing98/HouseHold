<?php

require ('database.php');

if(isset($_SESSION['user'])){
	header('location: /login');
	exit();
}

$errors = [];

if( isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if( (strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) > 0 )){
		$query = sprintf("SELECT * FROM users WHERE email ='%s'",
		mysqli_real_escape_string($conn, $email)
		);
		$result = mysqli_query($conn, $query);
	

		if(!$result){
			$errors['message'] = "Errors when select the data";
		}else{
			$row = mysqli_fetch_assoc($result);
			if(!empty($row)){
			  if(password_verify($password, $row['password'])){
				login([
				  'id' => $row['user_id'],
				  'email' => $email,
				  'name'	=> $row['username'],
				  
				]);
				header('location: /finances');
				exit();
			  }else{
				$errors['message']= "Enter valid email and password.";
			  }
			}else{
				$errors['message']= "Enter valid email and password.";
			  }
		  }
    }else{
        $errors['message'] = "Enter valid email and password!";
    }
}
?>

<?php require ('view/htmlHeader.php'); ?>
	<div class="container mt-5">
		<div class="row justify-content-center" >
			<div class="col-md-6">
				<div class="card"style="background-color: #f5f5f5;">
					<div class="card-header">
						<h4>Login</h4>
					</div>
					<div class="card-body">
						<form method="POST">
							<div class="form-group">
								<label class="mb-2">Email</label>
								<input type="email" name="email" class="form-control mb-3" placeholder="Email address">
							</div>
							<div class="form-group">
								<label class="mb-2">Password</label>
								<input type="password" name="password" class="form-control mb-4" placeholder="Password">
							</div>
							<button type="submit" class="btn btn-primary btn-block w-100">LOGIN</button>
							
						</form>
						
						<div class="text-center mt-3">
							Sign Up For Free!
							<a href="/register"> Sign Up</a>
						</div>
						<?php if(!empty($errors)) :?>
                            <div class="mt-2 text-danger text-center">
                                <?= $errors['message'] ?>
                            </div>
                        <?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require ('view/htmlFooter.php'); ?>