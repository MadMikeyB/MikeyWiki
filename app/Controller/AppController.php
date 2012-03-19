<?php 

class AppController extends Controller
{
    public $components = array('Auth');

    public function beforeFilter()
    {
        parent::beforeFilter();
        //$this->User = ClassRegistry::init('AppUser');
        $this->Auth->allow('*');
        $u = $this->Auth->user('username');
        $user = $this->User->findByUsername($u);
        if (!empty($user)) {
            $this->set('user', $user);
        } else {
            $this->set('user', false);
        }
    }
}
