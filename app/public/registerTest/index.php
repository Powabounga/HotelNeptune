<?php 
    include_once '../helpers/session_helper.php';
?>

    <h1 class="header">Please Signup</h1>

    <?php flash('register') ?>

    <form method="post" action="../controllers/Users.php">
        <input type="hidden" name="type" value="register">
        <input type="text" name="username" 
        placeholder="Full name...">
        <input type="text" name="userEmail" 
        placeholder="Email...">
        <input type="text" name="userUid" 
        placeholder="Username...">
        <input type="password" name="userPwd" 
        placeholder="Password...">
        <input type="password" name="pwdRepeat" 
        placeholder="Repeat password">
        <button type="submit" name="submit">Sign Up</button>
    </form>