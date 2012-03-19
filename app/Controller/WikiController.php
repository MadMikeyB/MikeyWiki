<?php
App::uses('Sanitize', 'Utility');
class WikiController extends AppController
{
    
    public $name = 'Wiki';
    public $uses = array('Wiki', 'User');
    public $components = array('Auth');
    public $helpers = array('Js');
    
    public function beforeFilter() {
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

    public function index()
    {
        $this->set('title_for_layout', 'CodingWiki - Home');
        $this->set('featuredwiki', $this->getRandomArticle());
        $this->set('latestedits', $this->findLatestEdits());
    }


    public function view($slug, $page = null, $revision = null)
    {
        $findSlug = $this->Wiki->findBySlug($slug);
        //debug($this->params);
        $u = $this->Auth->user('username');
        $user = $this->User->findByUsername($u);
        $this->set('title_for_layout', $findSlug['Wiki']['title']);
        if (empty($findSlug)) {
            if (empty($this->params['named']['act'])) {
                $this->redirect(array('controller' => 'wiki', 'action' => 'view', $slug, 'act' => 'createpage'));
            }
        } else {
            $this->set('wiki', $this->Wiki->findBySlug($slug));
            $this->set('create', false);
            $this->set('edit', false);
        }
        if (!empty($this->params['named']['act'])) {
        if (($this->params['named']['act'] == 'createpage') && (empty($findSlug))) {
            $this->set('title_for_layout', $this->unslugify($slug));
            $this->set('create', '1');
            if (!empty($this->request->data)) {
                //debug($this->request->data);
                $this->Wiki->create();
                $this->request->data['Wiki']['slug'] = $this->slugify($this->request->data['Wiki']['title']);
                $this->request->data['Wiki']['date'] = date('Y-m-d');
                $this->request->data['Wiki']['time'] = date('H:i:s');
                $this->request->data['Wiki']['last_editted_date'] = date('Y-m-d');
                $this->request->data['Wiki']['raw'] = strip_tags($this->request->data['Wiki']['entry']);
                
                if (!empty($user)) {
                    $this->request->data['Wiki']['author'] = $user['User']['username'];
                    $this->request->data['Wiki']['last_editted_by'] = $user['User']['username'];
                } else {
                    $this->request->data['Wiki']['author'] = '';
                    $this->request->data['Wiki']['author'] .= $this->request->data['Wiki']['author'];
                    $this->request->data['Wiki']['author'] .= $_SERVER['REMOTE_ADDR'];
                    $this->request->data['Wiki']['last_editted_by'] = '';
                    $this->request->data['Wiki']['last_editted_by'] .= $this->request->data['Wiki']['author'];
                    $this->request->data['Wiki']['last_editted_by'] .= $_SERVER['REMOTE_ADDR'];
                }
                if ($this->Wiki->save($this->request->data)) {
                    $this->redirect(array('controller' => 'wiki', 'action' => 'view', $slug));
                }
                
            } 
        }
        
        if (($this->params['named']['act'] == 'editpage') && (!empty($findSlug))) {
            $this->set('edit', '1');
            $this->Wiki->id = $findSlug['Wiki']['id'];
            $this->Wiki->read();
            if (!empty($this->request->data)) {
                if (!empty($user)) {
                    $this->request->data['Wiki']['last_editted_by'] = $user['User']['username'];
                } else {
                    $this->request->data['Wiki']['last_editted_by'] = '';
                    $this->request->data['Wiki']['last_editted_by'] .= $this->request->data['Wiki']['author'];
                    $this->request->data['Wiki']['last_editted_by'] .= $_SERVER['REMOTE_ADDR'];
                }
                if ($this->Wiki->save($this->request->data)) {
                    $this->redirect(array('controller' => 'wiki', 'action' => 'view', $slug));
                }
            }
        }
        
        }
        
    }

    public function findLatestEdits($limit = 5) {
        $latest = $this->Wiki->find('all', array('limit' => $limit, 'order' => 'Wiki.id DESC'));
        return $latest;
    }
    
    public function getRandomArticle() {
        $w = $this->Wiki->find('all');
        $wiki = $this->Wiki->findById($w[array_rand($w)]['Wiki']['id']); // https://twitter.com/#!/digitalpoint/status/162339365203349505
        return $wiki;
    }
    
    public function slugify($string)
    {
        $string = preg_replace('#[^a-zA-Z0-9]#', '-', $string);
        $string = preg_replace('#\-{2,}#', '-', $string); // remove double dashes
        $string = preg_replace('#^\-+#', '', $string); // remove leading dashes
        $string = preg_replace('#\-+$#', '', $string); // remove trailing dashes
        $string = strtolower($string);

        return $string;
    }
    
    public function unslugify($string) {
        $string = str_replace('-', ' ', $string);
        $string = ucfirst($string);
        // other stuff
        return $string;
    }

}
