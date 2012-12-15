<div id="session">
	<img src="../images/icon.png" alt=""><span><?php echo "Prince"; ?></span>
	<div class="logout"><?php echo $this->Html->link('Deconnexion',array(
				'controller'=>'users', 
				'action'=>'logout')) ?>
	</div>
</div>
<div id="sidebar">
	<h2>Menu</h2>
	<ul class="">
		<li>
            <?php  
                echo $this->Html->link('Accueil', array('controller'=>'pharmacies',
                'action'=>'index'));  
            ?>
        </li>
        <li>
            <?php  
                echo $this->Html->link('Ajouter une officine', array('controller'=>'pharmacies',
                'action'=>'add'));  
            ?>
        </li>
        <li>
           <?php  
                echo $this->Html->link('Liste des officines', array('controller'=>'pharmacies',
                'action'=>'liste'));  
            ?> 
        </li>
    </ul>
</div>
<div id="corps">
	<h1>Liste des Officines</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Latitude</th>
			<th>Longidute</th>
			<th>Type</th>
			<th>Création</th>
			<th>Modification</th>
			<th colspan="2">Actions</th>
		</tr>
		<?php foreach ($pharmacies as $pharmacie): $pharmacie = $pharmacie['Pharmacie']?>
		<tr>
			<td><?php echo $pharmacie['id']; ?></td>
			<td><?php echo $pharmacie['nom']; ?></td>
			<td><?php echo $pharmacie['lat']; ?></td>
			<td><?php echo $pharmacie['lng']; ?></td>
			<td><?php echo $pharmacie['type']; ?></td>
			<td><?php echo $pharmacie['created']; ?></td>
			<td><?php echo $pharmacie['modified']; ?></td>
			<td>
				<?php 
					echo $this->Html->link('Editer',
					array('controller'=>'pharmacies','action'=>'edit',$pharmacie['id']));
				?>
			</td>
			<td>
				<?php
					echo $this->Html->link('Supprimer',
					array('controller'=>'pharmacies','action'=>'delete',$pharmacie['id']));
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>