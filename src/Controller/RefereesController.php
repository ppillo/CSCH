<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Referees Controller
 *
 * @property \App\Model\Table\RefereesTable $Referees
 */
class RefereesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $referees = $this->Referees
            ->find('all')
            ->contain (['Volunteers']);

//        $this->paginate = [
//            'contain' => ['Volunteers']
//        ];
//        $referees = $this->paginate($this->Referees);

        $this->set(compact('referees'));
        $this->set('_serialize', ['referees']);
    }

    /**
     * View method
     *
     * @param string|null $id Referee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $referee = $this->Referees->get($id, [
            'contain' => ['Volunteers']
        ]);

        $this->set('referee', $referee);
        $this->set('_serialize', ['referee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $referee = $this->Referees->newEntity();
        if ($this->request->is('post')) {
            $referee = $this->Referees->patchEntity($referee, $this->request->data);
            if ($this->Referees->save($referee)) {
                $this->Flash->success(__('The referee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The referee could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Referees->Volunteers->find('list', ['limit' => 200]);
        $this->set(compact('referee', 'volunteers'));
        $this->set('_serialize', ['referee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Referee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $referee = $this->Referees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referee = $this->Referees->patchEntity($referee, $this->request->data);
            if ($this->Referees->save($referee)) {
                $this->Flash->success(__('The referee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The referee could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Referees->Volunteers->find('list', ['limit' => 200]);
        $this->set(compact('referee', 'volunteers'));
        $this->set('_serialize', ['referee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Referee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $referee = $this->Referees->get($id);
        if ($this->Referees->delete($referee)) {
            $this->Flash->success(__('The referee has been deleted.'));
        } else {
            $this->Flash->error(__('The referee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function deleteFromEdit($id = null)
    { 
        $memberTable = TableRegistry::get('members');
        $volunteerTable = TableRegistry::get('volunteers');
        $referee = $this->Referees->get($id);
        $volunteerID = $referee->volunteer_id;
        
        $volunteer = $volunteerTable->get($volunteerID);
        
        $memberID = $volunteer->member_id;
        
        if ($this->Referees->delete($referee)) {
            $this->Flash->success(__('The referee has been deleted.'));
        } else {
            $this->Flash->error(__('The referee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'members', 'action' => 'edit', $memberID]); 
    }
    
}
