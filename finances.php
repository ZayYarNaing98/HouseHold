<?php require('database.php'); ?>
<?php

$userid = $_SESSION['user']['id'];

$query = "SELECT * FROM finances WHERE user_id = $userid";
$result = mysqli_query($conn, $query);
if(!$result){
    die("empty data");
}else{
    // var_dump($result);
}

?>

<?php require('view/htmlHeader.php'); ?>
<?php require('view/navbar.php'); ?>

<div class="container">
    <div class="mt-5">
        <button class="btn btn-success btn-rounded">
            <a class="text-white" href="/insert">ADD <i class="fa-solid fa-circle-plus text-white"></i></a>
        </button>
    </div>
<?php if($result->num_rows == 0) :?>
    <h3 class="alert alert-danger text-center mt-5">Sorry! There are no records to display!</h3>
    <?php else :?>
        <table class="table table-striped mt-5">
            <tr class="bg-info">
                <th class="text-white">Date</th>
                <th class="text-white">Description</th>
                <th class="text-white">Income</th>
                <th class="text-white">Expense</th>
                <th class="text-white">Balance</th>
                <th class="text-white">Actions</th>
            </tr>
            <?php while($rows = mysqli_fetch_assoc($result)) :?>        
                <tr>
                    <?php $total = $success; ?>
                    <td><?= $rows['Date'] ?></td>
                    <td><?= $rows['Description'] ?></td>
                    <td><?= number_format($rows['Income']) ?></td>
                    <td><?= number_format($rows['Expense']) ?></td>
                    <td><?= number_format($success = ($rows['Income'] - $rows['Expense']) + $total); ?></td>
                    <td>
                        <span>
                            <a class="text-primary" href="/edit?id=<?= $rows['id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i>        
                            </a>
                        </span>
                        <span>|</span>
                        <span>
                            <a class="text-danger" href="/delete?id=<?= $rows['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')" >
                                <i class="fa-regular fa-trash-can"></i>
                            </a>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tr class="bg-secondary">
                <td colspan="5" class="text-white text-center">Total</td>
                <td class="text-white"><?= number_format($success) ?></td>
            </tr>
        </table>
    <?php endif ?>
</div>
<?php require('view/htmlFooter.php'); ?>