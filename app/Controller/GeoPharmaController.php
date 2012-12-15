<?php
/**
* 
*/
class  GeoPharmaController extends AppController
{
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login');
    }

    public function index()
    {
    	
    }
}
?>