<h2>All Categories</h2>

<?php if ( $total_categories> 0 ): ?>

<table class="tlist" width="100%">
    <tr>
        <th class="thl">Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Created On</th>
        <th class="thr">Options</th>
    </tr>
    <?php foreach ($categories as $category): ?>
    <tr>
        <td class="row1" width="5%"><?php echo $category->id; ?></td>
        <td class="row1"><?php echo $category->name; ?></td>
        <td class="row1"><?php echo $category->description; ?></td>
        <td class="row1" width="12%"><?php echo Date::Factory($category->created_time)->format("%m/%d/%Y"); ?></td>
        <td class="row1" width="12%">
            <?php echo Html::anchor('categories/edit/'.$category->id, 'edit'); ?> /
            <?php echo Html::anchor('categories/delete/'.$category->id, 'delete'); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="text-align:center; padding-top: 10px;"><?php echo Pagination::create_links(); ?></div>

<?php else: ?>
<p>You did not add any categories. <?php echo Html::anchor('categories/add', 'Add a Category'); ?>.</p>
<?php endif; ?>