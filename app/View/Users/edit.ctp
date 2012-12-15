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
<div class="add">
<?php echo $this->Form->create('User',array('action' => 'edit')); ?>
    <fieldset>
        <legend><?php echo __('Modifier un utilisateur'); ?></legend>
    <?php
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Administrateur', 'utilisateur' => 'utilisateur')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Enregistrer')); ?>
</div>