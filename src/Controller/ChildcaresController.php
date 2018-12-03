<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Childcares Controller
 *
 * @property \App\Model\Table\ChildcaresTable $Childcares
 */
class ChildcaresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $childcares = $this->Childcares->find('all');
//        $this->paginate = [
//            'contain' => ['Children']
//        ];
//        $childcares = $this->paginate($this->Childcares);

        $this->set(compact('childcares'));
        $this->set('_serialize', ['childcares']);
    }

    /**
     * View method
     *
     * @param string|null $id Childcare id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $childcare = $this->Childcares->get($id, [
            'contain' => ['Children']
        ]);

        $this->set('childcare', $childcare);
        $this->set('_serialize', ['childcare']);
    }
	
	public function emergencylist($id = null)
    {
        $childcare = $this->Childcares->get($id, [
            'contain' => ['Children']
        ]);

        $this->set('childcare', $childcare);
        $this->set('_serialize', ['childcare']);
    }
	
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $childcare = $this->Childcares->newEntity();
        if ($this->request->is('post')) {
            $childcare = $this->Childcares->patchEntity($childcare, $this->request->data);
            if ($this->Childcares->save($childcare)) {
                $this->Flash->success(__('The childcare has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcare could not be saved. Please, try again.'));
            }
        }

        $children = $this->Childcares->Children->find('list', ['keyField'=>'id',
            'valueField'=>
                function($row){
                    $dob =  $row['dateOfBirth'];
                    return $row['givenName'].' '.$row['familyName'].' (DoB: '.$dob->format('d/m/Y'). ')';
                }]);
//        $children = $this->Childcares->Children->find('list', ['limit' => 200]);
        $this->set(compact('childcare', 'children'));
        $this->set('_serialize', ['childcare']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Childcare id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $childcare = $this->Childcares->get($id, [
            'contain' => ['Children']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $childcare = $this->Childcares->patchEntity($childcare, $this->request->data);
            if ($this->Childcares->save($childcare)) {
                $this->Flash->success(__('The childcare has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcare could not be saved. Please, try again.'));
            }
        }
        //$children = $this->Childcares->Children->find('list', ['limit' => 200]);

        $children = $this->Childcares->Children->find('list', ['keyField'=>'id',
            'valueField'=>
                function($row){
                   $dob =  $row['dateOfBirth'];
                    return $row['givenName'].' '.$row['familyName'].' (DoB: '.$dob->format('d/m/Y'). ')';
                }]);
        $this->set(compact('childcare', 'children'));
        $this->set('_serialize', ['childcare']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Childcare id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $childcare = $this->Childcares->get($id);
        if ($this->Childcares->delete($childcare)) {
            $this->Flash->success(__('The childcare has been deleted.'));
        } else {
            $this->Flash->error(__('The childcare could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	

}
