<?php
/**
* Model Pharmacie 
*/
App::uses('AuthComponent', 'Controller/Component');
class Pharmacie extends AppModel{
	var $name = 'Pharmacie';
    public $validate = array(
        'nom' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'le username est requis'
            )
        ),
        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'le password est requis'
            )
        ),
        'lat' => array(
            'required' => array(
                'rule' => array('notEmpty','numeric'),
                'message' => 'SVP entrer un role valide',
                'allowEmpty' => false
            )
        ),
        'lng' => array(
            'required' => array(
                'rule' => array('notEmpty','numeric'),
                'message' => 'SVP entrer un role valide',
                'allowEmpty' => false
            )
        )
    );
}


?>