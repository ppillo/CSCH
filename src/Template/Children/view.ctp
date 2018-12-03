<html>
<head>
    <title>Child Details</title>
</head>
<body>
<?= $this->Html->css('actions') ?>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Child'
);
?>
<script type="application/javascript">

    //Datatables
    $(document).ready(function () {
        $('#classTable').DataTable({
            order:[0, 'asc'],
            dom: 'tp',
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]

        });
    });


</script>

<div style="padding:10px;"></div>

<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_children">

        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $child->id], array('class' => 'editbtn')) ?>
        <div class="col-md-1">
            <div style="margin-top:-2px;"><?php
                if ($child->image != null) {
                    //echo $member->image."<br /><br />";
                    echo '<a href="#openModal">'.$this->Html->image('images/children/' . $child->image, ['width' => '50px', 'hheight' => '50px', 'class' => 'img-responsive',]).'</a>';
                    // debug($member);
                } else {
                    echo $this->Html->image('noimage2xwhite.png' . $child->image, ['width' => '50px', 'hheight' => '50px', 'class' => 'img-responsive',]);;
                }
                ?>
            </div>
        </div>

        <h3 style="color:white; font-weight:400;"><?php echo ($child->givenName) . ' ' . ($child->familyName) ?></h3>
        <div id="openModal" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <?php  echo $this->Html->image('images/children/' . $child->image, ['class' => 'img-responsive',]); ?>
            </div>
        </div>
    </div>
    <div id="layout" class="members view large-12 medium-8 columns content material">
        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
               border="0">
            <h3 style="color:black; font-weight:400;">Personal Details</h3>
            <thead>
            <tr>
                <td class="heading">Given Name</td>
                <td class="heading">Family Name</td>
                <td class="heading">Gender</td>
                <td class="heading">Address</td>
                <td class="heading">Date of Birth</td>
            </tr>
            </thead>
            <tbody>
            <tr class="list">
                <td class="datatable"><?= h($child->givenName) ?></td>
                <td class="datatable"><?= h($child->familyName) ?></td>

                <td class="datatable">
                    <?php if (($child->gender) == 'M') {
                        echo 'Male';
                    } else if (($child->gender) == 'F') {
                        echo 'Female';
                    } else if (($child->gender) == 'N') {
                        echo 'Not Specified';
                    }
                    ?></td>
                <td class="datatable">
                    <?php
                    echo $child->streetAddress . "<br />";
                    echo $child->suburb . "<br />";
                    echo $child->state . "&nbsp" . ($child->postCode);
                    ?>
                </td>
                <td class="datatable"><?php
                    //$dob = $child->dateOfBirth;
                    echo $child->dateOfBirth->format('d/M/Y'); ?>
                </td>
            </tr>
            </tbody>
        </table>
    
        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
               border="0">
            <h3 style="color:black">Additional Details</h3>
            <thead>
            <tr>
                <td class="heading">Aboriginal?</td>
                <td class="heading">Islander?</td>
                <td class="heading">Allergy?</td>
                <td class="heading">Has Disability?</td>
                <td class="heading">Legal?</td>
                <td class="heading">Immunisation?</td>
            </tr>
            </thead>
            <tbody>
            <tr class="list">
                <td class="datatable"><?php if($child->aboriginal == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
                <td class="datatable"><?php if($child->islander == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
                <td class="datatable"><?php if($child->allergy == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
                <td class="datatable"><?php if($child->disabilty == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
                <td class="datatable"><?php if($child->legal == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
                <td class="datatable"><?php if($child->immunisation == 0){ echo 'No'; }else{ echo 'Yes';} ?></td>
            </tr>
            </tbody>
        </table>
        
    
    
    
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Classes</a></li>
        <li><a href="#tab2" data-toggle="tab">Custodians</a></li>
        <li><a href="#tab3" data-toggle="tab">Emergency Contacts</a></li>
        <li><a href="#tab4" data-toggle="tab">Notes</a></li>
    </ul>
    <!--    Tab 1-->
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <div class="related">
                <div class="members form large-12 columns content material">
                    <div class="material_children_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Classes') ?></h3>
                    </div>
                    <?php if (!empty($child->childcares)): ?>
                        <table class="table" id="classTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                               border="0">
                            <thead>
                            <tr>
                                <td class="heading"><?= __('num') ?></td>
                                <td class="heading"><?= __('Day') ?></td>
                                <td class="heading"><?= __('Time') ?></td>
                                <td class="heading"><?= __('Type') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($child->childcares as $childcares): ?>
                                <tr>
                                    <td class="datatable"> <?php
                                        $daynum = 0;
                                        if ($childcares->day == 'Mon'){
                                            $daynum = 1;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Tue'){
                                            $daynum = 2;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Wed'){
                                            $daynum = 3;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Thu'){
                                            $daynum = 4;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Fri'){
                                            $daynum = 5;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Sat'){
                                            $daynum = 6;
                                            echo $daynum;
                                        }
                                        elseif ($childcares->day == 'Sun'){
                                            $daynum = 7;
                                            echo $daynum;
                                        }

                                        ?></td>
                                    <td class="datatable"><?= h($childcares->day) ?></td>
                                    <td class="datatable"><?= h(($childcares->starttime) . '-' . ($childcares->endtime)) ?></td>
                                    <td class="datatable"><?= h($childcares->type) ?></td>


                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php endif; ?>
                </div>
            </div>

        </div>
        <!--        Tab 2 -->
        <div class="tab-pane" id="tab2">
            <div class="related">
                <div class="members form large-12 columns content material">
                    <div class="material_children_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Custodians') ?></h3>
                    </div>
                    <?php
                    use Cake\ORM\TableRegistry;

                    $membersTable = TableRegistry::get('members'); //get the members table
                    $childCustodiansTable = TableRegistry::get('custodians_children'); //get the custodians_children table         

                    if (!empty($child->custodians)): ?>
                        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                               border="0">
                            <tr>
                                <th scope="col"><?= __('Lives With Child?') ?></th>
                                <th scope="col"><?= __('Relationship To Child') ?></th>
                                <th scope="col"><?= __('Name') ?></th>
                                <th scope="col"><?= __('Primary?') ?></th>
                                <th scope="col" class="actions" style="width:100px;"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($child->custodians as $custodians): ?>
                                <tr>
                                    <td><?php

                                        $exists = $childCustodiansTable->exists(['custodian_id' => $custodians->id, 'child_id' => $child->id]);
                                        $custodianDetails = $childCustodiansTable->get(['custodian_id' => $custodians->id, 'child_id' => $child->id]);
                                        if ($custodianDetails->childLivingWithYou == 1) {
                                            echo 'Yes';
                                        } else {
                                            echo 'No';
                                        }
                                        ?></td>
                                    <td><?php if ($custodianDetails->relationshipToChild == 'M') {
                                            echo 'Mother';
                                        } else if ($custodianDetails->relationshipToChild == 'F') {
                                            echo 'Father';
                                        } else if ($custodianDetails->relationshipToChild == 'R') {
                                            echo 'Relative';
                                        }
                                        ?></td>
                                    <td><?php
                                        $member = $membersTable->get($custodians->member_id);
                                        echo $member->givenName . ' ' . $member->familyName;
                                        ?></td>
                                    <td><?php
                                        if ($child->primary_custodian == $custodians->id) {
                                            echo 'Yes';
                                        } else {
                                            echo 'No';
                                        }
                                        ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Custodians', 'action' => 'view', $custodians->id], array('title' => 'View', 'class' => 'view_button')) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!--Tab 3-->
        <div class="tab-pane" id="tab3">
            <div class="related">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Emergency Contacts') ?></h3>
                    </div>

                    <?php if (!empty($child->childcontacts)): ?>
                        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                               border="0">
                            <tr>

                                <th scope="col"><?= __('Name') ?></th>
                                <th scope="col"><?= __('Relationship to child') ?></th>
                                <th scope="col" style="width:300px;"><?= __('Phone Numbers') ?></th>
                                <th scope="col"><?= __('Address') ?></th>
 
                            </tr>
                            <?php foreach ($child->childcontacts as $contact): ?>
                                <tr>

                                    <td><?php echo $contact->givenName . ' ' . $contact->familyName; ?></td>
                                    <td><?php echo $contact->relationshipToChild; ?></td>
                                    <td><?php echo $contact->mobileNumber .' (M)' . "<br />";
                                        echo $contact->homeNumber.' (H)';
                                        ?></td>
                                    <td> <?php
                                        echo $contact->streetAddress . "<br />";
                                        echo $contact->suburb . "<br />";
                                        echo $contact->state . "&nbsp" . ($contact->postCode);
                                        ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!--Tab 4-->
        <div class="tab-pane" id="tab4">
            <div class="related">
                <div class="members form large-12 columns content material">
                    <div class="material_children_tab" style="padding-left:-100px;">
                        <div class='new_note' style="margin-top:-5px">
                            <a href="#openModalnote" style="float:right;" class='new_note_button'></a>
                        </div>
                        <h3 style="color:white; font-weight:400;"><?= __('Notes') ?></h3>
                        
                        <!-- MODAL FOR  NOTES -->
                        <div id="openModalnote" class="modalDialog">
                            <div>
                                <?= $this->Form->create($child, ['url' => ['controller' => 'Notes', 'action' => 'addbymodal'], 'type' => 'file']) ?>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="new_note_heading">
                                    <h3 style="color:white; font-weight:400; width: 200px;"><?= __('New Note') ?></h3>
                                </div>
                                <?php
                                echo $this->Form->input('date', array('id' => 'notesdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => ''));?>
                                <?php echo $this->Form->input('description', array('maxlength' => '500'));?> <p style="font-size: small">Max 500 characters</p>
                                <?php echo $this->Form->input('image', ['label' => '', 'type' => 'file', 'id' => 'image2', 'accept' => 'image/x-png,image/gif,image/jpeg']);
                                //Get child_id
                                ?>
                                <div class="row " style="padding-top:10px;">
                                    <?= $this->Form->button(__('Submit'), array('name'=>'modal_submit')) ?>
                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>

                    <!-- <a href="../../Notes/add?id=<?php echo $child->id ?>">Add New Note</a> -->
                    <?php if (!empty($child->notes)) { ?>
                        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                               border="0">
                            <tr>
                                <th scope="col"><?= __('Date') ?></th>
                                <th scope="col" style="word-wrap: break-word"><?= __('Description') ?></th>
                                <th scope="col"><?= __('Image') ?></th>
                            </tr>
                            <?php for ($i = 0; $i < sizeof($child->notes); $i++) { ?>
                                <tr>
                                    <td><?php
                                        $date = $child->notes[$i]['date'];
                                        echo $date->format('d/M/Y');

                                        ?></td>
                                    <td style="word-wrap: break-word"><?php echo $child->notes[$i]['description']; ?></td>
                                    <td><?php
                                        if (!empty($child->notes[$i]['image'])) {
                                            echo '<a href="../../webroot/notes/' . $child->notes[$i]['image'] .'" download ='. $child->notes[$i]['image'] .'>Click To Download Attached Image</a>';
                                        } else {
                                            echo "No Image";
                                        }
                                        ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <?php
                    } else {
                        echo "</br>";
                        echo "This Child Has No Note";
                    }
                    ?>
                    <!-- <a href="../../Notes/Add?id=<?php echo $child->id ?>">Add Note with Images</a> -->
                </div>
            </div>
        </div>
    </div>
    <!--Back button-->
    <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px; ">Previous Page</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
<script type="text/javascript">







    <!-- Datepicker notes start -->
    $(function () {
        var currentDate = new Date();
        $("#notesdatepicker").datepicker({
            yearRange: "-1:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            defaultdate: currentDate
        });
        $("#notesdatepicker").datepicker("setDate", new Date())
    });

    var myFile = document.getElementById('image');
    //binds to onchange event of the input field
    myFile.addEventListener('change', function () {
        //this.files[0].size gets the size of your file.
        if (this.files[0].size > 2097152) {
            alert("That file is too big");
            document.getElementById('submitBtn').disabled = true;
            $("#image").val('');
        } else {
            document.getElementById('submitBtn').disabled = false;
        }
    });
</script>
</body>
</html>