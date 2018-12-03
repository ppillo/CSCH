<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ChildcaresChildren Controller
 *
 * @property \App\Model\Table\ChildcaresChildrenTable $ChildcaresChildren
 */
class ChildcaresChildrenController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Children', 'Childcares']
        ];
        $childcaresChildren = $this->paginate($this->ChildcaresChildren);

        $this->set(compact('childcaresChildren'));
        $this->set('_serialize', ['childcaresChildren']);
    }

    /**
     * View method
     *
     * @param string|null $id Childcares Child id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $childcaresChild = $this->ChildcaresChildren->get($id, [
            'contain' => ['Children', 'Childcares']
        ]);

        $this->set('childcaresChild', $childcaresChild);
        $this->set('_serialize', ['childcaresChild']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $childcaresChild = $this->ChildcaresChildren->newEntity();
        if ($this->request->is('post')) {
            $childcaresChild = $this->ChildcaresChildren->patchEntity($childcaresChild, $this->request->data);
            if ($this->ChildcaresChildren->save($childcaresChild)) {
                $this->Flash->success(__('The childcares child has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcares child could not be saved. Please, try again.'));
            }
        }
        $children = $this->ChildcaresChildren->Children->find('list', ['limit' => 200]);
        $childcares = $this->ChildcaresChildren->Childcares->find('list', ['limit' => 200]);
        $this->set(compact('childcaresChild', 'children', 'childcares'));
        $this->set('_serialize', ['childcaresChild']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Childcares Child id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $childcaresChild = $this->ChildcaresChildren->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $childcaresChild = $this->ChildcaresChildren->patchEntity($childcaresChild, $this->request->data);
            if ($this->ChildcaresChildren->save($childcaresChild)) {
                $this->Flash->success(__('The childcares child has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcares child could not be saved. Please, try again.'));
            }
        }
        $children = $this->ChildcaresChildren->Children->find('list', ['limit' => 200]);
        $childcares = $this->ChildcaresChildren->Childcares->find('list', ['limit' => 200]);
        $this->set(compact('childcaresChild', 'children', 'childcares'));
        $this->set('_serialize', ['childcaresChild']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Childcares Child id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $childcaresChild = $this->ChildcaresChildren->get($id);
        if ($this->ChildcaresChildren->delete($childcaresChild)) {
            $this->Flash->success(__('The childcares child has been deleted.'));
        } else {
            $this->Flash->error(__('The childcares child could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
