<h2>All Articles</h2>

<?php if ( $total_articles > 0 ): ?>

<table class="tlist" width="100%">
    <tr>
        <th class="thl">Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created On</th>
        <th class="thr">Options</th>
    </tr>
    <?php foreach ($articles as $article): ?>
    <tr>
        <td class="row1" width="5%"><?php echo $article->id; ?></td>
        <td class="row1">
            <?php echo ($article->category_id != 0) ? $article->category->name : 'Uncategorized'; ?>
        </td>
        <td class="row1"><?php echo $article->title; ?></td>
        <td class="row1"><?php echo $article->body; ?></td>
        <td class="row1" width="12%"><?php echo Date::Factory($article->created_time)->format("%m/%d/%Y"); ?></td>
        <td class="row1" width="12%">
            <?php echo Html::anchor('articles/edit/'.$article->id, 'edit'); ?> /
            <?php echo Html::anchor('articles/delete/'.$article->id, 'delete'); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="text-align:center; padding-top: 10px;"><?php echo Pagination::create_links(); ?></div>

<?php else: ?>
<p>You did not add any articles. <?php echo Html::anchor('articles/add', 'Add an Article'); ?>.</p>
<?php endif; ?>