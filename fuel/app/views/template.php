<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Stationwagon<?php echo isset($title) ? ' - '.$title : null; ?></title>

        <?php echo Asset::css(array('stationwagon.css')); ?>
    </head>
    <body>
        <div class="header">
            <div class="logo">
                <h1>Stationwagon
                    <span class="fork">
                        <a href="https://github.com/abdelm/stationwagon/">Fork on Github</a>
                    </span>
                </h1>
            </div>

            <ul class="nav">
                <?php if (Auth::check()): ?>
                <li><?php echo Html::anchor('articles', 'My Articles'); ?></li>
                <li><?php echo Html::anchor('categories', 'My Categories'); ?></li>
				<li><?php echo Html::anchor('users/logout', 'Logout'); ?></li>
				<?php else: ?>
				<li><?php echo Html::anchor('users/login', 'Login'); ?></li>
				<li><?php echo Html::anchor('users/signup', 'Sign Up'); ?></li>
				<?php endif; ?>
            </ul>
        </div>

        <div class="content">
			<?php if (Session::get_flash('success') or Session::get_flash('notice') or Session::get_flash('error')): ?>
			<div class="result-messages">
            	<?php if (Session::get_flash('success')): ?>
	            <div class="result" id="success"><span><?php echo Session::get_flash('success'); ?></span></div>
	            <?php elseif (Session::get_flash('notice')): ?>
	            <div class="result" id="notice"><span><?php echo Session::get_flash('notice'); ?></span></div>
	            <?php elseif (Session::get_flash('error')): ?>
	            <div class="result" id="error"><span><?php echo Session::get_flash('error'); ?></span></div>
	            <?php endif; ?>
	
				<div class="clear"></div>
			</div>
        	<?php endif; ?>

            <?php echo $content; ?>
        </div>

        <div class="footer">
            <div class="right">Page renedered in {exec_time}s &middot; Memory Usage {mem_usage}MB</div>
            <div class="left">
				Made possible with <a href="http://fuelphp.com/">FuelPHP</a>
				<br>
				Developed by <a href="http://aplusm.me/">Abdelrahman Mahmoud</a> &amp;
					<a href="http://twitter.com/Alfie_Rivera">Alfredo Rivera</a>
			</div>
        </div>
    </body>
</html>