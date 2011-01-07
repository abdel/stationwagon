<h2>Add an Article</h2>
<p>Publish a new article!</p>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('articles/add'); ?>

<div class="input select">
    <?php echo Form::label('Category', 'category_id'); ?>
    <select name="category_id">
        <option value="0" selected>Uncategorized</option>
        <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
        <?php endforeach; ?>
    </select>
</div>

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