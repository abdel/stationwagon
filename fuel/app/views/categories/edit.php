<h2>Edit Category - <?php echo $category->name; ?></h2>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('categories/edit/'.$category->id); ?>

<div class="input text required">
    <?php echo Form::label('Name', 'name'); ?>
    <?php echo Form::input('name', $category->name, array('size' => 30)); ?>
</div>

<div class="input textarea">
    <?php echo Form::label('Description', 'description'); ?>
    <?php echo Form::textarea('description', $category->description, array('cols' => 40, 'rows' => 4)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('edit_category', 'Edit Category'); ?>
</div>

<?php echo Form::close(); ?>