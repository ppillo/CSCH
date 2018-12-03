<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
{
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
         $notes = $this->Notes->find('all');

//        $this->paginate = [
//            'contain' => ['Children']
//        ];
//        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Children']
        ]);

        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
			$newDesc = strip_tags($this->request->data['description']);
            $noteDate = date('Y-m-d',strtotime($this->request->data['date']));

            $note = $this->Notes->patchEntity($note, $this->request->data);
			$note->description = $newDesc;
            $note->date = $noteDate;

            if ($result = $this->Notes->save($note)) {  
				$noteTable = TableRegistry::get('Notes');
				//upload the image
				if (!empty($this->request->data['image'])) { // if image exists, upload it.
                //upload image if user has selected one
                //calls uploadFiles function in AppController.php
				$imgName = 'note_'.$result->id; // set the image name here. in this case it will be member_000 <- where 000 = memberID
				//debug($imgName);
                $fileOK = $this->uploadFiles('notes', $this->request->data['image'],$imgName); //uploads the file WITH the desired image name.
                //debug($fileOK = $this->uploadFiles('img/images', $this->request->data['image']));
                if (array_key_exists('urls', $fileOK)) {
					$ext = strstr($fileOK['urls'][0],'.'); // get the uploaded file's extension.
					//debug($ext);
					//if image is uploaded, update the newly-inserted member's image.
                    //$this->request->data['image'] = $fileOK['urls'][0];
                    //$member->set('image', $fileOK['urls'][0]);
					$imgName = $imgName.$ext;
					$thisNote = $noteTable->get($result->id);
					$thisNote->image = $imgName;
					$noteTable->save($thisNote);
					$hasimage = true;
				} else {
                    $this->request->data['image'] = null;
					$hasimage = false;
                    //$this->Flash->error('Can not upload image.');
				}
				}
				$children_id = $result->children_id;
				$this->Flash->success(__('The note has been saved.'));
				return $this->redirect(['controller' => 'children', 'action' => 'view', $children_id]);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $children = $this->Notes->Children->find('list', ['limit' => 2000]);
        $this->set(compact('note', 'children'));
        $this->set('_serialize', ['note']);
    }
    
    public function addbymodal($children_id = null)
    {   //thanks bill!
        //$this->request->allowMethod(['post','file']); // allow the method to be called via POST
        //basic add note stuff 
        $note = $this->Notes->newEntity();

        $note->children_id=$children_id;
		
        $noteTable = TableRegistry::get('Notes');
		
		
        $noteDate = date('Y-m-d',strtotime($this->request->data['date']));

        $note = $this->Notes->patchEntity($note, $this->request->data);
		//debug($this->request->data['description']);
		$newDesc = strip_tags((string)$this->request->data['description']);
		$note->description = $newDesc;
        $note->date = $noteDate;

            if ($result = $this->Notes->save($note)) {
                
                //debug($this->request->data);
                
                
                
                if (!empty($this->request->data['image'])) { // if image exists, upload it.
                //upload image if user has selected one
                //calls uploadFiles function in AppController.php
                //debug($this->request->data['image']);
				$imgName = 'note_'.$result->id; // set the image name here. in this case it will be member_000 <- where 000 = memberID
				//debug($imgName);
                $fileOK = $this->uploadFiles('notes', $this->request->data['image'],$imgName); //uploads the file WITH the desired image name.
                //debug($fileOK = $this->uploadFiles('img/images', $this->request->data['image']));
                //debug($fileOK);
                     
                if (array_key_exists('urls', $fileOK)) {
					$ext = strstr($fileOK['urls'][0],'.'); // get the uploaded file's extension.
					//debug($ext);
					//if image is uploaded, update the newly-inserted member's image.
                    //$this->request->data['image'] = $fileOK['urls'][0];
                    //$member->set('image', $fileOK['urls'][0]);
					$imgName = $imgName.$ext;
					$thisNote = $noteTable->get($result->id);
					$thisNote->image = $imgName;
					$noteTable->save($thisNote);
					$hasimage = true;
				} else {
                    $this->request->data['image'] = null;
					$hasimage = false;
                    //$this->Flash->error('Can not upload image.');
				}
                 
				}
                
				
                $this->Flash->success(__('The note has been saved.'));
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
            return $this->redirect($this->referer());
            //return $this->redirect(['controller' => 'children', 'action' => 'view', $children_id]);
        //NOTE : for this method to work you must NOT RENDER ANYTHING! e.g. NO $this->set('_serialize',['note']); etc
		}
	
    

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newDate = date('Y-m-d',strtotime($this->request->data['date']));
			$newDesc = strip_tags($this->request->data['description']);
            $note = $this->Notes->patchEntity($note, $this->request->data);
			
			
			$note->description = newDesc;
            $note->date = $newDate;

            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $children = $this->Notes->Children->find('list', ['limit' => 200]);
        $this->set(compact('note', 'children'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
