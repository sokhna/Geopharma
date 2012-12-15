<?php
$Description = __d('GeoPharma', 'GéoPharma est un application de géolocalisation des officines');
$Title = __d('géolocalisation des officines','GéoPharma');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $Title ?> : <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->script('jquery.min');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($Description, 'http://GeoPharma.com'); ?></h1>
		</div>
		<div id="content">
			<?php 
				echo $this->Session->flash('Auth'); 
				echo $this->Session->flash();
				echo $this->fetch('content'); 
			?>
		</div>
		<div id="footer">
			<?php //echo $this->element('sql_dump'); ?>
		</div>
	</div>
</body>
</html>
