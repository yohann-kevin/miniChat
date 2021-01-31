<?php
    session_start();
    require_once 'function/db.php';
    include_once 'layouts/head.php';
    include_once 'layouts/header.php';
    include_once 'function/users.php';
    $db = db();
    if(!empty($_POST)) {
        $errors = register();
    }
?>

<section>
    <h2>Register</h2>
    <?php 
    if(isset($errors)) :
        if($errors) :
            foreach($errors as $error) :
    ?>
    <h3><?= $error ?></h3>
    <?php endforeach; else : ?>
    <h3>GG !</h3>
    <?php endif; endif ?>
    <form method="post" action="">
        <input type="text" name="pseudo" placeholder="pseudo" value="<?php if(isset($_POST['Pseudo']))echo $_POST['Pseudo'] ?>">
        <input type="text" name="email" placeholder="email" value="<?php if(isset($_POST['email']))echo $_POST['email'] ?>">
        <input type="text" name="emailconf" placeholder="emailconf" value="<?php if(isset($_POST['emailconf']))echo $_POST['emailconf'] ?>">
        <input type="password" name="password" placeholder="password">
        <input type="password" name="passwordconf" placeholder="passwordconf">
        <input type="submit" value="M'inscrire !">
    </form>
</section>

<?php
include_once 'layouts/footer.php';
?>