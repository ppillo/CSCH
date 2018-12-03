<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Programs Controller
 *
 * @property \App\Model\Table\ProgramsTable $Programs
 */
class ProgramsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $programs = $this->Programs
            ->find('all')
        ->contain('Categories');
//     $this->paginate = [
//         'contain' => ['Categories']
//      ];
//     $programs = $this->paginate($this->Programs);

        $this->set(compact('programs'));
        $this->set('_serialize', ['programs']);
    }

    /**
     * View method
     *
     * @param string|null $id Program id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $program = $this->Programs->get($id, [
            'contain' => ['Categories', 'Members']
        ]);

        $this->set('program', $program);
        $this->set('_serialize', ['program']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $program = $this->Programs->newEntity();
        if ($this->request->is('post')) {
			
            $program = $this->Programs->patchEntity($program, $this->request->data);
            $newDate = date('Y-m-d H:i',strtotime($this->request->data['date']));
			$programsMembersTable = TableRegistry::get('members_programs');
			$programsTable = TableRegistry::get('programs');
            $program = $this->Programs->patchEntity($program, $this->request->data);

            $program->description = strip_tags($_POST['description']);


            $program->date = $newDate;
			$clashingMembers = [];
			
			//check if the member is in 2 programs with the same date & time
			foreach($program->members as $members){
				$enrolledPrograms = $programsMembersTable->find('all')->where(['member_id'=>$members->id])->toArray();
					foreach($enrolledPrograms as $checkPrograms){
							if($checkPrograms->program_id != $program->id){
								$thisProgramsDate = date_format($programsTable->get($checkPrograms->program_id)->date, 'Y-m-d H:i');
								if(strtotime($thisProgramsDate) == strtotime($program->date)){
									debug('MEMBER ID = '.$members->id.' CLASHING PROGRAMS');
									$clashingMembers[] = $members->givenName.' '.$members->familyName;
									
								}
								
							}
					}
				
			}
			
			
			
			if ($this->Programs->save($program)) {
				if(sizeof($clashingMembers)!=0){ //if there are clashing members....
					$members = "";
					foreach($clashingMembers as $clashes){
						$members = $members."".$clashes." ," ;
					}
					$this->Flash->success(__('The program has been saved.'));
					$this->Flash->success(__('NOTE : There are Members in this program that are enrolled in other Programs with the same date and time.'));
					return $this->redirect(['action' => 'view',$program->id]); 
				}
				else{ //if not, save as usual.
					$this->Flash->success(__('The program has been saved.'));
					return $this->redirect(['action' => 'index']);
				}
                
            } else {
                $this->Flash->error(__('The program could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Programs->Categories->find('list', ['limit' => 200]);
        $members = $this->Programs->Members->find('list', ['keyField'=>'id','valueField'=>'concatenated']);
		//Gets the givenName and familyName from the Members table.
		$members
			->select([
				'id',
				'concatenated' => $members->func()->concat([ // concatenate givenName and familyName.
				'givenName' => 'literal', 
				' ',
				'familyName' => 'literal',
				' (Mobile : ',
				'Members.mobilePhone'=>'literal',
				')'
			])
		]);
        $this->set(compact('program', 'categories', 'members'));
        $this->set('_serialize', ['program']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Program id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $program = $this->Programs->get($id, [
            'contain' => ['Members']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $newDate = date('Y-m-d H:i',strtotime($this->request->data['date']));
            $desc= $this->request->data['description'];
			$programsMembersTable = TableRegistry::get('members_programs');
			$programsTable = TableRegistry::get('programs');
            $program = $this->Programs->patchEntity($program, $this->request->data);

            $program->description = strip_tags($desc);
            $program->date = $newDate;
			$clashingMembers = [];
			
			//check if the member is in 2 programs with the same date & time
			foreach($program->members as $members){
				$enrolledPrograms = $programsMembersTable->find('all')->where(['member_id'=>$members->id])->toArray();
					foreach($enrolledPrograms as $checkPrograms){
							if($checkPrograms->program_id != $program->id){
								$thisProgramsDate = date_format($programsTable->get($checkPrograms->program_id)->date, 'Y-m-d H:i');
								if(strtotime($thisProgramsDate) == strtotime($program->date)){
									$clashingMembers[] = $members->givenName.' '.$members->familyName;
									
								}
								
							}
					}
				
			}
			

            if ($this->Programs->save($program)) {
				if(sizeof($clashingMembers)!=0){
					$members = "";
					foreach($clashingMembers as $clashes){
						
						$members = $members."".$clashes." ," ;
					
					}
					$this->Flash->success(__('The program has been saved.'));
					$this->Flash->success(__('The Following Members are in Clashing Programs : '.$members));
					return $this->redirect(['action' => 'edit', $program->id]); //refresh the edit page.
				}
				else{
					$this->Flash->success(__('The program has been saved.'));
					return $this->redirect(['action' => 'index']);
				}
                
            } else {
                $this->Flash->error(__('The program could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Programs->Categories->find('list', ['limit' => 200]);
        $members = $this->Programs->Members->find('list', ['keyField'=>'id','valueField'=>'concatenated']);
		//Gets the givenName and familyName from the Members table.
		$members
			->select([
				'id',
				'concatenated' => $members->func()->concat([ // concatenate givenName and familyName.
				'givenName' => 'literal', 
				' ',
				'familyName' => 'literal',
				' (Mobile : ',
				'Members.mobilePhone'=>'literal',
				')'
			])
		]);
        $this->set(compact('program', 'categories', 'members'));
        $this->set('_serialize', ['program']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Program id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $program = $this->Programs->get($id);
        if ($this->Programs->delete($program)) {
            $this->Flash->success(__('The program has been deleted.'));
        } else {
            $this->Flash->error(__('The program could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
