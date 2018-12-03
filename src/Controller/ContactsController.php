<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow('index');


    }
    public function index()
    {
        $form = new ContactForm();
        $exists = false;
        //to check if name submitted exists in database
        if ($this->request->is('post'))
        {
            $name = strip_tags($this->request->data['name']);
            $usersTable = TableRegistry::get('users');

            $checkUser = $usersTable->find('all')->where(['username'=>$name])->toArray();

            if(sizeof($checkUser)!=0){
                $exists = true;
            }


            if($exists){// check if the submitted name exists in the database

                if ($form->execute($this->request->data)) {
                    $this->Flash->success('An Admin has been notified');
                }else{
                    $this->Flash->error('An error has occurred, please try again ');
                }
            }else{
                $this->Flash->error('Username not found. Please enter a valid name');
            }


        }

        $this->set('form', $form);

    }

}
