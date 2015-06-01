<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 */
class HomesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public function beforeFilter(){
        parent::beforeFilter();
    }


    /**
     * index method
     *
     * @return void
     */
    public function index() {
     $this->set('title_for_layout','Home');
    }

}
