<?php
    require base_path("view/navbar.php");
    require base_path("view/htmlHeader.php");   

?>
<h1 class="mt-3 ml-5">Welcome
    <span class="text-primary">
        <?= $_SESSION['user']['name'] ?>
    </span>
</h1>
<?php 
    require base_path("view/htmlFooter.php"); 
?>
