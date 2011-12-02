<h2>Edit Article - <?php echo $article->title; ?></h2>
<p>Modify the article's details using the form below.</p>

<div class="options">
	<div class="option"><?php echo Html::anchor('articles', 'View Articles'); ?></div>
	<div class="option"><?php echo Html::anchor('categories', 'View Categories'); ?></div>
</div>
	
<?php echo $val->show_errors(); ?>
<?php echo Form::open('articles/edit/'.$article->id); ?>

<?php $select_categories = array(null => 'Uncategorized'); ?>
<?php foreach ($categories as $category): ?>
<?php $select_categories[$category->id] = $category->name; ?>
<?php endforeach; ?>

<div class="input select">
	<?php echo Form::label('Category', 'category_id'); ?>
	<?php echo Form::select('category_id', e($article->category_id), $select_categories); ?>
</div>

<div class="input text required">
	<?php echo Form::label('Title', 'title'); ?>
	<?php echo Form::input('title', e($article->title), array('size' => 30)); ?>
</div>

<div class="input textarea required">
	<?php echo Form::label('Body', 'body'); ?>
	<?php echo Form::textarea('body', e($article->body), array('cols' => 40, 'rows' => 4)); ?>
</div>

<div class="input submit">
	<?php echo Form::submit('edit_article', 'Edit Article'); ?>
</div>

<?php echo Form::close(); ?>