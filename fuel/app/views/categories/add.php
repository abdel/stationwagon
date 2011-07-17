<h2>Add a Category</h2>
<p>Add a new category by filling the form below.</p>

<div class="options">
	<div class="option"><?php echo Html::anchor('categories', 'View Categories'); ?></div>
	<div class="option"><?php echo Html::anchor('articles/add', 'Add an Article'); ?></div>
</div>

<?php echo $val->show_errors(); ?>
<?php echo Form::open('categories/add'); ?>

<div class="input text required">
    <?php echo Form::label('Name', 'name'); ?>
    <?php echo Form::input('name', $val->input('name'), array('size' => '30')); ?>
</div>

<div class="input textarea">
    <?php echo Form::label('Description', 'description'); ?>
    <?php echo Form::textarea('description', $val->input('description'), array('rows' => 4, 'cols' => 40)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit(array('value' => 'Add Category')); ?>
</div>

<?php echo Form::close(); ?>