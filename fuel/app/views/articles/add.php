<?php echo Form::open('articles/index'); ?>

<div class="input text required">
    <?php echo Form::label('Title', 'title'); ?>
    <?php echo Form::input('title', NULL, array('size' => '30')); ?>
</div>

<div class="input textarea required">
    <?php echo Form::label('Body', 'body'); ?>
    <?php echo Form::textarea('body', NULL, array('rows' => 4, 'cols' => 40)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit(NULL, 'Add Article'); ?>
</div>

<?php echo Form::close(); ?>