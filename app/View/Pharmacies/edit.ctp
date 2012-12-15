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
<div class="add">
<?php $options = array(); ?>
<?php foreach ($regions as $region) : $region = $region['Region']; ?>
    <?php 
        array_push($options, $region['nom']); 
    ?>
<?php endforeach; ?>

<?php echo $this->Form->create('Pharmacie',array('action' => 'edit')); ?>
    <fieldset>
        <legend><?php echo __('Créer une officine'); ?></legend>
    <?php
        echo $this->Form->input('nom');
        echo $this->Form->input('code');
        echo $this->Form->input('lat');
        echo $this->Form->input('lng');
        echo $this->Form->input('Region', array(
            'options' => $options
        ));
        echo $this->Form->input('type', array(
            'options' => array('Pharmacie' => 'Pharmacie', 'Centre de santé' => 'Centre de santé', 'Hopital'=>'Hopital')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Enregistrer')); ?>
<div class="clear"></div>
</div>