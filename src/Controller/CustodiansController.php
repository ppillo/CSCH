<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Custodians Controller
 *
 * @property \App\Model\Table\CustodiansTable $Custodians
 */
class CustodiansController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $custodians = $this->Custodians
            ->find('all')
        ->contain(['Members']);
//        $this->paginate = [
//            'contain' => ['Members']
//        ];
//        $custodians = $this->paginate($this->Custodians);

        $this->set(compact('custodians'));
        $this->set('_serialize', ['custodians']);
    }

    /**
     * View method
     *
     * @param string|null $id Custodian id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $custodian = $this->Custodians->get($id, [
            'contain' => ['Members','Children']
        ]);

        $this->set('custodian', $custodian);
        $this->set('_serialize', ['custodian']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $custodian = $this->Custodians->newEntity();
        if ($this->request->is('post')) {
            $custodian = $this->Custodians->patchEntity($custodian, $this->request->data);
            if ($this->Custodians->save($custodian)) {
                $this->Flash->success(__('The custodian has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custodian could not be saved. Please, try again.'));
            }
        }
		$members = $this->Custodians->Members->find('list', ['keyField'=>'id','valueField'=>
            function($row){
            return $row['givenName'].' '.$row['familyName'].' (:'.$row['streetAddress'].')';
         }]); 
        $children = $this->Custodians->Children->find('list', ['keyField'=>'id', 
        'valueField'=>
        function($row){
             return $row['givenName'].' '.$row['familyName'];
         }]);
        $this->set(compact('custodian', 'members', 'children'));
        $this->set('_serialize', ['custodian']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custodian id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $custodian = $this->Custodians->get($id, [
            'contain' => ['Children']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $custodian = $this->Custodians->patchEntity($custodian, $this->request->data);
            if ($this->Custodians->save($custodian)) {
                $this->Flash->success(__('The custodian has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custodian could not be saved. Please, try again.'));
            }
        }
     $members = $this->Custodians->Members->find('list', ['keyField'=>'id','valueField'=>
            function($row){
            return $row['givenName'].' '.$row['familyName'];
         }]); 
        $children = $this->Custodians->Children->find('list', ['keyField'=>'id', 
        'valueField'=>
        function($row){
             return $row['givenName'].' '.$row['familyName'];
         }]);
        $this->set(compact('custodian', 'members','children'));
        $this->set('_serialize', ['custodian']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custodian id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $custodian = $this->Custodians->get($id);
        if ($this->Custodians->delete($custodian)) {
            $this->Flash->success(__('The custodian has been deleted.'));
        } else {
            $this->Flash->error(__('The custodian could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
