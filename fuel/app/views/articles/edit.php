<h2>Edit Article - <?php echo $article->title; ?></h2>

<?php echo isset($errors) ? $errors : false; ?>
<?php echo Form::open('articles/edit/'.$article->id); ?>

<div class="input select">
    <?php echo Form::label('Category', 'category_id'); ?>
    <select name="category_id">
        <option value="0"<?php if ( $article->category_id == 0) echo ' selected'; ?>>Uncategorized</option>
        <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category->id; ?>"<?php if ( $article->category_id == $category->id) echo ' selected'; ?>>
                <?php echo $category->name; ?>
        </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="input text required">
    <?php echo Form::label('Title', 'title'); ?>
    <?php echo Form::input('title', $article->title, array('size' => 30)); ?>
</div>

<div class="input textarea required">
    <?php echo Form::label('Body', 'body'); ?>
    <?php echo Form::textarea('body', $article->body, array('cols' => 40, 'rows' => 4)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('edit_article', 'Edit Article'); ?>
</div>

<?php echo Form::close(); ?>