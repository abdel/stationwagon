<h2>Login</h2>
<p>Login to your account using your username and password.</p>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('users/login'); ?>

<div class="input text required">
    <?php echo Form::label('Username', 'username'); ?>
    <?php echo Form::input('username', NULL, array('size' => 30)); ?>
</div>

<div class="input password required">
    <?php echo Form::label('Password', 'password'); ?>
    <?php echo Form::password('password', NULL, array('size' => 30)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('login', 'Login'); ?>
</div>