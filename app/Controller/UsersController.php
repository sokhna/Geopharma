<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login');
    }

    public function index() {
        $this->User->recursive = 0;
        $d['users'] = $this->User->find('all');
        $this->set($d);
        //$this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Création réussit'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Utilisateur ne peut être sauvegardé. essayer encore STP.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Modification réussit'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Utilisateur ne peut être sauvegardé. essayer encore STP.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Utilisateur supprimé'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Utilisateur non supprimé'));
        $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()){
                $password = Security::hash($this->request->data['User']['password'], 'sha1',true);
                $username = $this->request->data['User']['username'];
                $conditions = array('username' => $username,'password'=>$password);
                $role = $this->User->find('first',array(
                    'conditions'=> $conditions,
                    'fields'    => array('role')
                    ));
                if ($role['User']['role'] == 'admin') {
                    $this->redirect(array('controller'=>'users','action'=>'index'));
                } else {
                    $this->redirect(array('controller'=>'pharmacies','action'=>'index'));
                }

            } else {
                $this->Session->setFlash(__('username ou password invalide, essayer encore'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}

?>