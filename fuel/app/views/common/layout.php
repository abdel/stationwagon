<!DOCTYPE html> 
<html lang="en"> 
	<head> 
		<meta charset="utf-8">
        <title>Stationwagon
            <?php echo isset($title) ? ' - '.$title : null; ?></title>

        <?php echo Asset::css(array('screen.css')); ?>
	</head> 
    <body>
        <header> 
            <a href="https://github.com/abdelm/stationwagon" target="_blank">
                <img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/e6bef7a091f5f3138b8cd40bc3e114258dd68ddf/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub">
            </a>

			<nav> 
                <h1 class="logo">Stationwagon</h1> 

				<ul> 
                    <?php if (Auth::check()): ?>
                    <li><?php echo Html::anchor('articles', 'Articles'); ?></li>
                    <li><?php echo Html::anchor('categories', 'Categories'); ?></li>
				    <li><?php echo Html::anchor('users/logout', 'Logout'); ?></li>
				    <?php else: ?>
				    <li><?php echo Html::anchor('users/login', 'Login'); ?></li>
				    <li><?php echo Html::anchor('users/signup', 'Sign Up'); ?></li>
				    <?php endif; ?>
                </ul> 
			</nav> 
		</header> 
			
		<section> 
            <div class="content">
                <?php if (Session::get_flash('success') or Session::get_flash('notice') or Session::get_flash('error')): ?>
			<div class="result-messages">
            	<?php if (Session::get_flash('success')): ?>
                <div class="result" id="success">
                    <span><?php echo Session::get_flash('success'); ?></span>
                </div>
	            <?php elseif (Session::get_flash('notice')): ?>
                <div class="result" id="notice">
                    <span><?php echo Session::get_flash('notice'); ?></span>
                </div>
	            <?php elseif (Session::get_flash('error')): ?>
                <div class="result" id="error">
                    <span><?php echo Session::get_flash('error'); ?></span>
                </div>
	            <?php endif; ?>
			</div>
        	<?php endif; ?>

            <?php echo $content; ?>
                
            </div> 
		</section> 
 
		<footer> 
			<section> 
				<aside class="right"> 
					Made possible with <strong>FuelPHP</strong> 
				</aside> 
				<aside class="left"> 
                    &copy;<a href="http://aplusm.me/" target="_blank">
                        Abdelrahman Mahmoud
                    </a>
                </aside> 
			</section> 
		</footer> 
		
        <!-- Javascript --> 
        <?php echo Asset::js(array('jquery.min.js', 'uniform.min.js')); ?>
		
		<script type="text/javascript" charset="utf-8"> 
		$(function() {
			$("input, textarea, select, button, a.button").uniform();
		});
		</script> 
	</body> 
</html>
