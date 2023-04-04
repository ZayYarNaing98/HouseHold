<?php require('database.php') ?>
<?php

if (isset($_POST['insert'])) {
    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $income = (!empty($_POST['income'])) ? $_POST['income'] : 0;
    $expense = (!empty($_POST['expense'])) ? $_POST['expense'] : 0;
    $user_id = $_SESSION['user']['id'];
    

    $query= sprintf("INSERT INTO finances(Date, Description, Income, Expense, user_id) VALUES ('%s', '%s', '%s', '%s', '%s')",
                mysqli_real_escape_string($conn,$date),
                mysqli_real_escape_string($conn,$desc),
                mysqli_real_escape_string($conn,$income),
                mysqli_real_escape_string($conn,$expense),
                mysqli_real_escape_string($conn,$user_id),
                mysqli_real_escape_string($conn,$category_id),
                );
    $result=mysqli_query($conn,$query);
    if(!$result) {
        $errors['message'] = 'Failed to inert!';
    } else {
        $success['message'] = 'Successfully inserted!';
    }
    
}

?>
<?php require('view/htmlHeader.php'); ?>
<?php require('view/navbar.php'); ?>
    <div class="container cols col-6">
        <h2 class="my-5">Form for Adding New Item</h2>
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
                <input type="date" id="date" name="date" class="form-control" />
                <label class="form-label" for="date">Date</label>
            </div>

            <div class="form-outline mb-4">
                <textarea type="text" id="desc" name="desc"  class="form-control"></textarea>
                <label class="form-label" for="desc">Description</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="income" name="income" class="form-control" />
                <label class="form-label" for="income">Income</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="expense" name="expense" class="form-control" />
                <label class="form-label" for="expense">Expense</label>
            </div>

            <div class="">
                <input type="hidden" value="$_SESSION['user']['id]" />
                <button type="submit" class="form-control btn btn-success" name="insert">Insert</button>
            </div>
            
        </form>
    </div>
<?php require('view/htmlFooter.php'); ?>