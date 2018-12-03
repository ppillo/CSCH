<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
/**
 * Children Controller
 *
 * @property \App\Model\Table\ChildrenTable $Children
 */
class ChildrenController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    
		
	public function emergencylist($id = null)
    {
         $children = $this->Children->find('all',[
            'contain' => ['Childcares', 'Custodians','Childcontacts','Notes']
        ]);
//        $this->paginate = [
//
//           // 'limit' => 2000,
//            'Children.givenName' => 'asc',
//        ];
//        $children = $this->paginate($this->Children);

        $this->set(compact('children'));
        $this->set('_serialize', ['children']);
	}
	
	public function index()
    {


        $children = $this->Children->find('all');
//        $this->paginate = [
//
//           // 'limit' => 2000,
//            'Children.givenName' => 'asc',
//        ];
//        $children = $this->paginate($this->Children);

        $this->set(compact('children'));
        $this->set('_serialize', ['children']);
    }

    /**
     * View method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $child = $this->Children->get($id, [
            'contain' => ['Childcares', 'Custodians','Childcontacts','Notes']
        ]);
        $this->set('child', $child);
        $this->set('_serialize', ['child']);
	}

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
        $child = $this->Children->newEntity();
		
		//get the tables, to be used later.
		$custodianChildrenTable =  TableRegistry::get('custodians_children');
		$custodianTable = TableRegistry::get('custodians'); 
		
		if ($this->request->is('post')) {

            $newDateDOB = date('Y-m-d',strtotime($this->request->data['dateOfBirth']));
                
            
            
             $data = $this->request->data;   
            foreach($data as &$data_values){ //cleans ALL html tags.
                if(is_array($data_values)){
                    
                    foreach($data_values as &$inner_values){ 
                        if(is_array($inner_values)){
                            foreach($inner_values as &$inner_inner_values){
                                $inner_inner_values = strip_tags($inner_inner_values);
                            }   
                        }else{
                        $inner_values = strip_tags($inner_values);
                        }
                    }
                    
                }else{
                    
                    $data_values = strip_tags($data_values); 
                }
               
            }
            
            
            
            

            $child = $this->Children->patchEntity($child, $data,['associated' => ['Childcares', 'Custodians','Childcontacts','Notes']]);
			$child->dateOfBirth = $newDateDOB;

            $checkID = $data['custodians']['_ids']; //store the chosen custodian ID
			//record the custodian IDs.
			$extraCustodianIDs = array();
			$numberOfCustodian = $this->request->data['additionalCustodians'];
			for($i=1;$i<=$numberOfCustodian;$i++){
				$custNo = 'custodians'.$i;
				$extraCustodianIDs[] = $this->request->data[$custNo]['_ids']; //store the extra custodians
			}   
			//Store the primaryID
			$primaryID = $data['custodians']['_ids'];
			$child->primary_custodian = $primaryID; 
			
			$hasImage = false; // A boolean to determine wether or not this child has an image.
            if ($result = $this->Children->save($child)) { 
				$childrenTable = TableRegistry::get('children'); //get the children table
				if (!empty($this->request->data['image'])) { // if image exists, upload it.
                //upload image if user has selected one
                //calls uploadFiles function in AppController.php
				$imgName = 'child_'.$result->id; // set the image name here. in this case it will be children_yyy <- where yyy = memberID
                $fileOK = $this->uploadFiles('img/images/children', $this->request->data['image'],$imgName); //uploads the file WITH the desired image name.
				if (array_key_exists('urls', $fileOK)) {
					$ext = strstr($fileOK['urls'][0],'.'); // get the uploaded file's extension. 
					$imgName = $imgName.$ext;
					$thisChild = $childrenTable->get($result->id);
					$thisChild->image = $imgName;
					$childrenTable->save($thisChild);
					$hasImage = true;
				} else {
                    $this->request->data['image'] = null;
					$hasImage = false; 
					} 
				}
				 //save the childcontacts AFTER saving the child.
					//This saves the primary child contact.
                $this->request->data['childcontacts1']['children_id'] = $result->id;
                $cc = $this->Children->Childcontacts->newEntity();
                $cc = $this->Children->Childcontacts->patchEntity($cc, $data['childcontacts1']); 
                $cc->children_id = $result->id;
				$this->Children->ChildContacts->save($cc);
					//debug($cc->errors());
				
				
                if($this->request->data('moreContacts')!= 0) {
                    //save the second contacts
					//the second contact will ALWAYS exist if it's not 0.
                    $cc2 = $this->Children->Childcontacts->newEntity();
                    $cc2 = $this->Children->Childcontacts->patchEntity($cc2, $data['childcontacts2']);
                    $cc2->children_id = $result->id;
                    $this->Children->Childcontacts->save($cc2); //save it.
					if($this->request->data('moreContacts')==2){//If there's THREE contacts, save the third one.
						$cc3 = $this->Children->Childcontacts->newEntity();
						$cc3 = $this->Children->Childcontacts->patchEntity($cc3, $data['childcontacts3']);
						$cc3->children_id = $result->id;
						$this->Children->Childcontacts->save($cc3); //save it.
					}
					if($this->request->data('moreContacts')==3){//If there's FOUR contacts, save the third one AND the fourth one.
						$cc3 = $this->Children->Childcontacts->newEntity();
						$cc3 = $this->Children->Childcontacts->patchEntity($cc3, $data['childcontacts3']);
						$cc3->children_id = $result->id;
						$this->Children->Childcontacts->save($cc3); //save it.
						
						$cc4 = $this->Children->Childcontacts->newEntity();
						$cc4 = $this->Children->Childcontacts->patchEntity($cc4, $data['childcontacts4']);
						$cc4->children_id = $result->id;
						$this->Children->Childcontacts->save($cc4); //save it.
					
					}
                }
				
				
				
				
				//For some reason, using chosen-select (the one we CURRENTLY use, not the 'default' where you can choose a bunch at once), won't automatically
				//Insert the custodian. So, yeah. Time to insert them MANUALLY. Also we're using $primaryID.
				$primaryCustodian = $custodianChildrenTable->newEntity();
				$primaryCustodian->custodian_id = $primaryID;
				$primaryCustodian->child_id = $result->id;
				//UPDATE, 8 JAN 2017 : relationshipToChild AND childLivingWithYou is now in the JOIN table!
				$primaryCustodian->relationshipToChild = $this->request->data['custodians']['relationshipToChild']; 
				if($this->request->data['custodians']['childLivingWithYou'] == '0'){
				$primaryCustodian->childLivingWithYou = false;
				}
				else{
				$primaryCustodian->childLivingWithYou = true;
				}
				$custodianChildrenTable->save($primaryCustodian);
				//Update the custodian. 
				$updatePrimaryCust = $custodianTable->get($primaryID);//get the custodian.
				$updatePrimaryCust = $this->Children->Custodians->patchEntity($updatePrimaryCust, $this->request->data['custodians']);
				$this->Children->Custodians->save($updatePrimaryCust);
				
				if(!empty($extraCustodianIDs)){ // there ARE extra custodians! insert them to the join table!
					$i=0;
					foreach($extraCustodianIDs as $extraCust){
								$i = $i+1;
								$custNo = 'custodians'.$i;  
								//insert the extra custodians
								$extraCustodian = $custodianChildrenTable->newEntity();
								$extraCustodian->custodian_id = $extraCust;
								$extraCustodian->child_id = $result->id; 
								$extraCustodian->relationshipToChild = $this->request->data['custodians']['relationshipToChild']; 
								if($this->request->data['custodians']['childLivingWithYou'] == '0'){
									$extraCustodian->childLivingWithYou = false;
								}
								else{
									$extraCustodian->childLivingWithYou = true;
								}
								$custodianChildrenTable->save($extraCustodian); 
								//update the extra custodian              
								$updateCustodian = $custodianTable->get($extraCust);//get the custodian. 
								$updateCustodian = $this->Children->Custodians->patchEntity($updateCustodian, $this->request->data[$custNo]); //patch the entity with the data from the current custodian's form. (custodian1, custodian2...)
								$this->Children->Custodians->save($updateCustodian);
								
					}
				} 
				if($this->request->data['notes']['date']!="" && $this->request->data['notes']['description']!="" ){	
					//save the notes.
					$this->request->data['notes']['children_id'] = $result->id;

					$note = $this->Children->Notes->newEntity();

                    $newDate = date('Y-m-d',strtotime($this->request->data['notes']['date']));

					$note = $this->Children->Notes->patchEntity($note,$this->request->data['notes']);

                    $note->date = $newDate;
                    $note->description = strip_tags($note->description);
					$this->Children->Notes->save($note);	
					}
                
				if($hasImage == true){
					$this->Flash->success(__('The child has been saved.'));
				}
				else{
					$this->Flash->success(__('The child has been saved. (No Images)'));
				}

             return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The child could not be saved. Please, try again.'));
			}
        }
        $childcares = $this->Children->Childcares->find('list', 
        //combines the day and time row value
        ['keyField' => 'id',
         'valueField' => function($row){
             return $row['type'].' - '.$row['day'].' , '.$row['starttime']. ' - '.$row['endtime'] ;
         }
        ]);
		$childcares->order(['type'=> 'ASC']);
		
		
        $custodians = $this->Children->Custodians->find('list', ['keyField'=>'id','valueField'=>'concatenated']);
		//Gets the givenName and familyName from the Members table.
		$custodians
			->select([
				'id',
				'concatenated' => $custodians->func()->concat([ // concatenate givenName and familyName.
				'givenName' => 'literal', 
				' ',
				'familyName' => 'literal',
				' (Address : ',
				'Members.streetAddress'=>'literal',
				')'
			])
		])
		->contain(['Members']); // this means, 'hey', inner join this table (custodians) with members.
		$this->set(compact('child', 'childcares', 'custodians'));
        $this->set('_serialize', ['child']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $child = $this->Children->get($id, [
            'contain' => ['Childcares', 'Custodians','Childcontacts','Notes']
        ]); 
		$childrenTable = TableRegistry::get('children'); //get the children table
		$ccTable = TableRegistry::get('childcontacts'); //get the child_contacts table
		//get the tables, to be used later.
		$custodianChildrenTable =  TableRegistry::get('custodians_children');
		$custodianTable = TableRegistry::get('custodians'); 
		//welp, we had to change how the childcontacts work now -_- anyway, we'll need to get the ids and put them into an array.
		$ccID = array(); // used to store the childcontacts ID later. 
		if(sizeof($child->childcontacts) == 0){ 
			$exists = false; //a boolean value that we'll use to determine wheter or not we'll need to create a new Child Conctacts, or just update an existing one. In this case We'll only need to update it.	
		}
		 else{
			$exists = true;
			foreach($child->childcontacts as $cc){
				$ccID[] = $cc->id; // get the child contact's ID 
			}  
		}	 
		
		$extraCustodianIDs = array();//get all custodians linked to this one particular child. that is NOT the primaryCustodian
		foreach($child->custodians as $cust){
				$extraCustodianIDs[] = $cust->id; // get the child custodian's IDs
		}  
		//I'll have to admit that I have no Idea why the all are deleted upon clicking the 'submit' button.
		if(($key = array_search($child->primary_custodian, $extraCustodianIDs)) !== false) {
			unset($extraCustodianIDs[$key]); // get the primary custodian OUT of the array. This will either leave us with an empty array, or an array with <4 values.
		}
		else if($child->primary_custodian == 0){
			array_pop($extraCustodianIDs); //the child doesn't have a primary custodian. leave this empty.
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newDateDOB = date('Y-m-d',strtotime($this->request->data['dateOfBirth']));
            
            
            
             $data = $this->request->data;   
            foreach($data as &$data_values){ //cleans ALL html tags.
                if(is_array($data_values)){
                    
                    foreach($data_values as &$inner_values){ 
                        if(is_array($inner_values)){
                            foreach($inner_values as &$inner_inner_values){
                                $inner_inner_values = strip_tags($inner_inner_values);
                            }   
                        }else{
                        $inner_values = strip_tags($inner_values);
                        }
                    }
                    
                }else{
                    
                    $data_values = strip_tags($data_values); 
                }
               
            }
			
			$oldImageName = $child->image;
            
            $child = $this->Children->patchEntity($child, $data);
            $child->dateOfBirth = $newDateDOB;
			
				$child->image = $oldImageName;

				$hasImage = $_FILES['image']['size'];  //check if a file is chosen.
				$newImage = false ; // a boolean value to determine wheter or not we'll need to upload a new image
				if($hasImage !=0){ //if $hasImage's size is more than 0 then the user has chosen a file.
						$newImage = true;
					}   
            if ($result = $this->Children->save($child)) { 
				if ($newImage == true) {
					if (!empty($this->request->data['image'])) { // if image exists, upload it.
					//upload image if user has selected one
					//calls uploadFiles function in AppController.php
					$imgName = 'child_'.$result->id; // set the image name here. in this case it will be children_yyy <- where yyy = memberID
					//debug($imgName);
					$fileOK = $this->uploadFiles('img/images/children', $this->request->data['image'],$imgName); //uploads the file WITH the desired image name.
					//debug($fileOK = $this->uploadFiles('img/images', $this->request->data['image']));
                if (array_key_exists('urls', $fileOK)) {
					$ext = strstr($fileOK['urls'][0],'.'); // get the uploaded file's extension.
					//debug($ext);
					//if image is uploaded, update the newly-inserted member's image.
                    //$this->request->data['image'] = $fileOK['urls'][0];
                    //$member->set('image', $fileOK['urls'][0]);
					$imgName = $imgName.$ext;
					$thisChild = $childrenTable->get($result->id);
					$thisChild->image = $imgName;
					$childrenTable->save($thisChild);
					} 
					else {
                    $this->request->data['image'] = null;
                    $this->Flash->error('Can not upload image.');
						} 
					}
				}
				
				else{
					//debug('no new image');
					//don't insert any new image, but update the image name anyway.
					//why? because when you update the child WITHOUT changing the image, Cake will leave the image field empty.
					//why is it empty? because there's no image name field in the (actual) edit form, and when the child is saved, cake can't find the image name field, and left it blank - or so I think. 
					$thisChild = $childrenTable->get($result->id);
					$thisChild->image = $oldImageName;
					$childrenTable->save($thisChild);
					
				}
                $this->Flash->success(__('The child has been saved.'));	
				//I'll have to admit that I have no Idea why the primary custodian will automatically be updated while the rest are deleted. 
				//So, I'll assume that we'll need to re-add the custodians AGAIN.
				//For some reason, using chosen-select (the one we CURRENTLY use, not the 'default' where you can choose a bunch at once), won't automatically
				//Insert the custodian. So, yeah. Time to insert them MANUALLY. Also we're using $primaryID.
				//we could've simply used THAT, but apparently we can't. okay then...
				
				//Store the primaryID
				$primaryID = $this->request->data['custodians']['_ids'];
				//debug($primaryID);
				$child->primary_custodian = $primaryID; 
				//debug($child->primary_custodian);
				$this->Children->save($child); // update this child's primary custodian ID
				$primaryCustodian = $custodianChildrenTable->newEntity();
				$primaryCustodian->custodian_id = $primaryID;
				$primaryCustodian->child_id = $result->id;
				$primaryCustodian->relationshipToChild = $this->request->data['custodians']['relationshipToChild'];
				//debug($this->request->data['custodians']['childLivingWithYou']);
				if($this->request->data['custodians']['childLivingWithYou'] == '0'){
						$primaryCustodian->childLivingWithYou = false;
				}
				else{
						$primaryCustodian->childLivingWithYou = true;	
				}
				$custodianChildrenTable->save($primaryCustodian);
				//Update the custodian. 
				$updatePrimaryCust = $custodianTable->get($primaryID);//get the custodian.
				$updatePrimaryCust = $this->Children->Custodians->patchEntity($updatePrimaryCust, $this->request->data['custodians']);
				$this->Children->Custodians->save($updatePrimaryCust);
				
				if(!empty($extraCustodianIDs)){ // there ARE extra custodians! insert them to the join table!
					$i=0;
					foreach($extraCustodianIDs as $extraCust){
								//debug('Current Extra Cust is (BEFORE UPDATE) ='.$extraCust);
								$i = $i+1;
								$custNo = 'extraCustodian'.$i;                
								$currentCustodianID = $this->request->data[$custNo]['_ids'];
								//debug('Current Extra Custodian is ='. $currentCustodianID );
								if($currentCustodianID != $extraCust){
									//Oh hey they changed the custodian, for whatever reason... well,
									//debug('THIS CUSTODIAN IS CHANGED!');
									$newExtraCustodian = $custodianChildrenTable->newEntity();
									$newExtraCustodian->custodian_id = $currentCustodianID;
									$newExtraCustodian->child_id = $result->id; 
									$newExtraCustodian->relationshipToChild = $this->request->data[$custNo]['relationshipToChild'];
									if($this->request->data[$custNo]['childLivingWithYou'] == '0'){
									$newExtraCustodian->childLivingWithYou = false;
									}
									else{
									$newExtraCustodian->childLivingWithYou = true;
									}
									$test = $custodianChildrenTable->save($newExtraCustodian);
									//debug($test->errors());
									//update the extra custodian
									$updateCustodian = $custodianTable->get($currentCustodianID);//get the custodian. 
									$updateCustodian = $this->Children->Custodians->patchEntity($updateCustodian, $this->request->data[$custNo]); //patch the entity with the data from the current custodian's form. (custodian1, custodian2...) 
								}
								else{
								//debug('THIS CUSTODIAN IS NOT CHANGED!');
								//insert the extra custodians
								$extraCustodian = $custodianChildrenTable->newEntity();
								$extraCustodian->custodian_id = $extraCust;
								$extraCustodian->child_id = $result->id;
								$extraCustodian->relationshipToChild = $this->request->data[$custNo]['relationshipToChild'];
								if($this->request->data[$custNo]['childLivingWithYou'] == '0'){
								$extraCustodian->childLivingWithYou = false;
								}
								else{
								$extraCustodian->childLivingWithYou = true;
								}	
								$custodianChildrenTable->save($extraCustodian);
								//update the extra custodian
								$updateCustodian = $custodianTable->get($extraCust);//get the custodian. 
								$updateCustodian = $this->Children->Custodians->patchEntity($updateCustodian, $this->request->data[$custNo]); //patch the entity with the data from the current custodian's form. (custodian1, custodian2...) 
								}
								$this->Children->Custodians->save($updateCustodian);
					}
				} 
				//okay, the codes above will make sure that we'll retain, and update, the custodians.
				//now, on to the new custodians.... 
				//debug($this->request->data['newCustodians']);
				if($this->request->data['newCustodians']!='' || $this->request->data['newCustodians'] != 0){ //the newCustodians will only appear of the child has less than 4 custodian.
					$newCustodians = $this->request->data['newCustodians'];
					$newCustodianIDs = array();
					for($i=1;$i<=$newCustodians;$i++){
					$custNo = 'newCustodian'.$i;
					$newCustodianIDs[] = $this->request->data[$custNo]['_ids']; //store the extra custodians
						}
					}
				
					$i=0;
					foreach($newCustodianIDs as $newCust){
								//insert the newly-added custodian
								$newCustodian = $custodianChildrenTable->newEntity();
								$newCustodian->custodian_id = $newCust;
								$newCustodian->child_id = $result->id;
								$newCustodian->relationshipToChild = $this->request->data[$custNo]['relationshipToChild'];
								//debug($this->request->data[$custNo]['relationshipToChild']);
								if($this->request->data[$custNo]['childLivingWithYou'] == '0'){
								$newCustodian->childLivingWithYou = false;
								}
								else{
								$newCustodian->childLivingWithYou = true;
								}
								$custodianChildrenTable->save($newCustodian);
								//update the new custodian
								$i = $i+1;
								$custNo = 'newCustodian'.$i;               
								$updateCustodian = $custodianTable->get($newCust);//get the custodian. 
								$updateCustodian = $this->Children->Custodians->patchEntity($updateCustodian, $this->request->data[$custNo]); //patch the entity with the data from the current custodian's form. (custodian1, custodian2...)
								$this->Children->Custodians->save($updateCustodian);
					}
				
				 
				
				if($exists == true){//This child already has an emergency_contacts. so we'll need to update the child's contacts
					$i=0;
					foreach($ccID as $id) // go through each of this child's contacts, and update them
					{
						//debug($id);
						if($i==0){
						$formName = 'ext_childcontacts';
						}else{
						$formName = 'ext_childcontacts'.$i;
						}
						//debug($formName);
						$cc = $ccTable->get($id); // store the child Contact of this child. 
						$cc = $this->Children->Childcontacts->patchEntity($cc, $data[$formName]);//patch the entity
						$cc->children_id = $result->id;
						$this->Children->Childcontacts->save($cc);//store the updated emergency_contacts
						$i++;
					}
				
				}
				 
				if($this->request->data('newContacts')!= 0) {
                    //save the second contacts
					//the second contact will ALWAYS exist if it's not 0.
                    $cc2 = $this->Children->Childcontacts->newEntity();
                    $cc2 = $this->Children->Childcontacts->patchEntity($cc2, $data['childcontacts2']);
                    $cc2->children_id = $result->id;
                    $this->Children->Childcontacts->save($cc2); //save it.
					if($this->request->data('newContacts')==2){//If there's THREE contacts, save the third one.
						$cc3 = $this->Children->Childcontacts->newEntity();
						$cc3 = $this->Children->Childcontacts->patchEntity($cc3, $data['childcontacts3']);
						$cc3->children_id = $result->id;
						$this->Children->Childcontacts->save($cc3); //save it.
					}
					if($this->request->data('newContacts')==3){//If there's FOUR contacts, save the third one AND the fourth one.
						$cc3 = $this->Children->Childcontacts->newEntity();
						$cc3 = $this->Children->Childcontacts->patchEntity($cc3, $data['childcontacts3']);
						$cc3->children_id = $result->id;
						$this->Children->Childcontacts->save($cc3); //save it.
						
						$cc4 = $this->Children->Childcontacts->newEntity();
						$cc4 = $this->Children->Childcontacts->patchEntity($cc4, $data['childcontacts4']);
						$cc4->children_id = $result->id;
						$this->Children->Childcontacts->save($cc4); //save it.
					
					}
                }
				
				
				
				else if($exists == false){ //this child does not have one, so make and insert a new contact
					 
					$this->request->data['childcontacts']['children_id'] = $result->id;
					$newCC = $this->Children->Childcontacts->newEntity();//make new contacts
					$newCC = $this->Children->Childcontacts->patchEntity($newCC, $data['childcontacts']);//patch the entity
					$this->Children->Childcontacts->save($newCC);//insert the new one
				
				
				}
                return $this->redirect(['action' => 'edit',$child->id]); //refresh the edit page.
            } else {
                $this->Flash->error(__('The child could not be saved. Please, try again.'));
            }
        }
         $childcares = $this->Children->Childcares->find('list', 
        //combines the day and time row value
        ['keyField' => 'id',
         'valueField' => function($row){
             return $row['type'].' - '.$row['day'].', '.$row['starttime']. ' - '.$row['endtime'] ;
         }
        ]);
        $childcares->order(['type'=> 'ASC']);


		$custodians = $this->Children->Custodians->find('list', ['keyField'=>'id','valueField'=>'concatenated']);
		//Gets the givenName and familyName from the Members table.
		$custodians
			->select([
				'id',
				'concatenated' => $custodians->func()->concat([ // concatenate givenName and familyName.
				'givenName' => 'literal', 
				' ',
				'familyName' => 'literal',
				' (Address : ',
				'Members.streetAddress'=>'literal',
				')'
			])
		])
		->contain(['Members']); // this means, 'hey', inner join this table (custodians) with members.

		$this->set(compact('child', 'childcares', 'custodians'));
        $this->set('_serialize', ['child']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Child id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $child = $this->Children->get($id);
        if ($this->Children->delete($child)) {
            $this->Flash->success(__('The child has been deleted.'));
        } else {
            $this->Flash->error(__('The child could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
