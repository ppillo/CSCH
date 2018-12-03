<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Childcontacts Controller
 *
 * @property \App\Model\Table\ChildcontactsTable $Childcontacts
 */
class ChildcontactsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $childcontacts = $this->Childcontacts
            ->find('all')
            ->contain('Children');
//        $this->paginate = [
//            'contain' => ['Children']
//        ];
//        $childcontacts = $this->paginate($this->Childcontacts);

        $this->set(compact('childcontacts'));
        $this->set('_serialize', ['childcontacts']);
    }

    /**
     * View method
     *
     * @param string|null $id Childcontact id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $childcontact = $this->Childcontacts->get($id, [
            'contain' => ['Children']
        ]);

        $this->set('childcontact', $childcontact);
        $this->set('_serialize', ['childcontact']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $childcontact = $this->Childcontacts->newEntity();
        if ($this->request->is('post')) {
            $childcontact = $this->Childcontacts->patchEntity($childcontact, $this->request->data);
            if ($this->Childcontacts->save($childcontact)) {
                $this->Flash->success(__('The childcontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcontact could not be saved. Please, try again.'));
            }
        }
        $children = $this->Childcontacts->Children->find('list', ['limit' => 200]);
        $this->set(compact('childcontact', 'children'));
        $this->set('_serialize', ['childcontact']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Childcontact id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $childcontact = $this->Childcontacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $childcontact = $this->Childcontacts->patchEntity($childcontact, $this->request->data);
            if ($this->Childcontacts->save($childcontact)) {
                $this->Flash->success(__('The childcontact has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The childcontact could not be saved. Please, try again.'));
            }
        }
        $children = $this->Childcontacts->Children->find('list', ['limit' => 200]);
        $this->set(compact('childcontact', 'children'));
        $this->set('_serialize', ['childcontact']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Childcontact id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $childcontact = $this->Childcontacts->get($id);
        if ($this->Childcontacts->delete($childcontact)) {
            $this->Flash->success(__('The childcontact has been deleted.'));
        } else {
            $this->Flash->error(__('The childcontact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	
	public function deleteFromEdit($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		
        $childcontact = $this->Childcontacts->get($id);
        $childID = $childcontact->children_id;
		if ($this->Childcontacts->delete($childcontact)) {
            $this->Flash->success(__('The childcontact has been deleted.'));
        } else {
            $this->Flash->error(__('The childcontact could not be deleted. Please, try again.'));
        }

            return $this->redirect(['controller' => 'children', 'action' => 'edit', $childID]); 
    }
	
}
