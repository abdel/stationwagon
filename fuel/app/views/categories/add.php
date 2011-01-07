<h2>Add a Category</h2>
<p>Add a new category.</p>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('categories/add'); ?>

<div class="input text required">
    <?php echo Form::label('Name', 'name'); ?>
    <?php echo Form::input('name', NULL, array('size' => '30')); ?>
</div>

<div class="input textarea">
    <?php echo Form::label('Description', 'descripton'); ?>
    <?php echo Form::textarea('description', NULL, array('rows' => 4, 'cols' => 40)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('add_category', 'Add Category'); ?>
</div>

<?php echo Form::close(); ?>