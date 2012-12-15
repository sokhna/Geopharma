<?php
/**
* Controlleur pour gérer toutes les pharmacies
*/
class PharmaciesController extends AppController
{
	public $uses = array('Pharmacie','Region');

	public $helpers = array('Html','Form');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}

	public function index()	{
		$d['pharmacies'] =  $this->Pharmacie->find('all');
		$r['regions'] = $this->Region->find('all');
		//debug($pharmacies);
		$this->set($d);
		$this->set($r);
	}
	
	public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Pharmacie->id = $id;
        if (!$this->Pharmacie->exists()) {
            throw new NotFoundException(__('Officine invalide'));
        }
        if ($this->Pharmacie->delete()) {
            $this->Session->setFlash(__('Officine supprimée'));
            $this->redirect(array('action' => 'liste'));
        }
        $this->Session->setFlash(__('Officine non supprimée'));
        $this->redirect(array('action' => 'liste'));
    }

    public function liste(){
    	$d['pharmacies'] = $this->Pharmacie->find('all');
    	$this->set($d);
    }
	
	public function edit($id = null) {
        $this->Pharmacie->id = $id;
        /*if (!$this->Pharmacie->exists()) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }*/
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Pharmacie->save($this->request->data)) {
                $this->Session->setFlash(__('Modification réussit'));
                $this->redirect(array('action' => 'liste'));
            } else {
                $this->Session->setFlash(__('La modification n\'a pas pu s\'éffectuer. essayer encore STP.'));
            }
        } else {
            $this->request->data = $this->Pharmacie->read(null, $id);
            //unset($this->request->data['Pharmacie']['password']);
        }

        $r['regions'] = $this->Region->find('all');
        $this->set($r);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Pharmacie->create();
            if ($this->Pharmacie->save($this->request->data)) {
                $this->Session->setFlash(__('Création réussit'));
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('L\'officince ne peut être sauvegardée. essayer encore STP.'));
            }
        }

        $d['pharmacies'] = $this->Pharmacie->find('all');
        $r['regions'] = $this->Region->find('all');
        $this->set($r);
        $this->set($d);
    }
}
?>