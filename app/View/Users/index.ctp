<div id="session">
	<img src="../images/icon.png" alt=""><span><?php echo "Prince"; ?></span>
	<div class="logout"><?php echo $this->Html->link('Deconnexion',array(
				'controller'=>'users', 
				'action'=>'logout')) ?>
	</div>
</div>
<div id="sidebar">
	<?php
		echo $this->Form->create('recherche');
		echo $this->Form->input('Utilisateur');
		echo $this->Form->end(__('Rechercher'));
	?>
	<div class="clear"></div>
	<ul class="">
        <li>
            <?php  
                echo $this->Html->link('Ajouter un utilisateur', array('controller'=>'users',
                'action'=>'add'));  
            ?>
        </li>
        <li>
           <?php  
                echo $this->Html->link('Liste des utilisateurs', array('controller'=>'users',
                'action'=>'index'));  
            ?> 
        </li>
    </ul>
</div>
<div id="corps">
	<h1>Liste des utilisateurs</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>User Name</th>
			<th>role</th>
			<th>Date de création</th>
			<th>Date de modification</th>
			<th colspan="2">Actions</th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user['User']['id']; ?></td>
			<td><?php echo $user['User']['username']; ?></td>
			<td><?php echo $user['User']['role']; ?></td>
			<td><?php echo $user['User']['created']; ?></td>
			<td><?php echo $user['User']['modified']; ?></td>
			<td>
				<?php 
					echo $this->Html->link('Edit',
					array('controller'=>'users','action'=>'edit',$user['User']['id']));
				?>
			</td>
			<td>
				<?php
					echo $this->Html->link('Supprimer',
					array('controller'=>'users','action'=>'delete',$user['User']['id']));
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>