<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Caulfield South Community House</title>
    <?= $this->Html->css('bootstrap.min.css')?>
        <?= $this->Html->css('base.css') ?>
            <?= $this->Html->css('cake.css') ?>
                <?= $this->Html->css('style.css')?>
</head>

<body>
    <?php
    use PhillipsData\Csv\Reader;
    use PhillipsData\Csv\Factory;
    use Cake\ORM\TableRegistry;
    use Cake\ORM\Table;
    if(isset($_POST['submit'])){ //if file is uploaded...
        ?>
        <div style="padding:10px;"></div>
        <div class='large-12 columns content material material'>
            <div class="material_help">
                <h3 style="color:white; font-weight:regular;"><?= __('Batch Upload') ?></h3> </div>
            <?php
            if(isset($_FILES['csv'])){ //oh look, they uploaded something!
                //GET ALL THE TABLES!
                $membersTable = TableRegistry::get('members');
                $categoriesMembersTable = TableRegistry::get('categories_members');
                $custodianTable = TableRegistry::get('custodians');
                $emTable = TableRegistry::get('emergency_contacts');

                
                $memberResult = $membersTable->find()->last();
                $lastId = 0;
                //debug(empty($memberResult->id));
                if(!(empty($memberResult->id))){
                    $lastId = $memberResult->id;   
                } 
                //debug($lastId);
                
            
                
                //I know that this is NOT exactly the best way to do this...but it works! the other methods won't work!
                //I tried to use $membersTable->newEntity and then patch them up, but that doesn't work. So...a rather brute force method is used.
                 
                //the insert queries. We'll have to insert to 3 different tables at once...
                $memberQuery = $membersTable->query(); 
                $categoryQuery = $categoriesMembersTable->query();  
                $custodianQuery = $custodianTable->query(); 
                $ecQuery = $emTable->query();
                //check if this is a valid csv file
                $open = fopen($_FILES['csv']['tmp_name'],"r");
                
                
                if(!($data=fgetcsv($open))){
                    echo 'invalid file. please try again.';
                } 
                else{ 
                //get the csv's header - just in case.
                $array = array_map('str_getcsv',file($_FILES['csv']['tmp_name']));
                $header = array_shift($array);
                $fileHeader = implode(" ",$header);
                
                //the header needed for this to work. This can also act as a sample data.
                $targetHeader = array(
                                      'givenName' => 'Gale',
		                              'familyName' => 'Zayn',
		                              'dateOfBirth' => '1992-02-02',
		                              'email' => 'GaZyn@mail.com',
		                              'streetAddress' => '152 Auburn Road',
		                              'suburb' => 'Hawthorn',
		                              'state' => 'VIC',
		                              'postCode' => '3122',
		                              'homePhone' => '(12) 5451 8552',
		                              'mobilePhone' => '(12) 5252 5666',
		                              'tier' => 'F',
		                              'newsletter' => '0',
		                              'gender' => 'M',
		                              'voting' => '0',
		                              'signupDate' => '2017-02-02',
		                              'active' => '1',
		                              'category' => 'Childcare');
                    
                
                //two different reader methods. I've found that there are many ways CSV files can be saved by Microsoft excel, and I want to make this website as accessible as possible.
                $readerMethod1 = Reader::input(new SplFileObject($_FILES['csv']['tmp_name']));
                $readerMethod2 = Factory::reader($_FILES['csv']['tmp_name'],';','"','\\');
                
                $lines = [];
                // Use the first method to read the .csv file.
                foreach ($readerMethod1->fetch() as $line) { 
                    $lines[] = $line;
                }
                if(sizeof($lines)!=0){   //check if the initial read at least returns something.
                    if(sizeof($lines[0])==1){ //wait a minute, there's supposed to be at least 17 'columns' in this array! read that file again with the second method!

                    unset($lines);
                    $lines = [];
                    foreach ($readerMethod2->fetch() as $line) {
                        $lines[] = $line;
                    } 
                        
                    } 
                    if(sizeof($lines[0])==1){ //if the size of this array is STILL 1 after the two methods, then this file is either corrupted, or not supported. 

                    echo '<p>The .Csv is unreadable for Members upload. Please make sure you have uploaded the correct spreadsheet,and <a href="">Try Again.</a></p>'; 
                    }
                    else{   
                        $diff = sizeof(array_diff_key($targetHeader,$lines[0])); 
                        if($diff>1){

                            echo '<p>The .Csv is not suitable for Members upload. Please make sure you have uploaded the correct spreadsheet,and <a href="">Try Again.</a></p>';
                        }
                        else{ //okay, NOW we can get in to the business of actually inserting data.
                       //Store length of lines
                        $count = count($lines);    
                        $multipleCount = 0;
                        //check if this file has BOM in it! if yes, rename it.
                        foreach ($lines as $index => $line){
                            foreach ($line as $linekey => $linevalue) {
                                if (strpos($linekey, "\xef\xbb\xbf") !== false) {
                                    //debug('BOM found!');
                                    $newkey = trim($linekey, "\xef\xbb\xbf");
                                    $lines[$index][$newkey] = $lines[$index][$linekey];
                                    unset($lines[$index][$linekey]);
                                }
                                break;
                            }
                        }
                       // debug($lines[0]['familyName']);
                    //    debug($lines);
                        
                        
                        //loop through the lines array and put the new member in.
                        for ($i = 0; $i<$count;$i++){
                            if(empty($lines[$i]['givenName'])  && empty($lines[$i]['familyName']) && empty($lines[$i]['mobilePhone']) && empty($lines[$i]['email']) ){

                                //skip this line if it has null values. do nothing.
                            }
                            else{
                                $thisMemberDOB = strtotime(str_replace('/','-',$lines[0]['dateOfBirth']));  //gets the dateOfBirth of this member.
                                //a checker value to check if this member already exists in the database.
                                $checker = $membersTable->find('all')->where([
                                'givenName'=>$lines[$i]['givenName'],
                                'familyName'=>$lines[$i]['familyName'],
                                'dateOfBirth'=>date('Y-m-d',$thisMemberDOB),
                                'email'=>$lines[$i]['email'],
                                'streetAddress'=>$lines[$i]['streetAddress'],
                                'suburb'=>$lines[$i]['suburb'],
                                'state'=>$lines[$i]['state'],
                                'postCode'=>$lines[$i]['postCode'],
                                'homePhone'=>$lines[$i]['homePhone'],
                                'mobilePhone'=>$lines[$i]['mobilePhone'],
                                ])->first();
                                if(!empty($checker)){ //there's already a member with these  info. skip them.
                                    $multipleCount = $multipleCount+1;

                                }
                                else{
                                    //create a member insert query.
                                    $memberQuery->insert([ 'id','givenName','familyName','dateOfBirth','email','streetAddress','suburb','state','postCode','homePhone','mobilePhone','tier','newsletter','gender','voting','signupDate','active'])->values([
                                    'id'=>$lastId+$i+1, //so, instead of letting the database auto-incrementing, we explicitly told them the id. this is necessary for the other inserts AFTER this one.
                                    'givenName'=>$lines[$i]['givenName'],
                                    'familyName'=>$lines[$i]['familyName'],
                                    'dateOfBirth'=>date('Y-m-d',$thisMemberDOB),
                                    'email'=>$lines[$i]['email'],
                                    'streetAddress'=>$lines[$i]['streetAddress'],
                                    'suburb'=>$lines[$i]['suburb'],
                                    'state'=>$lines[$i]['state'],
                                    'postCode'=>$lines[$i]['postCode'],
                                    'homePhone'=>$lines[$i]['homePhone'],
                                    'mobilePhone'=>$lines[$i]['mobilePhone'],
                                    'tier'=>$lines[$i]['tier'],
                                    'newsletter'=>$lines[$i]['newsletter'],
                                    'gender'=>$lines[$i]['gender'],
                                    'voting'=>$lines[$i]['voting'],
                                    'signupDate'=>date('Y-m-d',strtotime($lines[$i]['signupDate'])),
                                    'active'=>$lines[$i]['active']
                                    ]);

                                    //insert these members to the categories_members table
                                    if($lines[$i]['category']=='Childcare'){ 
                                                 $categoryQuery->insert(['category_id','member_id'])->values([ 'category_id' => 4,'member_id' => $lastId+$i+1]);
                                                 //oh this member's in childcares...insert them to the custodian table
                                                $custodianQuery->insert(['id','member_id'])->values(['id'=>null, 'member_id'=>$lastId+$i+1]); 
                                    }
                                    else if($lines[$i]['category']=='Health & Well-being'){ $categoryQuery->insert(['category_id', 'member_id'])->values(['category_id' => 1,'member_id' => $lastId+$i+1]);}
                                    else if($lines[$i]['category']=='Fun & Friendship'){ $categoryQuery->insert([  'category_id', 'member_id' ])->values(['category_id' => 3,'member_id' => $lastId+$i+1]);}
                                    else if($lines[$i]['category']=='Learning & Development'){ $categoryQuery->insert(['category_id','member_id'])->values(['category_id' => 5,'member_id' => $lastId+$i+1]);}
                                    else if($lines[$i]['category']=='Garden'){  $categoryQuery->insert(['category_id','member_id'])->values(['category_id' => 2,'member_id' => $lastId+$i+1]);} 
                                        
                                     //check if this file has emergency contact headers
                                    if(array_key_exists('emergency_contacts_givenName', $lines[$i]) && array_key_exists('emergency_contacts_familyName', $lines[$i]) && array_key_exists('emergency_contacts_mobileNumber', $lines[$i]) && array_key_exists('emergency_contacts_relationship', $lines[$i])){
                                       

                                        if(!(($lines[$i]['emergency_contacts_givenName']=="")  &&  ($lines[$i]['emergency_contacts_familyName']=="") && ($lines[$i]['emergency_contacts_phoneNumber']=="") && ($lines[$i]['emergency_contacts_mobileNumber']=="") && ($lines[$i]['emergency_contacts_relationship']==""))){
                                            $ecQuery->insert(['givenName','familyName','homePhone','mobilePhone','relationshipToMember','member_id'])->values([
                                                'id'=>null,
                                                'givenName'=>$lines[$i]['emergency_contacts_givenName'],
                                                'familyName'=>$lines[$i]['emergency_contacts_familyName'],
                                                'homePhone'=>$lines[$i]['emergency_contacts_phoneNumber'],
                                                'mobilePhone'=>$lines[$i]['emergency_contacts_mobileNumber'],
                                                'relationshipToMember'=>$lines[$i]['emergency_contacts_relationship'],
                                                'member_id'=>$lastId+$i+1
                                            ]);
                                             //check if this file has emergency contact values
                                            //echo '<script>console.log('.'"emergency contacts headers detected, with values...."'.');</script>';
                                        }
                                        else{
                                         //   echo '<script>console.log('.'"emergency contacts headers detected, but no values. skipping..."'.');</script>';
                                        }
                                    }
                                    
                                    } 
                                
                                   
                                
                                }     
                            } 
                            if($memberResult = $memberQuery->execute()){//execute the memberQuery.  
                                        $categoryQuery->execute();   
                                        $custodianQuery->execute();
                                        $ecQuery->execute();
                                  
                                        if($multipleCount != 0){
                                            //debug($count);
                                            //debug($multipleCount);
                                            if($multipleCount == $count){
                                            echo 'The whole .csv file contains members already present in the system. Please make sure you have uploaded a new .csv file, and not a duplicate! <a href="../Members">click here to return to Members page</a>, or <a href="">Upload a new spreadsheet</a></p></p>';
                                            }
                                            else{
                                            echo '<p>Success! Although we detected '.$multipleCount.' duplicates data. They are not uploaded to the system. <a href="../Members">click here to return to Members page</a>, or <a href="">Upload a new spreadsheet</a></p></p>'; 
                                            }
                                        }
                                        else{
                                            echo '<p>Success! <a href="../Members">click here to return to Members page</a>, or <a href="">Upload a new spreadsheet</a></p></p>';
                                        }
                                    }
                                    else{
                                        echo '<p>An error occured. Please try again later.</p>';
                                    } 
                        }    
                            
                        }
                    } 
                else{
                    echo '<p>The .Csv is unsupported. Please make sure you have saved the .csv as either MS-DOS or Comma Delimitted, and <a href="">Try Again.</a></p>'; 
                } 
            }    
        }
            else{
                echo 'The .Csv is either wrong, or corrupted. <a href="">Please Try Again.</a></p>';
            }
            
            ?>
        </div>
        <?php
    }
    
    
    
   
    else{?>
            <div style="padding:10px;"></div>
            <div class='large-12 columns content material material'>
                <div class="material_help">
                    <h3 style="color:white; font-weight:regular;"><?= __('Batch Upload Members') ?></h3> </div>
                <p>You can upload a .csv spreadsheet from here, allowing you to enter multiple Membersat once!</p>
                <p>WARNING: USE THE TEMPLATE PROVIDED! SAVE AND UPLOAD ONLY AS .CSV FILE! ANY OTHER FILE MAY BREAK THE SYSTEM! Refer to the help page for more information.</p>

                <a href="../files/BatchUpload_MembersWithContacts_Template.xlsx">Excel Template for members, with emergency contacts</a> <br>
                <br>

                <form method=post action="" enctype="multipart/form-data">
                    <input type="file" name="csv" accept=".csv" id="csv">
                    <input id="submitBtn" type="submit" name="submit" value="submit" class="btn" disabled> </form>
            </div>
            <script>
                var myFile = document.getElementById('csv');
                //binds to onchange event of the input field
                myFile.addEventListener('change', function () {
                    //this.files[0].size gets the size of your file.
                    if (this.files[0].size > 2097152) {
                        alert("That file is too big");
                        document.getElementById('submitBtn').disabled = true;
                    }
                    else {
                        document.getElementById('submitBtn').disabled = false;
                    }
                });
            </script>
            <?php    
    }
    ?>
</body>

</html>