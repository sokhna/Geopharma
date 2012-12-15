<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    var $name = 'User';
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'le username est requis'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'le password est requis'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'SVP entrer un role valide',
                'allowEmpty' => false
            )
        )
    );

    function beforeSave(){
        $this->data[$this->name]['password'] = Security::hash($this->data[$this->name]['password'], 'sha1',true);
        return  true;
    }
}
?>