<!DOCTYPE html>
<html>
    <head>
        <title>Statationwagon<?php echo isset($title) ? ' - '.$title : null; ?></title>
        <?php Asset::add_path('/assets/'); ?>
        <?php echo Asset::css('style.css'); ?>
    </head>
    <body>
        <div class="logo">
            <h1>Stationwagon
                <sub class="fork"><a href="https://github.com/abdelm/stationwagon/">Fork on Github</a></sub></h1>
        </div>
        
        <div class="header">
            <div class="menubar">
                <div class="menu_item"><?php echo Html::anchor('articles/index', 'All Articles'); ?></div>
                <div class="menu_item"><?php echo Html::anchor('articles/add', 'Add Article'); ?></div>
                <div class="menu_item"><?php echo Html::anchor('categories/index', 'All Categories'); ?></div>
                <div class="menu_item"><?php echo Html::anchor('categories/add', 'Add Category'); ?></div>
            </div>
        </div>
        
        <div class="content">
            <?php if (Session::get_flash('message')): ?>
            <p><?php echo Session::get_flash('message'); ?></p>
            <?php endif; ?>
            <?php echo $content; ?>
        </div>
        
        <div class="footer">
            <div class="top">Page renedered in {exec_time}s | Memory Usage {mem_usage}MB</div>
            <div class="bottom">Developed by <a href="http://twitter.com/abdel_m">Abdelrahman Mahmoud</a> 
                and <a href="http://twitter.com/Alfie_Rivera">Alfredo Rivera</a>.</div>
        </div>
    </body>
</html>