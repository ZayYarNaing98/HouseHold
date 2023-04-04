<?php require('database.php') ?>
<?php

$id = $_GET['id'];
$userid = $_SESSION['user']['id'];
// dd($id);

$query = "SELECT * FROM finances WHERE id = '$id' AND user_id = '$userid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $income = (!empty($_POST['income'])) ? $_POST['income'] : 0;
    $expense = (!empty($_POST['expense'])) ? $_POST['expense'] : 0;
    $user_id = $_SESSION['user']['id'];

    $query= "UPDATE finances SET Date='$date', Description='$desc', Income='$income', Expense='$expense', user_id='$user_id' WHERE id = '$id'";
    // echo($query);
    $result= mysqli_query($conn,$query);
    
    if($result) {
        $success['message'] = 'Successfully edited!';
    }else{
        $errors['message'] = 'Failed to edit!';
    }
}

?>
<?php require('view/htmlHeader.php'); ?>
<?php require('view/navbar.php'); ?>
    <div class="container">
        <h2 class="my-5">Update Record Form</h2>
        <?php if(!empty($errors)) :?>
                <div class="alert alert-danger text-center">
                    <?= $errors['message'] ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($success)) :?>
                <div class="alert alert-success text-center">
                    <?= $success['message'] ?>
                </div>
            <?php endif; ?>
        <form method="POST">
            <div class="form-outline mb-4">
                <input type="date" id="date" name="date" class="form-control" value="<?= $row['Date'] ?>"/>
                <label class="form-label" for="date">Date</label>
            </div>

            <div class="form-outline mb-4">
                <textarea type="text" id="desc" name="desc"  class="form-control"><?= $row['Description'] ?></textarea>
                <label class="form-label" for="desc">Description</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="income" name="income" class="form-control" value="<?= $row['Income'] ?>"/>
                <label class="form-label" for="income">Income</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="expense" name="expense" class="form-control" value="<?= $row['Expense'] ?>"/>
                <label class="form-label" for="expense">Expense</label>
            </div>

            <div>
                <input type="hidden" value="$_SESSION['user']['id]" />
                <button type="submit" class="form-control btn btn-success">Update</button>
            </div>
            
        </form>
    </div>
<?php require('view/htmlFooter.php'); ?>