<h2>Welcome to Stationwagon</h2>

<?php echo Form::open('articles/add'); ?>

<?php echo Form::label('Title', 'title'); ?>
<?php echo Form::input('title', NULL, array('size' => '30')); ?>
<br />
<?php echo Form::label('Body', 'body'); ?>
<?php echo Form::textarea('body'); ?>
<br />
<?php echo Form::submit(NULL, 'Add Article'); ?>

<?php echo Form::close(); ?>