<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Hours Controller
 *
 * @property \App\Model\Table\HoursTable $Hours
 */
class HoursController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $hours = $this->Hours
            ->find('all')
            ->contain (['Volunteers', 'Categories']);

        $this->set(compact('hours'));
        $this->set('_serialize', ['hours']);
    }

    /**
     * View method
     *
     * @param string|null $id Hour id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hour = $this->Hours->get($id, [
            'contain' => ['Volunteers', 'Categories']
        ]);
        $this->set('hour', $hour);
        $this->set('_serialize', ['hour']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hour = $this->Hours->newEntity();

        if ($this->request->is('post')) {
            $newDate = date('Y-m-d',strtotime($this->request->data['date']));
            $hour = $this->Hours->patchEntity($hour, $this->request->data);
            $hour->date = $newDate;
            if ($result = $this->Hours->save($hour)) {
					$totalHour = (float)($_POST['single_hours'])+($_POST['minutes']);
					$hoursTable = TableRegistry::get('hours'); //get the hours table
					$thisHour = $hoursTable->get($result->id);
					
					$thisHour->hours = $totalHour;
					$hoursTable->save($thisHour);
                $this->Flash->success(__('The hour has been saved.'));
				//send them back to the volunteers page
                 return $this->redirect(['controller'=>'volunteers','action' => 'view',$hour->volunteer_id]);
            } else {
                $this->Flash->error(__('The hour could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Hours->Volunteers->find('list', ['limit' => 200]);
        $this->set(compact('hour', 'volunteers', 'categories'));
        $this->set('_serialize', ['hour']);
    }
	public function addbymodal($volunteer_id = null)
    {   //thanks bill!
        $this->request->allowMethod(['post']); // allow the method to be called via POST
        //basic add note stuff 
        $hour = $this->Hours->newEntity();
        $hour->volunteer_id=$volunteer_id;
        $newDate = date('Y-m-d',strtotime($this->request->data['date']));
        $hour = $this->Hours->patchEntity($hour, $this->request->data);
        $hour->date = $newDate;
        if ($result= $this->Hours->save($hour)) {
				$totalHour = (float)($_POST['single_hours'])+($_POST['minutes']);
					$hoursTable = TableRegistry::get('hours'); //get the hours table
					$thisHour = $hoursTable->get($result->id);
					$thisHour->hours = $totalHour;
					$hoursTable->save($thisHour);
                $this->Flash->success(__('The hour has been saved.'));
            } else {
                $this->Flash->error(__('The hour could not be saved. Please, try again.'));
            }
            return $this->redirect(['controller' => 'volunteers', 'action' => 'view', $volunteer_id]); 
        //NOTE : for this method to work you must NOT RENDER ANYTHING! e.g. NO $this->set('_serialize',['note']); etc
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Hour id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hour = $this->Hours->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hour = $this->Hours->patchEntity($hour, $this->request->data);
            if ($this->Hours->save($hour)) {
                $this->Flash->success(__('The hour has been saved.'));

                return $this->redirect(['controller'=>'volunteers','action' => 'view',$hour->volunteer_id]);
            } else {
                $this->Flash->error(__('The hour could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Hours->Volunteers->find('list', ['limit' => 200]);
        $this->set(compact('hour', 'volunteers', 'programs'));
        $this->set('_serialize', ['hour']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hour id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hour = $this->Hours->get($id);
        if ($this->Hours->delete($hour)) {
            $this->Flash->success(__('The hour has been deleted.'));
        } else {
            $this->Flash->error(__('The hour could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
