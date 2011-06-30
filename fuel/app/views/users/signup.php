<h2>Sign Up</h2>
<p>To sign up for a new account, fill the form below with your account information.</p>

<?php echo $val->show_errors(); ?>
<?php echo Form::open('users/signup'); ?>

<div class="input text required">
    <?php echo Form::label('Username', 'username'); ?>
    <?php echo Form::input('username', $val->input('username'), array('size' => 30)); ?>
</div>

<div class="input password required">
    <?php echo Form::label('Password', 'password'); ?>
    <?php echo Form::password('password', null, array('size' => 30)); ?>
</div>

<div class="input text required">
    <?php echo Form::label('Email Address', 'email'); ?>
    <?php echo Form::input('email', $val->input('password'), array('size' => 30)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('signup', 'Sign Up'); ?>
</div>

<?php echo Form::close(); ?>
