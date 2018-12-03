<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CustodiansChildren Controller
 *
 * @property \App\Model\Table\CustodiansChildrenTable $CustodiansChildren
 */
class CustodiansChildrenController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Custodians', 'Children']
        ];
        $custodiansChildren = $this->paginate($this->CustodiansChildren);

        $this->set(compact('custodiansChildren'));
        $this->set('_serialize', ['custodiansChildren']);
    }

    /**
     * View method
     *
     * @param string|null $id Custodians Child id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $custodiansChild = $this->CustodiansChildren->get($id, [
            'contain' => ['Custodians', 'Children']
        ]);

        $this->set('custodiansChild', $custodiansChild);
        $this->set('_serialize', ['custodiansChild']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $custodiansChild = $this->CustodiansChildren->newEntity();
        if ($this->request->is('post')) {
            $custodiansChild = $this->CustodiansChildren->patchEntity($custodiansChild, $this->request->data);
            if ($this->CustodiansChildren->save($custodiansChild)) {
                $this->Flash->success(__('The custodians child has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custodians child could not be saved. Please, try again.'));
            }
        }
        $custodians = $this->CustodiansChildren->Custodians->find('list', ['limit' => 200]);
        $children = $this->CustodiansChildren->Children->find('list', ['limit' => 200]);
        $this->set(compact('custodiansChild', 'custodians', 'children'));
        $this->set('_serialize', ['custodiansChild']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custodians Child id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $custodiansChild = $this->CustodiansChildren->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $custodiansChild = $this->CustodiansChildren->patchEntity($custodiansChild, $this->request->data);
            if ($this->CustodiansChildren->save($custodiansChild)) {
                $this->Flash->success(__('The custodians child has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custodians child could not be saved. Please, try again.'));
            }
        }
        $custodians = $this->CustodiansChildren->Custodians->find('list', ['limit' => 200]);
        $children = $this->CustodiansChildren->Children->find('list', ['limit' => 200]);
        $this->set(compact('custodiansChild', 'custodians', 'children'));
        $this->set('_serialize', ['custodiansChild']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custodians Child id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $custodiansChild = $this->CustodiansChildren->get($id);
        if ($this->CustodiansChildren->delete($custodiansChild)) {
            $this->Flash->success(__('The custodians child has been deleted.'));
        } else {
            $this->Flash->error(__('The custodians child could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
