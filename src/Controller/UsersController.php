<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->Users->find('all');

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to logout only.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.

        $this->Auth->allow(['logout']);


    }

    public function isAuthorized($user)
    {
        //debug($user['role']);
        //First, find out whether the user is a staff
        if ($user['role'] == 'staff') {
            //Then, determine current action of the page
            if ($this->request->action === 'index' or 'add' or 'view' or 'delete') {
                //Finally, grant or deny users' privilege
                $this->Flash->error(__('Not Authorised, please contact an Admin'));
                return false;
            }

        }

        return parent::isAuthorized($user);
    }
    /**
     * Login and logout methods
     *
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } 
                $this->Flash->error(__('Username or password is incorrect'));
        }
        
    }

//    public function login()
//    {
//        if ($this->request->is('post')) {
//            $user = $this->Auth->identify();
//            if ($user) {
//                return $this->redirect($this->Auth->redirectUrl());
////                $path = '/pages/home';
////                $this->Auth->setUser($user);
////                return $this->redirect($path);
//            }
//            $this->Flash->error(__('Invalid username or password, try again'));
//        }
//    }

    public function logout()
    {

        return $this->redirect($this->Auth->logout());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
            $this->request->allowMethod(['post', 'delete']);


        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else{
            $this->Flash->error(__('The user could not be deleted.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
