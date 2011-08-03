<h2>Add an Article</h2>
<p>Publish a new article by filling the form below.</p>

<div class="options">
    <div class="option">
            <?php echo Html::anchor('articles', 'View Articles'); ?>
    </div>
    <div class="option">
        <?php echo Html::anchor('categories/add', 'Add a Category'); ?>
    </div>
</div>

<?php echo $val->show_errors(); ?>
<?php echo Form::open('articles/add'); ?>

<?php $select_categories = array(null => 'Uncategorized'); ?>
<?php foreach ($categories as $category): ?>
<?php $select_categories[$category->id] = $category->name; ?>
<?php endforeach; ?>

<div class="input select">
    <?php echo Form::label('Category', 'category_id'); ?>
    <?php echo Form::select('category_id', e($val->input('category_id')), 
        $select_categories); ?>
</div>

<div class="input text required">
    <?php echo Form::label('Title', 'title'); ?>
    <?php echo Form::input('title', e($val->input('title')), 
        array('size' => '30')); ?>
</div>

<div class="input textarea required">
    <?php echo Form::label('Body', 'body'); ?>
    <?php echo Form::textarea('body', e($val->input('body')), 
        array('rows' => 4, 'cols' => 40)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('add_article', 'Publish'); ?>
    <?php echo Form::submit('save_draft', 'Save Draft'); ?>
</div>

<?php echo Form::close(); ?>
