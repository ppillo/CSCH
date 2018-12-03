<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Members Controller
 *
 * @property \App\Model\Table\MembersTable $Members
 */
class MembersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $members = $this->Members->find('all');

//        $this->paginate = [
//            'contain' => ['Users'],
//            'limit' => 2000,
//            'Members.givenName' => 'asc',
//        ];
//        $members = $this->paginate($this->Members);

        $this->set(compact('members'));
        $this->set('_serialize', ['members']);
    }
    
    
    /**
     * View method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $member = $this->Members->get($id, [
            'contain' => ['Users', 'Custodians', 'Programs', 'Categories', 'EmergencyContacts', 'Volunteers']
        ]);
        $this->set('member', $member);
        $this->set('_serialize', ['member','familyMembers']);
    }


    public function isAuthorized($user)
    {
        //debug($user['role']);
        //First, find out whether the user is a staff
        if ($user['role'] == 'staff') {
            //Then, determine current action of the page
            if ($this->request->action === 'deactiveMembers') {
                //Finally, grant or deny users' privilege
                $this->Flash->error(__('Not Authorised, please contact an Admin'));
                return false;
            }

        }
        elseif ($user['role'] == 'admin'){
            if ($this->request->action === 'deactiveMembers') {
                //Finally, grant or deny users' privilege
                return true;
            }

        }

        return parent::isAuthorized($user);
    }

		 //make ALL members inactive.
	 public function deactiveMembers($id=null){

	 if ($this->Members->updateAll(array('active'=>0),array('active'=>1,'tier !='=>'V'))) {
                $this->Flash->success(__('All Non-Volunteers Members Deactivated'));
            } else {
                $this->Flash->error(__('There are no non-active member in the system.'));
            }
            return $this->redirect(['controller' => 'members', 'action' => 'index']);

	 }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $member = $this->Members->newEntity();
		$isCustodian = false;
		$isCustodian = isset($this->request->data['isCustodian']); 
        $inHelpRoster = isset($this->request->data['inHelpRoster']); 
		$membersTable = TableRegistry::get('members'); //get the members table
        if (!empty($this->request->data)) {

            //debug($this->request->data);
            
            //Revert the format BACK to Y-m-d format
            $newDateDOB = date('Y-m-d',strtotime($this->request->data['dateOfBirth']));
            $newSignUpDate = date('Y-m-d',strtotime($this->request->data['signupDate']));
            
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
            //debug($data);
            $member = $this->Members->patchEntity($member, $data, [
                'associated' => ['EmergencyContacts', 'Categories', 'Custodians', 'Programs']
            ]);
            //debug($member);
            //Now put those reverted dates to the $member entity.
            $member->dateOfBirth = $newDateDOB;
            $member->signupDate =$newSignUpDate;  

            //$newDate = explode("-",$member->dateOfBirth);
            //debug($member->dateOfBirth);
            //debug($newDate);// Was used to covert / to - in date string for db insert. In your case you are using -
            //debug($newDate[2]."-".$newDate[1]."-".$newDate[0]);



            if ($result = $this->Members->save($member)) {
				$hasImage = false;
				if (!empty($this->request->data['image'])) { // if image exists, upload it.
                //upload image if user has selected one
                //calls uploadFiles function in AppController.php
				$imgName = 'member_'.$result->id; // set the image name here. in this case it will be member_000 <- where 000 = memberID
				//debug($imgName);
                $fileOK = $this->uploadFiles('img/images/members', $this->request->data['image'],$imgName); //uploads the file WITH the desired image name.
                //debug($fileOK = $this->uploadFiles('img/images', $this->request->data['image']));
                if (array_key_exists('urls', $fileOK)) {
					$ext = strstr($fileOK['urls'][0],'.'); // get the uploaded file's extension.
					//debug($ext);
					//if image is uploaded, update the newly-inserted member's image.
                    //$this->request->data['image'] = $fileOK['urls'][0];
                    //$member->set('image', $fileOK['urls'][0]);
					$imgName = $imgName.$ext;
					$thisMember = $membersTable->get($result->id);
					$thisMember->image = $imgName;
					$membersTable->save($thisMember);
					$hasImage = true;

				} else {
                    $this->request->data['image'] = null;
					$hasImage = false;
                    //$this->Flash->error('Can not upload image.');
                }
				}
				if($result->tier=='V'){
					//save the volunteer
					$this->request->data['volunteers']['member_id'] = $result->id;
					$vol = $this->Members->Volunteers->newEntity();
                    $vol->member_id = $result->id;
					//revert the startDate from m-d-Y to Y-m-d again.



						//if the check dates are NOT empty, save them.
						if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
						$newChildDate = date('Y-m-d',strtotime($this->request->data['volunteers']['workingWithChildrenExpirydate']));				
						}
						if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
						$newPoliceDate = date('Y-m-d',strtotime($this->request->data['volunteers']['policeCheckExpiryDate']));
						}
                         if(!empty($this->request->data['volunteers']['volunteerStartDate'])) {
                        $newStartDate = date('Y-m-d',strtotime($this->request->data['volunteers']['volunteerStartDate']));
                         }
						$vol = $this->Members->Volunteers->patchEntity($vol, $data['volunteers']);	
						//update the patched entity's dates
                        if(!empty($this->request->data['volunteers']['volunteerStartDate'])) {
                        $vol->volunteerStartDate = $newStartDate;
                        }
						//now patch the saved dates
						if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
						$vol->workingWithChildrenExpirydate = $newChildDate;			
						}
						if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
						$vol->policeCheckExpiryDate = $newPoliceDate;
						}


						   
                    $vol->active = true;
					
					if($volunteerResult = $this->Members->Volunteers->save($vol)){
						$refereeTable = TableRegistry::get('referees'); //get the categories_members table
                        //debug('Number of Referees :'.$_POST['refereeNum']);
                        
						if($_POST['refereeNum']==1){ // save a single referee
							$referee = $refereeTable->newEntity();
							$referee->volunteer_id = $volunteerResult->id;
							$referee->name = strip_tags($_POST['referee_name']);
							$referee->phone = strip_tags($_POST['referee_phone']);
							$refereeTable->save($referee);
						}
						if($_POST['refereeNum']==2){ // saves two referees
							//if the fields are NOT empty, save them.
							if(($_POST['referee1_name']!="")&&($_POST['referee1_phone']!="")){
								$referee1 = $refereeTable->newEntity();
								$referee1->volunteer_id = $volunteerResult->id;
								$referee1->name = strip_tags($_POST['referee1_name']);
								$referee1->phone = strip_tags($_POST['referee1_phone']);
								$refereeTable->save($referee1);
							}
							if(($_POST['referee2_name']!="")&&($_POST['referee2_phone']!="")){
								$referee2 = $refereeTable->newEntity();
								$referee2->volunteer_id = $volunteerResult->id;
								$referee2->name = strip_tags($_POST['referee2_name']);
								$referee2->phone = strip_tags($_POST['referee2_phone']);
								$refereeTable->save($referee2);
							}
						}
					
                    }
				}
				//save the emergency contacts
				$data['emergency_contacts']['member_id'] = $result->id;
				$em = $this->Members->EmergencyContacts->newEntity();
				$em = $this->Members->EmergencyContacts->patchEntity($em, $data['emergency_contacts']);
				$this->Members->EmergencyContacts->save($em);

                $categoryTable = TableRegistry::get('categories_members'); //get the categories_members table
                $exists = $categoryTable->exists(['member_id' => $result->id, 'category_id' => '4']); // check if THIS member is signing up for the childcares
                
				if ($exists == true && ($isCustodian == true)) { //if BOTH are true, then add this member to the custodian table.
                    //saves the custodians
                    $this->request->data['custodians']['member_id'] = $result->id;
                    $custodian = $this->Members->Custodians->newEntity();
                    $custodian = $this->Members->Custodians->patchEntity($custodian, $this->request->data['custodians']);
                    
                    if($inHelpRoster == true){ //if the help roster is checked then update it as yes
                                    
                                $custodian->helpRoster = 'Yes';
                        }
                        else{
                            $custodian->helpRoster = 'No';
                        }
                    
                    $this->Members->Custodians->save($custodian);
                }
				if($hasImage){
					$this->Flash->success(__('The member has been saved.'));
				}
				else{

					$this->Flash->success(__('The member has been saved. (No image was uploaded)'));
				}
              return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The member could not be saved. Please, try again.'));
            }
        }

        //rename($old, $new);
		$familyMembers = $this->Members->find('list',
			['keyField'=>'id','valueField'=>
            function($row){
            return $row['givenName'].' '.$row['familyName'].' ('.$row['streetAddress'].')';
         }])->where(['tier'=>'F']);
 
        $users = $this->Members->Users->find('list', ['limit' => 200]);
        $categories = $this->Members->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ]);
        $programs = $this->Members->Programs->find('list', [
            'keyField' => 'id',
            'valueField' => function($row){
            return $row['name'] . ' ('. $row['date'] .')';
            },
        ]);
        $this->set(compact('member', 'users', 'categories','familyMembers', 'programs'));
        $this->set('_serialize', ['member']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $member = $this->Members->get($id, [
            'contain' => ['Programs', 'Categories', 'EmergencyContacts', 'Custodians']
        ]); 
		
		
        $emTable = TableRegistry::get('emergency_contacts'); //get the emergency_contacts table
        $custodiansTable = TableRegistry::get('custodians'); //get the emergency_contacts table
        
        
		$emID = 0; //temporarily.
        //see if the member has an emergency_contacts
        if (sizeof($member->emergency_contacts) == 0) {
            $this->Flash->error(__('Member DOES NOT have emergency contacts!'));
            $exists = false; //a boolean value that we'll use to determine wheter or not we'll need to create a new Emergency Conctacts, or just update an existing one. In this case We'll only need to update it.
        } else {

            $exists = true;
			$emID = $member->emergency_contacts[0]->id;
			//debug($emID);
        }
        $membersTable = TableRegistry::get('members'); //get the members table - for later.
		$oldImageName = $member->image; // get the old image name. we store this value BEFORE updating the member because we'll lose it after we click the submit button.
		$oldMemberTier = $member->tier; // get this member's old tier before updating it.
		 
		$relatedMembers = $this->Members->find('all')->where(['related_member'=>$member->id])->toArray();
	 		
			
			
			
		
		
		//debug($oldImageName);
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			$isCustodian = false;
			$isCustodian = isset($this->request->data['isCustodian']); 
            $inHelpRoster = isset($this->request->data['inHelpRoster']); 
            
			$newDateDOB = date('Y-m-d',strtotime($this->request->data['dateOfBirth']));
			$newAddress = strip_tags($this->request->data['streetAddress']);
			$newSignUpDate = date('Y-m-d',strtotime($this->request->data['signupDate']));
            
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
            
			
			
            
            $member = $this->Members->patchEntity($member, $data);    
			$member->dateOfBirth = $newDateDOB;
			$member->streetAddress = $newAddress;
			$member->signupDate = $newSignUpDate;
			
			
			
			
			if($oldMemberTier != $member->tier){ //hey they changed their tier!
				
				if( ($oldMemberTier == 'F') && ($member->tier != 'F')  ){ // is the old one family and the new one NOT family?
					//make all the (formerly) related member(s) inactive
					
					
					foreach($relatedMembers as $related){
						$related_ID = $related['id'];
						$related_Member_Object = $membersTable->get($related_ID);
						$related_Member_Object->active = false;
						$related_Member_Object->tier = 'I';
						$membersTable->save($related_Member_Object);
					}
					
					
					$member->related_member = ""; //remove the related member ID from this member.
					
					
					
					
				}
				
			} 
			
			
            $currentImage = $member['image'];
            $hasImage = $_FILES['image']['size'];  //check if a file is chosen.
            $newImage = false; // a boolean value to determine wheter or not we'll need to upload a new image
            if ($hasImage != 0) { //if $hasImage's size is more than 0 then the user has chosen a file.
                $newImage = true;
            }
            if ($result = $this->Members->save($member)) {
                if ($exists == true) {//This member already has an emergency_contacts. so we'll need to update the member's emergency contacts
                    $em = $emTable->get($emID); // store the Emergency Contact of this member.
                    $em = $this->Members->EmergencyContacts->patchEntity($em, $data['emergency_contacts']);//patch the entity
                    $this->Members->EmergencyContacts->save($em);//store the updated emergency_contacts
                } else if ($exists == false) { //this member does not have one, so make and insert a new emergency contact

                    $this->request->data['emergency_contacts']['member_id'] = $result->id;
                    $newEM = $this->Members->EmergencyContacts->newEntity();//make new emergency contacts
                    $newEM = $this->Members->EmergencyContacts->patchEntity($newEM, $data['emergency_contacts']);
                    $newEM->member_id = $result->id;
                    $this->Members->EmergencyContacts->save($newEM);//insert the new one
                    //debug($newEM->errors());
                }

                if ($newImage == true) {
                    //debug('uploading new image');
                    // if image exists, upload it.
                    //upload image if user has selected one
                    //calls uploadFiles function in AppController.php
                    $imgName = 'member_' . $result->id;
                    //debug($imgName);
                    $fileOK = $this->uploadFiles('img/images/members', $this->request->data['image'], $imgName);
                    if (array_key_exists('urls', $fileOK)) {
                        $ext = strstr($fileOK['urls'][0], '.'); // get the uploaded file's extension.
                        //if image is uploaded, update the newly-inserted member's image.
                        $imageName = $imgName . $ext;
                        $thisMember = $membersTable->get($result->id);
                        $thisMember->image = $imageName;
                        $membersTable->save($thisMember);
                    } else {
                        $this->request->data['image'] = null;
                        $this->Flash->error('Can not upload image.');
                    }
                } else {
                    //debug('no new image');
                    //don't insert any new image, but update the image name anyway.
                    //why? because when you update the member WITHOUT changing the image, Cake will leave the image field empty.
                    //why is it empty? because there's no image name field in the (actual) edit form, and when the member is saved, cake can't find the image name field, and left it blank - or so I think.
                    $thisMember = $membersTable->get($result->id);
                    $thisMember->image = $oldImageName;
                    $membersTable->save($thisMember);
                }
                //debug($result->tier);
                if ($result->tier == 'V') {

                    $volunteerTable = TableRegistry::get('volunteers');

                    $exists = $volunteerTable->exists(['member_id' => $result->id]);

                    if ($exists) {
                        //This member is already a volunteer!
                        //debug($exists.'  This Member is a volunteer!');
                        $volID = $volunteerTable->find()->where(['member_id' => $result->id])->first()->id; // get the member's volunteer ID
                        $editVol = $volunteerTable->get($volID); //get the entity object for this member.
                        //debug('before patchEntity : '.$editVol);
						//debug($this->request->data['volunteers']);
						//revert the startDate from m-d-Y to Y-m-d again.
						//if the check dates are NOT empty, save them.
						if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
						$newChildDate = date('Y-m-d',strtotime($this->request->data['volunteers']['workingWithChildrenExpirydate']));				
						}
						if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
						$newPoliceDate = date('Y-m-d',strtotime($this->request->data['volunteers']['policeCheckExpiryDate']));
						}
                        if(!empty($this->request->data['volunteers']['volunteerStartDate'])) {
                            $newStartDate = date('Y-m-d',strtotime($this->request->data['volunteers']['volunteerStartDate']));
                        }
						
						$editVol = $this->Members->Volunteers->patchEntity($editVol, $data['volunteers']);	
						
						//update the patched entity's dates
						//if these fields are not empty, patch them.
						if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
						$editVol->workingWithChildrenExpirydate = $newChildDate;			
						}
						if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
						$editVol->policeCheckExpiryDate = $newPoliceDate;
						}
                        if(!empty($this->request->data['volunteers']['volunteerStartDate'])) {
                            $editVol->volunteerStartDate = $newStartDate;
                        } 
						//debug($_POST['refereeNum']);
                        if ($volunteerResult = $this->Members->Volunteers->save($editVol)) { //save the updated volunteer

                            $refereeTable = TableRegistry::get('referees'); //get the categories_members table 

                            $refereeTable = TableRegistry::get('referees'); //get the categories_members table
                            
                             //debug($this->request->data['referee_id']);
                            if ($this->request->data['refereeNum'] == 1) { // save a single referee
                               
                                if($_POST['referee_id']!="" || $_POST['referee_id']!=null){ //if the referee already exist, update.
                                    $refereeUpdate = $refereeTable->get($_POST['referee_id']);
                                    $refereeUpdate->name = strip_tags($_POST['referee_name']);
                                    $refereeUpdate->phone = strip_tags($_POST['referee_phone']);
                                    $refereeTable->save($refereeUpdate);
                                }
                                else{ 
                                $referee = $refereeTable->newEntity();
                                $referee->volunteer_id = $volunteerResult->id;
                                $referee->name = strip_tags($_POST['referee_name']);
                                $referee->phone = strip_tags($_POST['referee_phone']);
                                $refereeTable->save($referee);
                                }
                            
                            }
                            if ($_POST['refereeNum'] == 2) { // saves two referees
                                //if the fields are NOT empty, save them.
                                if (($_POST['referee1_name'] != "") && ($_POST['referee1_phone'] != "")) {
                                    //now, because this referee will either already exists, or never actually existed, we'll need to add
                                    if($_POST['referee1_id']!=""){ 
                                        //debug('updating a referee...');
                                        $refereeUpdate1 = $refereeTable->get($_POST['referee1_id']);
                                        $refereeUpdate1->name = strip_tags($_POST['referee1_name']);
                                        $refereeUpdate1->phone = strip_tags($_POST['referee1_phone']);
                                        $refereeTable->save($refereeUpdate1);
                                    }
                                    else{
                                        $referee1 = $refereeTable->newEntity();
                                        $referee1->volunteer_id = $volunteerResult->id;
                                        $referee1->name = strip_tags($_POST['referee1_name']);
                                        $referee1->phone = strip_tags($_POST['referee1_phone']);
                                        $refereeTable->save($referee1);
                                        }
                                }
                                if (($_POST['referee2_name'] != "") && ($_POST['referee2_phone'] != "")) {
                                    if($_POST['referee2_id']!=""){ //this is an existing referee. update the data.
                                       // debug('updating another referee...');
                                        $refereeUpdate2 = $refereeTable->get($_POST['referee2_id']);
                                        $refereeUpdate2->name = strip_tags($_POST['referee2_name']);
                                        $refereeUpdate2->phone = strip_tags($_POST['referee2_phone']);
                                        $refereeTable->save($refereeUpdate2);
                                    }
                                    else{
                                    $referee2 = $refereeTable->newEntity();
                                    $referee2->volunteer_id = $volunteerResult->id;
                                    $referee2->name = strip_tags($_POST['referee2_name']);
                                    $referee2->phone = strip_tags($_POST['referee2_phone']);
                                    $refereeTable->save($referee2);
                                        }
                                }
                            }

                        }
					}						
					else {
                            //oh, a new volunteer! let's put it in.
                            //save the volunteer
                            $this->request->data['volunteers']['member_id'] = $result->id;
                            $vol = $this->Members->Volunteers->newEntity();
							
							//revert the startDate from m-d-Y to Y-m-d again.
							//revert the startDate from m-d-Y to Y-m-d again.
							
							if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
							$newChildDate = date('Y-m-d',strtotime($this->request->data['volunteers']['workingWithChildrenExpirydate']));				
							}
							if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
							$newPoliceDate = date('Y-m-d',strtotime($this->request->data['volunteers']['policeCheckExpiryDate']));
							}
						
						
							$newStartDate = date('Y-m-d',strtotime($this->request->data['volunteers']['volunteerStartDate'])); 
						
							$vol = $this->Members->Volunteers->patchEntity($vol, $this->request->data['volunteers']);	
						
							//update the patched entity's dates
							$vol->volunteerStartDate = $newStartDate; 
						
							//if these fields are not empty, patch them.
							if(!empty($this->request->data['volunteers']['workingWithChildrenExpirydate'])){
							$vol->workingWithChildrenExpirydate = $newChildDate;			
							}
							if(!empty($this->request->data['volunteers']['policeCheckExpiryDate'])){
							$vol->policeCheckExpiryDate = $newPoliceDate;
							}
                            
                            if ($volunteerResult = $this->Members->Volunteers->save($vol)) {
                                $refereeTable = TableRegistry::get('referees'); //get the categories_members table
                                 if ($this->request->data['refereeNum'] == 1) { // save a single referee
                               
                                if($_POST['referee_id']!="" || $_POST['referee_id']!=null){ //if the referee already exist, update.
                                    $refereeUpdate = $refereeTable->get($_POST['referee_id']);
                                    $refereeUpdate->name = strip_tags($_POST['referee_name']);
                                    $refereeUpdate->phone = strip_tags($_POST['referee_phone']);
                                    $refereeTable->save($refereeUpdate);
                                }
                                else{ 
                                $referee = $refereeTable->newEntity();
                                $referee->volunteer_id = $volunteerResult->id;
                                $referee->name = strip_tags($_POST['referee_name']);
                                $referee->phone = strip_tags($_POST['referee_phone']);
                                $refereeTable->save($referee);
                                }
                            
                            }
                            if ($_POST['refereeNum'] == 2) { // saves two referees
                                //if the fields are NOT empty, save them.
                                if (($_POST['referee1_name'] != "") && ($_POST['referee1_phone'] != "")) {
                                    //now, because this referee will either already exists, or never actually existed, we'll need to add
                                    if($_POST['referee1_id']!=""){ 
                                        //debug('updating a referee...');
                                        $refereeUpdate1 = $refereeTable->get($_POST['referee1_id']);
                                        $refereeUpdate1->name = strip_tags($_POST['referee1_name']);
                                        $refereeUpdate1->phone = strip_tags($_POST['referee1_phone']);
                                        $refereeTable->save($refereeUpdate1);
                                    }
                                    else{
                                        $referee1 = $refereeTable->newEntity();
                                        $referee1->volunteer_id = $volunteerResult->id;
                                        $referee1->name = strip_tags($_POST['referee1_name']);
                                        $referee1->phone = strip_tags($_POST['referee1_phone']);
                                        $refereeTable->save($referee1);
                                        }
                                }
                                if (($_POST['referee2_name'] != "") && ($_POST['referee2_phone'] != "")) {
                                    if($_POST['referee2_id']!=""){ //this is an existing referee. update the data.
                                       // debug('updating another referee...');
                                        $refereeUpdate2 = $refereeTable->get($_POST['referee2_id']);
                                        $refereeUpdate2->name = strip_tags($_POST['referee2_name']);
                                        $refereeUpdate2->phone = strip_tags($_POST['referee2_phone']);
                                        $refereeTable->save($refereeUpdate2);
                                    }
                                    else{
                                    $referee2 = $refereeTable->newEntity();
                                    $referee2->volunteer_id = $volunteerResult->id;
                                    $referee2->name = strip_tags($_POST['referee2_name']);
                                    $referee2->phone = strip_tags($_POST['referee2_phone']);
                                    $refereeTable->save($referee2);
                                        }
                                }
                            }
                            }

                        }
                }else{
					$volunteerTable = TableRegistry::get('volunteers');
                    $exists = $volunteerTable->exists(['member_id' => $result->id]); //check if this member was a volunteer.
                    if ($exists) {
						//hey, they change their tier! deactive this volunteer!
						$volID = $volunteerTable->find()->where(['member_id' => $result->id])->first()->id; // get the member's volunteer ID
                        $editVol = $volunteerTable->get($volID); //get the entity object for this member.
						$editVol->active = 0; //deactive the volunteer....
						$volunteerTable->save($editVol);
					}
					
				}
			
                $categoryTable = TableRegistry::get('categories_members'); //get the categories_members table
                $exists = $categoryTable->exists(['member_id' => $result->id, 'category_id' => '4']); // check if THIS member is signing up for the childcares
                if ($exists == true && $isCustodian) { //if true, then add this member to the custodian table.
                    
                    $checkCustodianId = $custodiansTable->find('all')->where(['member_id'=>$result->id])->first();
                    
                    //debug(empty($checkCustodianId));
                    
                    if(!empty($checkCustodianId)){ //if this member is already a custodian just update them
                        $this->request->data['custodians']['member_id'] = $result->id;
                        $checkCustodianId = $this->Members->Custodians->patchEntity($checkCustodianId, $this->request->data['custodians']);
                        if($inHelpRoster == true){
                                $checkCustodianId->helpRoster = 'Yes';
                        }
                        else{
                            $checkCustodianId->helpRoster = 'No';
                        }
                    $this->Members->Custodians->save($checkCustodianId);
                    
                    
                    }else{ 
                    //if not then insert them 
                    $this->request->data['custodians']['member_id'] = $result->id;
                    $custodian = $this->Members->Custodians->newEntity();
                    $custodian = $this->Members->Custodians->patchEntity($custodian, $this->request->data['custodians']);
                    if($inHelpRoster == true){
                        $custodian->helpRoster = 'Yes';
                    }
                    else{
                        $custodian->helpRoster = 'No';
                    } 
                    $this->Members->Custodians->save($custodian);
                    }
                    
                    
                    
                }

                $this->Flash->success(__('The member has been saved.'));
               return $this->redirect(['action' => 'edit', $member->id]); //refresh the edit page.
            } else {
                $this->Flash->error(__('The member could not be saved. Please, try again.'));
            }
        }

        $familyMembers = $this->Members->find('list',
			['keyField'=>'id','valueField'=>
            function($row){
            return $row['givenName'].' '.$row['familyName'].' ('.$row['streetAddress'].')';
         }])->where(['tier'=>'F']);
        $users = $this->Members->Users->find('list', ['limit' => 200]);
        $categories = $this->Members->Categories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
        ]);
        $programs = $this->Members->Programs->find('list', [
            'keyField' => 'id',
            'valueField' => function($row) {
                return $row['name'] . ' (' . $row['date'] . ')';
                    }
        ]);
        $this->set(compact('member', 'users', 'categories','familyMembers', 'programs'));
        $this->set('_serialize', ['member']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $member = $this->Members->get($id);
        if ($this->Members->delete($member)) {
            $this->Flash->success(__('The member has been deleted.'));
        } else {
            $this->Flash->error(__('The member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
