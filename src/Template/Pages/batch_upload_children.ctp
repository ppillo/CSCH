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
     if(isset($_POST['submit'])){ //if file is uploaded...
        ?>
        <div style="padding:10px;"></div>
        <div class='large-12 columns content material material'>
            <div class="material_help">
                <h3 style="color:white; font-weight:regular;"><?= __('Batch Upload Children') ?></h3> </div>
            <?php
            $childrenTable = TableRegistry::get('children');
            $custodianChildrenTable = TableRegistry::get('custodians_children');
            $childcontactsTable = TableRegistry::get('childcontacts');
         
            $insertQuery = $childrenTable->query();
            $childcontactsQuery = $childcontactsTable->query();
            $custodianQuery = $custodianChildrenTable->query(); 
            
            $childResult = $childrenTable->find()->last();
            $lastId = 0;
                //debug(empty($memberResult->id));
                if(!(empty($childResult->id))){
                    $lastId = $childResult->id;   
            } 
         
            
            if(isset($_FILES['csv'])){
                 //check if this is a valid csv file
                $open = fopen($_FILES['csv']['tmp_name'],"r");
                if(!($data=fgetcsv($open))){
                    echo 'invalid file. please try again.';
                } 
                
                else{ //the file is a valid .ctp... now let's see if it's ACTUALLY valid.
                //get the csv's header.
                $array = array_map('str_getcsv',file($_FILES['csv']['tmp_name']));
                $header = array_shift($array);
                $fileHeader = implode(" ",$header);
                    
                //the header needed for this to work. This can also act as a sample data.
                $targetHeader = array('givenName' => 'Alice ',
	                                   'familyName' => 'Connery',
	                                   'gender' => 'F',
	                                   'dateOfBirth' => '2013-07-21',
	                                   'aboriginal' => '0',
	                                   'islander' => '0',
	                                   'disability' => '0',
	                                   'legal' => '0',
                                       'immunisation' => '1',
	                                   'active' => '1',
	                                   'streetAddress' => '125 Hawhtorn Street',
	                                   'suburb' => 'Caulfield North',
	                                   'state' => 'VIC',
                                        'postCode' => '3161');
                
                //two different reader methods. I've found that there are many ways CSV files can be saved by Microsoft excel, and I want to make this website as accessible as possible.
                    
                $readerMethod1 = Reader::input(new SplFileObject($_FILES['csv']['tmp_name']));
                $readerMethod2 = Factory::reader($_FILES['csv']['tmp_name'],';','"','\\');
                $lines = [];
                // Use the first method to read the .csv file.
                 foreach ($readerMethod1->fetch() as $line) { 
                    $lines[] = $line;
                 }
                //debug(sizeof($lines));
                 if(sizeof($lines)!=0){//check if the initial read at least returns something.
                    if(sizeof($lines[0])==1){ //wait a minute, there's supposed to be at least 17 'columns' in this array! read that file again with the second method!

                    unset($lines);
                    $lines = [];
                    foreach ($readerMethod2->fetch() as $line) {
                    $lines[] = $line;
                    } 
                    }
                    if(sizeof($lines[0])==1){ //if the size of this array is STILL 1 after the two methods, then this file is either corrupted, or not supported. 

                    echo '<p>The .Csv is unreadable for Members upload. Please make sure you have uploaded the correct spreadsheet,and <a href="">Try Again.</a></p>'; 
                    }else{  
                        $diff = sizeof(array_diff_key($targetHeader,$lines[0]));
                        if($diff>1){

                            echo '<p>The .Csv is not suitable for Children upload. Please make sure you have uploaded the correct spreadsheet,and <a href="">Try Again.</a></p>';
                        }
                        else{//okay, NOW we can get in to the business of actually inserting data.
                            //Store length of lines
                            $count = count($lines);    
                            $multipleCount = 0;
                            
                            
                            //check if this file has BOM in it! if yes, rename it.
                            foreach ($lines as $index => $line){
                                foreach ($line as $linekey => $linevalue) {
                                if (strpos($linekey, "\xef\xbb\xbf") !== false) { //checks if the BOM is in this key.
                                    //debug('BOM found!');
                                    //change the key.
                                    $newkey = trim($linekey, "\xef\xbb\xbf");
                                    $lines[$index][$newkey] = $lines[$index][$linekey]; 
                                    unset($lines[$index][$linekey]);
                                }
                                break;
                                }
                            }
                            
                            
                            for ($i = 0; $i<$count;$i++){
                            if(empty($lines[$i]['givenName'])  && empty($lines[$i]['familyName']) && empty($lines[$i]['dateOfBirth']) && empty($lines[$i]['streetAddress']) ){
                                //skip this line if it has null values. do nothing.
                            }
                            else{
                                $thisChildDOB = strtotime(str_replace('/','-',$lines[0]['dateOfBirth'])); 
                                //check if this row already exists in the database, if yes, don't put it in the query, if no, insert it.
                                        $checker = $childrenTable->find('all')->where([
                                        'givenName'=>$lines[$i]['givenName'],
                                        'familyName'=>$lines[$i]['familyName'],
                                        'gender'=>$lines[$i]['gender'],
                                        'dateOfBirth'=>date('Y-m-d',$thisChildDOB),
                                        'streetAddress'=>$lines[$i]['streetAddress'],
                                        'suburb'=>$lines[$i]['suburb'],
                                        'state'=>$lines[$i]['state'],
                                        'postCode'=>$lines[$i]['postCode']
                                        ])->first();
                                if(!empty($checker)){ //there's already a member with these  info. skip them.
                                    $multipleCount = $multipleCount+1;

                                }
                                else{
                                    //add an insert query
                                    $insertQuery->insert([ 'id','givenName','familyName','gender','dateOfBirth','islander','aboriginal','disability','legal','immunisation','active','streetAddress','suburb','state','postCode','primary_custodian'])->values([
                                        'id'=>$lastId+$i+1, 
                                        'givenName'=>$lines[$i]['givenName'],
                                        'familyName'=>$lines[$i]['familyName'],
                                        'gender'=>$lines[$i]['gender'],
                                        'dateOfBirth'=>date('Y-m-d',$thisChildDOB),
                                        'islander'=>$lines[$i]['islander'],
                                        'aboriginal'=>$lines[$i]['aboriginal'],
                                        'disability'=>$lines[$i]['disability'],
                                        'legal'=>$lines[$i]['legal'],
                                        'immunisation'=>$lines[$i]['immunisation'],
                                        'active'=>$lines[$i]['active'],
                                        'streetAddress'=>$lines[$i]['streetAddress'],
                                        'suburb'=>$lines[$i]['suburb'],
                                        'state'=>$lines[$i]['state'],
                                        'postCode'=>$lines[$i]['postCode'],
                                        'primary_custodian'=>0
                                    ]);
                                    
                                    //check if there's anything in the emergency contacts
                                    
                                    if(array_key_exists('emergency_contacts_givenName', $lines[$i]) && array_key_exists('emergency_contacts_familyName',$lines[$i]) && array_key_exists('emergency_contacts_mobileNumber',$lines[$i]) && array_key_exists('emergency_contacts_streetAddress',$lines[$i])){
                                    
                                    if(!(($lines[$i]['emergency_contacts_givenName']=="")  &&  ($lines[$i]['emergency_contacts_familyName']=="") && ($lines[$i]['emergency_contacts_phoneNumber']=="") && ($lines[$i]['emergency_contacts_mobileNumber']=="") && ($lines[$i]['emergency_contacts_relationship']=="") && ($lines[$i]['emergency_contacts_suburb']=="") && ($lines[$i]['emergency_contacts_streetAddress']=="") )){
                                            $childcontactsQuery->insert(['givenName','familyName','homeNumber','mobileNumber','relationshipToChild','children_id','streetAddress','suburb','postCode','state'])->values([
                                                'id'=>null,
                                                'givenName'=>$lines[$i]['emergency_contacts_givenName'],
                                                'familyName'=>$lines[$i]['emergency_contacts_familyName'],
                                                'homeNumber'=>$lines[$i]['emergency_contacts_phoneNumber'],
                                                'mobileNumber'=>$lines[$i]['emergency_contacts_mobileNumber'],
                                                'relationshipToChild'=>$lines[$i]['emergency_contacts_relationship'],
                                                'children_id'=>$lastId+$i+1,
                                                'streetAddress'=>$lines[$i]['emergency_contacts_streetAddress'],
                                                'suburb'=>$lines[$i]['emergency_contacts_suburb'],
                                                'postCode'=>$lines[$i]['emergency_contacts_postcode'],
                                                'state'=>$lines[$i]['emergency_contacts_state'],
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
                            if($childResult = $insertQuery->execute()){
                                $childcontactsQuery->execute();
                                
                                if($multipleCount != 0){ 
                                            if($multipleCount == $count){
                                            echo 'The whole .csv file contains children already present in the system. Please make sure you have uploaded a new .csv file, and not a duplicate! <a href="../Children">click here to return to Children page</a>, or <a href="">Upload a new spreadsheet</a></p></p>';
                                            }
                                            else{
                                            echo '<p>Success! Although we detected '.$multipleCount.' duplicates data. They are not uploaded to the system. <a href="../Children">click here to return to Children page</a>, or <a href="">Upload a new spreadsheet</a></p></p>'; 
                                            }
                                        }
                                        else{
                                            echo '<p>Success! <a href="../Children">click here to return to Children page</a>, or <a href="">Upload a new spreadsheet</a></p></p>';
                                        }
                            }else{
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
   
    else {?>
            <div style="padding:10px;"></div>
            <div class='large-12 columns content material material'>
                <div class="material_help">
                    <h3 style="color:white; font-weight:regular;"><?= __('Batch Upload Children') ?></h3> </div>
                <p>You can upload a .csv spreadsheet from the link below, allowing you to enter multiple Children at once!</p>
                <p>WARNING: USE THE TEMPLATE PROVIDED! SAVE AND UPLOAD ONLY AS .CSV FILE! ANY OTHER FILE MAY BREAK THE SYSTEM! Refer to the <a href="../pages/help">help</a> page for more information.</p>
                <a href="../files/BatchUpload_Children_EmergencyContacts_Template.xlsx">Excel Template for children, With Emergency Contacts</a> <br>
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