<div class="users form login">
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
	    <fieldset>
	        <legend><?php echo __('Veuillez vous identifier pour accéder à Geopharma'); ?></legend>
	    <?php
	        echo $this->Form->input('username');
	        echo $this->Form->input('password');
	    ?>
	    </fieldset>
	<?php echo $this->Form->end(__('Login')); ?>
 <div class="clear"></div>
</div>
