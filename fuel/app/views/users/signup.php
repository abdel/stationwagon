<h2>Sign Up</h2>
<p>To sign up for a new account, fill the form below with your account information.</p>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('users/signup'); ?>

<div class="input text required">
    <?php echo Form::label('Username', 'username'); ?>
    <?php echo Form::input('username', NULL, array('size' => 30)); ?>
</div>

<div class="input password required">
    <?php echo Form::label('Password', 'password'); ?>
    <?php echo Form::password('password', NULL, array('size' => 30)); ?>
</div>

<div class="input text required">
    <?php echo Form::label('Email Address', 'email'); ?>
    <?php echo Form::input('email', NULL, array('size' => 30)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('signup', 'Sign Up'); ?>
</div>

<?php echo Form::close(); ?>