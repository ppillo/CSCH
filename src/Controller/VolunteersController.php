<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Volunteers Controller
 *
 * @property \App\Model\Table\VolunteersTable $Volunteers
 */
class VolunteersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $volunteers = $this->Volunteers
            ->find('all')
            -> contain (['Members', 'Categories']);

        $this->set(compact('volunteers'));
        $this->set('_serialize', ['volunteers']);
    }

    /**
     * View method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $volunteer = $this->Volunteers->get($id, [
            'contain' => ['Members', 'Categories', 'Referees','Hours']
        ]); 
		
		$programsTable = TableRegistry::get('programs');
        $programs = $programsTable->find('list',
			['keyField'=>'id','valueField'=>'name']);
		$categories = $this->Volunteers->Categories->find('list', ['limit' => 200]);
        $this->set('volunteer', $volunteer);
		$this->set(compact('programs','categories'));
        $this->set('_serialize', ['volunteer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $volunteer = $this->Volunteers->newEntity();
        if ($this->request->is('post')) {
            $volunteer = $this->Volunteers->patchEntity($volunteer, $this->request->data);
            if ($this->Volunteers->save($volunteer)) {
					if($_POST['refereeNum']==1){
						//save only 1 referee
						$this->request->data['referees']['volunteer_id'] = $result->id;
						$referee = $this->Volunteers->Referees->newEntity();
						$referee = $this->Volunteers->Referees->patchEntity($referee, $this->request->data['referees']);
						$this->Volunteers->Referees->save($referee); 	
					}
					if($_POST['refereeNum']==2){
						//save 2 referees 
						$ref1 = $this->Volunteers->Referees->newEntity(); //create a new referee entity
						$ref1 = $this->Volunteers->Referees->patchEntity($ref1, $this->request->data['referee1']); //patch said entity with the data provided in the from
						$ref1->volunteer_id = $result->id; // set this referee's volunteer_id as THIS VOLUNTEER's ID
						$this->Volunteers->Referees->save($ref1); //save it.
				
						//do it all over again. 
						$ref2 = $this->Volunteers->Referees->newEntity();
						$ref2 = $this->Volunteers->Referees->patchEntity($ref2, $this->request->data['referee2']);
						$ref2->volunteer_id = $result->id;
						$this->Volunteers->Referees->save($ref2); 
					}		
				$this->Flash->success(__('The volunteer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
            }
        }
        $members = $this->Volunteers->Members->find('list',
			['keyField'=>'id','valueField'=>
            function($row){
            return $row['givenName'].' '.$row['familyName'].' (id:'.$row['id'].')';
         }])->where(['tier'=>'V','active'=>1]); //get the volunteers - and the ONLY ones that are ACTIVE, AND in VOLUNTEERS tier.
        $categories = $this->Volunteers->Categories->find('list', ['limit' => 200]);
        $this->set(compact('volunteer', 'members', 'categories'));
        $this->set('_serialize', ['volunteer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $volunteer = $this->Volunteers->get($id, [
            'contain' => ['Referees']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $volunteer = $this->Volunteers->patchEntity($volunteer, $this->request->data);
            if ($this->Volunteers->save($volunteer)) {
                $this->Flash->success(__('The volunteer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
            }
        }
        $members = $this->Volunteers->Members->find('list', ['limit' => 200]);
        $categories = $this->Volunteers->Categories->find('list', ['limit' => 200]);
        $this->set(compact('volunteer', 'members', 'categories'));
        $this->set('_serialize', ['volunteer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $volunteer = $this->Volunteers->get($id);
        if ($this->Volunteers->delete($volunteer)) {
            $this->Flash->success(__('The volunteer has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
