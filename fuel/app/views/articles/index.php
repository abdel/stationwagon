<h2>My Articles</h2>
<p>Manage your existing articles or add new ones.</p>

<div class="options">
	<div class="option"><?php echo Html::anchor('articles/add', 'Add an Article'); ?></div>
	<div class="option"><?php echo Html::anchor('categories', 'View Categories'); ?></div>
</div>

<div class="filters">
    <strong>Show:</strong>
	<?php echo Html::anchor('articles/index/published', 'Published'); ?>
	&middot;
	<?php echo Html::anchor('articles/index/drafts', 'Drafts'); ?>
</div>

<?php if ($total_articles > 0): ?>
<table>
<thead>
	<tr>
		<th>Id</th>
		<th>Category</th>
		<th>Title</th>
		<th>Body</th>
		<th>Status</th>
		<th>Created On</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($articles as $article): ?>
	<tr>
		<td width="5%"><?php echo $article->id; ?></td>
        <td><?php echo ($article->category_id != null) ? $article->category->name : 'Uncategorized'; ?></td>
        <td><?php echo Str::truncate($article->title, 15); ?></td>
        <td><?php echo Str::truncate($article->body, 25); ?></td>
        <td width="7%">
			<?php if ($article->published == 1): ?>
            Published
            <?php else: ?>
			<?php echo Html::anchor('articles/publish/'.$article->id, 'Draft', array('title' => 'Click to Publish')); ?>
			<?php endif; ?>
		</td>
		<td width="11%"><?php echo Date::Factory($article->created_time)->format("%d/%m/%Y"); ?></td>
		<td width="11%">
			<?php echo Html::anchor('articles/edit/'.$article->id, 'edit'); ?> /
     		<?php echo Html::anchor('articles/delete/'.$article->id, 'delete'); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>

<div class="pagination"><?php echo Pagination::create_links(); ?></div>

<?php else: ?>
<div class="result" id="notice">
	<?php if (!$show): ?>
	<span>You did not add any articles. <?php echo Html::anchor('articles/add', 'Add an Article'); ?>.</span>
	<?php else: ?>
	<span>You do not have any <?php echo Inflector::singularize($show); ?> articles. 
		<?php echo Html::anchor('articles/add', 'Add an Article'); ?>.</span>
	<?php endif; ?>
</div>
<div class="clear"></div>
<?php endif; ?>