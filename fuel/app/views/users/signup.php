<h2>Sign Up</h2>
<p>Sign up for a new account by filling the form below.</p>

<?php echo $val->show_errors(); ?>
<?php echo Form::open('users/signup'); ?>

<div class="input text required">
    <?php echo Form::label('Username', 'username'); ?>
    <?php echo Form::input('username', e($val->input('username')),
        array('size' => 30)); 
    ?>
</div>

<div class="input password required">
    <?php echo Form::label('Password', 'password'); ?>
    <?php echo Form::password('password', null, array('size' => 30)); ?>
</div>

<div class="input text required">
    <?php echo Form::label('Email Address', 'email'); ?>
    <?php echo Form::input('email', e($val->input('email')), 
        array('size' => 30)); 
    ?>
</div>

<div class="input submit">
    <?php echo Form::submit('signup', 'Sign Up'); ?>
</div>

<?php echo Form::close(); ?>
