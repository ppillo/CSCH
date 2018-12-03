<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Member Edit</title>
    <?= $this->Html->css('style.css') ?>
</head>
<body>

<?php
use Cake\ORM\TableRegistry;

$this->Breadcrumbs->add(
    'Members',
    ['controller' => 'members', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Edit member'
//['controller' => 'members', 'action' => 'edit']
);

?>
<div style="padding:10px;">
</div>


<script>
    function goBack() {
        window.history.back();
    }
</script>

<div class="members form large-12 columns content material">
    <div class="material_members">

        <?php
        $em = $member->emergency_contacts; //stores the emergency contact's value to be used later
        ?>
        <h3 style="color:white; fontWeight:regular;"><?php echo ($member->givenName) . ' ' . ($member->familyName) ?></h3>
    </div>
    <?= $this->Form->create($member, array('type' => 'file', 'name' => 'image', 'id' => 'contactform',)); ?>
    <div class="row">
        <div class="row no-padding">
        </div>
        <div class="col-md-4 no-padding">
            <div class="row">
                <h3 style="color:black;">Image Upload</h3>
                <div class="picturebox">
                </div>
            </div>
            <div style="padding-left:70px;" class="row no-padding image-cropper">
                <?php
                if ($member->image != null) {
                    //echo $member->image."<br /><br />";
                    echo $this->Html->image('images/members/' . $member->image, ['width' => '200px', 'hheight' => '200px', 'class' => 'img-responsive']);
                    // debug($member);
                } else {
                    echo "no image available";
                }
                ?>
                <div style="padding-top:20px; ">
                    <?php echo $this->Form->input('image', ['label' => '', 'type' => 'file']); ?>
                </div>
            </div>
            <h6 style="color:black; font-weight:300;">Max image size is 2MB</h6>

        </div>

        <div class="col-md-4">
            <div class="row form-group">
                <?php echo $this->Form->input('givenName', array('id' => 'givenName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina')); ?>
            </div>

            <div class="row form-group">
                <?php echo $this->Form->input('familyName', array('id' => 'familyName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Saffary', 'style')); ?>
            </div>

            <div class="row form-group">
                <div class="col-md-6  no-margin no-padding">
                    <div style="padding-right:10px;">
                        <div align="left form-group">
                            <?php
                            $dob = $member->dateOfBirth;
                            if (!empty($member->dateOfBirth)) {
                                echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => (date_format($dob, 'd-m-Y'))));
                            } else {
                                echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly'));
                            }
                            //echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => (date_format($dob, 'd-m-Y')))); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <div float="right">
                        <?php $gender = ['M' => 'Male', 'F' => 'Female', 'N' => 'Not Specified']; ?>
                        <?php echo $this->Form->input('gender', array('id' => 'gender', 'style' => 'width: 100%', 'label' => 'Gender', 'type' => 'select', 'options' => $gender)); ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('email', array('id' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'email@email.com')); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row form-group">
                <?php echo $this->Form->input('streetAddress', array('id' => 'streetAddress', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '1 Flinders Street')); ?>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('suburb', array('id' => 'suburb', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Noble Park')); ?>
            </div>

            <div class="row form-group">
                <div class="col-md-6 no-margin no-padding">
                    <div style="padding-right:10px;">
                        <div align="left">
                            <?php echo $this->Form->input('postCode', array('id' => 'postCode', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '3000', 'style' => 'width: 100%')); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <div float="right">
                        <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                        <?php echo $this->Form->input('state', array('id' => 'state', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options)); ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('homePhone', array('id' => 'homePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control')); ?>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('mobilePhone', array('id' => 'mobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilePhone form-control')); ?>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Member Details</a></li>
        <li><a href="#tab2" data-toggle="tab">Emergency Contact</a></li>
        <li><a href="#tab3" data-toggle="tab">Enrolments & Interests</a></li>
        <li id="volunteersTab"><a href="#tab4" data-toggle="tab">Volunteers</a></li>
    </ul>


    <div class="tab-content">
        <!-- Tab 1 -->
        <div class="tab-pane active" id="tab1">
            <div class="row form-group">
                <div class="members form large-12 columns content material" style="padding-bottom: 100px">
                    <div class="material_members_tab" style="padding_left:-100px;">
                        <h3 style="color:white; fontweight:regular;"><?= __('Member Details') ?></h3>
                    </div>
                    <div class="row form-group" style="padding-top:10px;">
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="row form-group">
                            <?php $tier = ['I' => 'Individual', 'F' => 'Family', 'C' => 'Concession', 'Y' => 'Youth', 'V' => 'Volunteer', 'G' => 'Garden']; ?>
                            <?php echo $this->Form->input('tier', array('style' => 'width: 100%', 'id' => 'tier', 'label' => 'Subscription Type', 'type' => 'select', 'options' => $tier, 'empty' => 'Select Subscription Type')); ?>
                        </div>

                        <div class="row form-group no-margin no-padding" name="relatedMember" id="relatedMember">
                            <div class="col-md-11 no-margin no-padding">
                                <?php echo $this->Form->input('related_member', array('style' => 'width: 100%', 'id' => 'relatedMember', 'label' => 'Related Member', 'class' => 'chosen-select', 'options' => $familyMembers, 'empty' => '(Primary Family Member)')); ?>
                            </div>
                            <div class="col-md-1 no-margin no-padding" style="padding-top:22px;">
                                <a href="#openModal" title="help" class="help_primary">Help</a>
                            </div>

                            <div id="openModal" class="modalDialog">
                                <div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <h3 style="color:black;">You must first add a primary member, then you can add
                                        members to the family subscription, using the primary member's details.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('signupDate', array('id' => 'signupdatepicker', 'class' => 'signupdatepicker', 'type' => 'text', 'readonly' => 'readonly',)); ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('newsletter', array('type' => 'checkbox', 'label' => 'Subscribe to Newsletter')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('voting', array('type' => 'checkbox', 'label' => 'Can Vote')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('active', array('id' => 'Active', 'type' => 'checkbox')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 1 End -->

        <!-- Tab 2 -->
        <div class="tab-pane" id="tab2">
            <div class="row">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding_left:-100px;">
                        <h3 style="color:white; fontWeight:regular;"><?= __('Emergency Contact') ?></h3>
                    </div>
                    <?php
                    //echo $em[0]->givenName; 'value' => $em[0]->givenName)//test
                    if (sizeof($em) != 0) {
                        ?>
                        <div class="row" style="padding-top:10px;">
                        </div>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.givenName', array('id' => 'egivenName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Rob', 'value' => $em[0]->givenName)); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.familyName', array('id' => 'efamilyName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Smith', 'value' => $em[0]->familyName)); ?>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.homePhone', array('id' => 'ehomePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'value' => $em[0]->homePhone)); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.mobilePhone', array('id' => 'emobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilePhone form-control', 'value' => $em[0]->mobilePhone)); ?>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.relationshipToMember', array('id' => 'erelationshipMember', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Father', 'value' => $em[0]->relationshipToMember)); ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="row" style="padding-top:10px;">
                        </div>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.givenName', array('id' => 'egivenName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Rob')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.familyName', array('id' => 'efamilyName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Smith')); ?>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.homePhone', array('id' => 'ehomePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'mobilePhone form-control')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.mobilePhone', array('id' => 'emobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'homePhone form-control')); ?>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="row form-group">
                                <?php echo $this->Form->input('emergency_contacts.relationshipToMember', array('id' => 'erelationshipMember', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Father')); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Tab 2 end-->

        <!-- Tab 3-->
        <div class="tab-pane" id="tab3">
            <div class="row form-group">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding_left:-100px; margin-bottom:50px;">
                        <h3 style="color:white; fontWeight:regular;"><?= __('Interests & Enrolments') ?></h3>
                    </div>
                    <div class="row" style="padding-left:14px;">
                    </div>
                    <div class="col-md-6">
                        <div class="material_members_tab" style="margin-left: 0; margin-right: 0;">
                            <h3 style="color:white; fontweight:regular;"><?= __('Indicate interest in Categories') ?></h3>
                        </div>
                        <?php echo $this->Form->input('categories._ids', array('label' => false, 'multiple' => 'checkbox')); ?>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="material_members_tab" style="margin-left: 0; margin-right: 0;">
                                <h3 style="color:white; fontweight:regular;"><?= __('Enrol in Programs') ?></h3>
                            </div>
                            <?php echo $this->Form->input('programs._ids', array('label' => false, 'options' => $programs, 'class' => 'chosen-select')); ?>
                        </div>


                        <div class="row" style="padding-top:130px">
                            <div id="hide" class=" material_members_tab" style="margin-left: 0; margin-right: 0;">
                                <h3 style="color:white; fontweight:regular;"><?= __('Add Custodian') ?></h3>
                            </div>

                            <div style="padding-top:10px" id="addAsCustodian">
                                <?php
                                $custodianTable = TableRegistry::get('Custodians');
                                $custodian = $custodianTable->find()->where(['member_id' => $member->id])->first();
                                if (!empty($custodian)) {
                                    ?>

                                    <div id="custCheckBox">
                                        <input type="checkbox" id="isCustodian" name="isCustodian" value="isCustodian"
                                               checked/><label>Add as Custodian?</label><br>

                                        <?php
                                        if ($custodian->helpRoster == 'No') {
                                            echo '<input type="checkbox" id="inHelpRoster" name="inHelpRoster" value="inHelpRoster"
                                           /><label>In Help roster?</label><br>';
                                        } else {
                                            echo '<input type="checkbox" id="inHelpRoster" name="inHelpRoster" 
                                           checked/><label>In Help roster?</label><br>';
                                        } ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div id="custCheckBox" hidden>
                                        <div class="col-md-6">
                                            <input type="checkbox" id="isCustodian" name="isCustodian"
                                                   value="isCustodian"/><label>Add as Custodian?</label><br>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" id="inHelpRoster" name="inHelpRoster"
                                            /><label>In Help roster?</label><br>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 3 End -->

        <!-- Tab 4 Start -->
        <div class="tab-pane" id="tab4">
            <div id="voltext" style="padding-left: 40px;"><p>Ensure "Volunteer" is selected as a subscription type to
                    see this part of the form</p></div>
            <div class="row form-group" id="volunteers">
                <div class="members form large-12 columns content material">
                    <div class="material_volunteers" style="padding_left:-100px;">
                        <h3 style="color:white; fontWeight:regular;"><?= __('Volunteer Details') ?></h3>
                    </div>
                    <?php


                    $volunteerTable = TableRegistry::get('volunteers');
                    //$volInfo = $volunteerTable->find()->where(['member_id'=>$member->id])->first();
                    $vol = $volunteerTable->find()->where(['member_id' => $member->id])->first();


                    if (empty($vol) == true){ // show these if the member is NOT a volunteer
                    ?>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.category_id', array('id' => 'volunteer_category', 'style' => 'width: 100%', 'label' => 'Category', 'type' => 'select', 'options' => $categories, 'onchange' => 'setRequired(this)')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.volunteerStartDate', array('id' => 'startdatepicker', 'type' => 'text', 'readonly' => 'readonly')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.medicareNumber', array('id' => 'medicareNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '4444 55555 1')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->label('Has referees'); ?>
                            <?php
                            $referees = 0;
                            $options = ['No', 'Yes, 1 Referee', 'Yes, 2 Referees'];

                            if (!empty($refereeArray)) {
                                $referees = sizeof($refereeArray);
                            }

                            ?>
                            <?php
                            if ($referees == 0) { //if there's NO referees,
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options));
                            } else if ($referees == 1) {
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options, 'default' => $referees));
                            } else {
                                //ok, as the volunteer can only have 2 referees, MAX, disable the select box.
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options, 'default' => $referees, 'disabled' => 'disabled'));
                                //PHP won't be able to get the data from the select box above. use this hidden field to carry the data.
                                echo $this->Form->hidden('refereeNum', array('value' => $referees));
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php
                            echo $this->Form->input('volunteers.active', array('id' => 'vactive', 'type' => 'checkbox'));
                            ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.privateHealthFundName', array('id' => 'privateHealthFundName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ahm')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.privateHealthFundNumber', array('id' => 'privateHealthFundNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '123456789')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.referenceCheckComplete', array('type' => 'checkbox')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding:37px"></div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.workingWithChildrenNumber', array('id' => 'workingWithChildrenNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '12345678 10')); ?>
                        </div>
                        <div class="row form-group">
                            <?php
                            echo $this->Form->input('volunteers.workingWithChildrenExpirydate', array('id' => 'childexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly'));
                            ?>
                        </div>
                        <div class="row form-group">
                            <?php

                            echo $this->Form->input('volunteers.policeCheckExpiryDate', array('id' => 'policeexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly'));

                            ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                else { // show these if the member IS a volunteer
                    $refereesTable = TableRegistry::get('referees');
                    $refereeQuery = $refereesTable->find()->where(['volunteer_id' => $vol->id]);
                    $refereeArray = $refereeQuery->toArray();

                    ?>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.category_id', array('value' => $vol->category_id, 'id' => 'volunteer_category', 'style' => 'width: 100%', 'label' => 'Category', 'type' => 'select', 'options' => $categories, 'onchange' => 'setRequired(this)')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.volunteerStartDate', array('value' => (date_format(($vol->volunteerStartDate), 'd-m-Y')), 'id' => 'startdatepicker', 'type' => 'text', 'readonly' => 'readonly')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.medicareNumber', array('value' => $vol->medicareNumber, 'id' => 'medicareNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '4444 55555 1')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->label('Has referees'); ?>
                            <?php
                            $referees = 0;
                            $options = ['No', 'Yes, 1 Referee', 'Yes, 2 Referees'];

                            if (!empty($refereeArray)) {
                                $referees = sizeof($refereeArray);
                            }

                            ?>
                            <?php
                            if ($referees == 0) { //if there's NO referees,
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options));
                            } else if ($referees == 1) {
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options, 'default' => $referees));
                            } else {
                                //ok, as the volunteer can only have 2 referees, MAX, disable the select box.
                                echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options, 'default' => $referees, 'disabled' => 'disabled'));
                                //PHP won't be able to get the data from the select box above. use this hidden field to carry the data.
                                echo $this->Form->hidden('refereeNum', array('value' => $referees));
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php
                            echo $this->Form->input('volunteers.active', array('id' => 'vactive', 'type' => 'checkbox', 'value' => !($vol->active)));
                            ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.privateHealthFundName', array('value' => $vol->privateHealthFundName, 'id' => 'privateHealthFundName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'ahm')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.privateHealthFundNumber', array('value' => $vol->privateHealthFundNumber, 'id' => 'privateHealthFundNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '123456789')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.referenceCheckComplete', array('type' => 'checkbox', 'value' => !($vol->referenceCheckComplete))); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding:37px"></div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.workingWithChildrenNumber', array('value' => $vol->workingWithChildrenNumber, 'id' => 'workingWithChildrenNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '12345678 10')); ?>
                        </div>
                        <div class="row form-group">
                            <?php $childDate = ($vol->workingWithChildrenExpirydate);
                            if (!empty($childDate)) {
                                echo $this->Form->input('volunteers.workingWithChildrenExpirydate', array('id' => 'childexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => (date_format($childDate, 'd-m-Y'))));

                            } else {
                                echo $this->Form->input('volunteers.workingWithChildrenExpirydate', array('id' => 'childexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly'));
                            } ?>
                        </div>
                        <div class="row form-group">
                            <?php
                            if (!empty($vol->policeCheckExpiryDate)) {
                                echo $this->Form->input('volunteers.policeCheckExpiryDate', array('id' => 'policeexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => (date_format(($vol->policeCheckExpiryDate), 'd-m-Y'))));
                            } else {
                                echo $this->Form->input('volunteers.policeCheckExpiryDate', array('id' => 'policeexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly'));
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            if (empty($vol)) {
                ?>
                <div id="single_referee" hidden>
                    <div class="members form large-12 columns content material" style="margin-top:-30px;">
                        <div class="material_volunteers" style="padding_left:-100px;">
                            <h3 style="color:white; fontWeight:regular;"><?= __('First Referee') ?></h3>
                        </div>
                        <div class="col-md-12">

                            <div class="row form-group">

                                <?php
                                echo $this->Form->hidden('referee_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                echo $this->Form->input('referee_name', array('id' => 'referee_name', 'name' => 'referee_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'novalidate', 'maxLength' => '45')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee_phone', array('id' => 'referee_phone', 'name' => 'referee_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="two_referees" hidden>
                    <div class="members form large-12 columns content material" style="margin-top:-30px;">
                        <div class="material_volunteers" style="padding_left:-100px;">
                            <h3 style="color:white; fontWeight:regular;"><?= __('Add Two Referees') ?></h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <h3 style="color:black">Referee 1</h3>
                            </div>
                            <div class="row form-group">
                                <?php
                                echo $this->Form->hidden('referee1_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                echo $this->Form->input('referee1_name', array('id' => 'referee1_name', 'name' => 'referee1_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'novalidate', 'maxLength' => '45')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee1_phone', array('id' => 'referee1_phone', 'name' => 'referee1_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'novalidate')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <h3 style="color:black">Referee 2</h3>
                            </div>
                            <div class="row form-group">
                                <?php
                                echo $this->Form->hidden('referee2_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                echo $this->Form->input('referee2_name', array('id' => 'referee2_name', 'name' => 'referee2_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'novalidate', 'maxLength' => '45')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee2_phone', array('id' => 'referee2_phone', '' => 'referee2_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            if (!empty($vol)) {
                if (sizeof($refereeArray) != 0) { // if there ARE referees...
                    if (sizeof($refereeArray) == 1) { //automatically show, and pre-fill, single referee form.
                        ?>
                        <div id="single_referee">
                            <div class="members form large-12 columns content material" style="margin-top:-30px;">
                                <div class="material_volunteers" style="padding_left:-100px;">
                                    <h3 style="color:white; fontWeight:regular;"><?= __('First Referee') ?></h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row form-group">

                                        <?php
                                        echo $this->Form->hidden('referee_id', array('value' => $refereeArray[0]['id'], 'hidden', 'id' => 'referee_id'));
                                        echo $this->Form->input('referee_name', array('value' => $refereeArray[0]['name'], 'id' => 'referee_name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'formObject.noValidate' => true, 'maxLength' => '45')); ?>


                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee_phone', array('value' => $refereeArray[0]['phone'], 'id' => 'referee_phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'formObject.noValidate' => true)); ?>

                                        <?php echo $this->Html->link('Delete', ['controller' => 'referees', 'action' => 'deleteFromEdit', $refereeArray[0]['id']], ['id' => 'deleteReferee']
                                        ); ?>

                                        <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $refereeArray[0]['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $refereeArray[0]['id'])]) ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="two_referees" hidden>
                            <div class="members form large-12 columns content material" style="margin-top:-30px;">
                                <div class="material_volunteers" style="padding_left:-100px;">
                                    <h3 style="color:white; fontWeight:regular;"><?= __('Add Two Referees') ?></h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <h3 style="color:black">Referee 1</h3>
                                    </div>
                                    <!-- Pre-Fill the referee box with the first referee. -->
                                    <div class="row form-group">
                                        <?php echo $this->Form->hidden('referee1_id', array('value' => $refereeArray[0]['id'], 'hidden'));
                                        echo $this->Form->input('referee1_name', array('value' => $refereeArray[0]['name'], 'id' => 'referee1_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'formObject.noValidate' => true, 'maxLength' => '45')); ?>


                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee1_phone', array('value' => $refereeArray[0]['phone'], 'id' => 'referee1_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'formObject.noValidate' => true)); ?>
                                        <?php echo $this->Html->link('Delete', ['controller' => 'referees', 'action' => 'deleteFromEdit', $refereeArray[0]['id']], ['id' => 'deleteReferee']
                                        ); ?>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <h3 style="color:black">Referee 2</h3>
                                    </div>
                                    <div class="row form-group">

                                        <?php
                                        echo $this->Form->hidden('referee2_id', array('value' => '', 'hidden'));
                                        echo $this->Form->input('referee2_name', array('id' => 'referee2_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'formObject.noValidate' => true, 'maxLength' => '45')); ?>
                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee2_phone', array('id' => 'referee2_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'formObject.noValidate' => true)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (sizeof($refereeArray) == 2) { //automatically show, and pre-fill, two referees form, if there are 2 referees
                        ?>
                        <div id="single_referee">
                            <div class="members form large-12 columns content material" style="margin-top:-30px;">
                                <div class="material_volunteers" style="padding_left:-100px;">
                                    <h3 style="color:white; fontWeight:regular;"><?= __('First Referee') ?></h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee_name'); ?>
                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee_phone'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="two_referees" hidden>
                            <div class="members form large-12 columns content material" style="margin-top:-30px;">
                                <div class="material_volunteers" style="padding_left:-100px;">
                                    <h3 style="color:white; fontWeight:regular;"><?= __('Add Two Referees') ?></h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <h3 style="color:black">Referee 1</h3>
                                    </div>
                                    <!-- Pre-Fill the referee box with the first referee. -->
                                    <div class="row form-group">
                                        <?php echo $this->Form->hidden('referee1_id', array('value' => $refereeArray[0]['id'], 'hidden'));
                                        echo $this->Form->input('referee1_name', array('value' => $refereeArray[0]['name'], 'id' => 'referee1_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina')); ?>
                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee1_phone', array('value' => $refereeArray[0]['phone'], 'id' => 'referee1_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control')); ?>
                                        <?php echo $this->Html->link('Delete', ['controller' => 'referees', 'action' => 'deleteFromEdit', $refereeArray[0]['id']], ['id' => 'deleteReferee1']
                                        ); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <h3 style="color:black">Referee 2</h3>
                                    </div>
                                    <div class="row form-group">

                                        <?php
                                        echo $this->Form->hidden('referee2_id', array('value' => $refereeArray[1]['id'], 'hidden'));
                                        echo $this->Form->input('referee2_name', array('value' => $refereeArray[1]['name'], 'id' => 'referee2_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina')); ?>
                                    </div>
                                    <div class="row form-group">
                                        <?php echo $this->Form->input('referee2_phone', array('value' => $refereeArray[1]['phone'], 'id' => 'referee2_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control')); ?>
                                        <?php echo $this->Html->link('Delete', ['controller' => 'referees', 'action' => 'deleteFromEdit', $refereeArray[1]['id']], ['id' => 'deleteReferee2']
                                        ); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else { //if there's no referees
                    ?>
                    <div id="single_referee" hidden>
                        <div class="members form large-12 columns content material" style="margin-top:-30px;">
                            <div class="material_volunteers" style="padding_left:-100px;">
                                <h3 style="color:white; fontWeight:regular;"><?= __('First Referee') ?></h3>
                            </div>
                            <div class="col-md-12">

                                <div class="row form-group">

                                    <?php
                                    echo $this->Form->hidden('referee_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                    echo $this->Form->input('referee_name', array('id' => 'referee_name', 'name' => 'referee_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate', 'maxLength' => '45')); ?>
                                </div>
                                <div class="row form-group">
                                    <?php echo $this->Form->input('referee_phone', array('id' => 'referee_phone', 'name' => 'referee_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="two_referees" hidden>
                        <div class="members form large-12 columns content material" style="margin-top:-30px;">
                            <div class="material_volunteers" style="padding_left:-100px;">
                                <h3 style="color:white; fontWeight:regular;"><?= __('Add Two Referees') ?></h3>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <h3 style="color:black">Referee 1</h3>
                                </div>
                                <div class="row form-group">
                                    <?php
                                    echo $this->Form->hidden('referee1_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                    echo $this->Form->input('referee1_name', array('id' => 'referee1_name', 'name' => 'referee1_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate', 'maxLength' => '45')); ?>
                                </div>
                                <div class="row form-group">
                                    <?php echo $this->Form->input('referee1_phone', array('id' => 'referee1_phone', 'name' => 'referee1_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row form-group">
                                    <h3 style="color:black">Referee 2</h3>
                                </div>
                                <div class="row form-group">
                                    <?php
                                    echo $this->Form->hidden('referee2_id', array('value' => null, 'hidden', 'id' => 'referee_id'));
                                    echo $this->Form->input('referee2_name', array('id' => 'referee2_name', 'name' => 'referee2_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate', 'maxLength' => '45')); ?>
                                </div>
                                <div class="row form-group">
                                    <?php echo $this->Form->input('referee2_phone', array('id' => 'referee2_phone', '' => 'referee2_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } ?>
            <!-- Tab 4 End -->
        </div>

    </div>
    <div class="row form-group">
        <div class="col-md-6  no-margin no-padding">
            <div align="left">
                <div style="margin-top:12px;">
                    <a class="previousbtn" onclick="goBack()" class="previous_button">Previous Page</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 no-margin no-padding">
            <div float="right">
                <div>
                    <?= $this->Form->button(__('Submit'), ['disabled' => false, 'id' => 'submitBtn']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Datepicker dob Start -->
<?php echo $this->Html->script('validation'); ?>
<script type="text/javascript">
    $(function () {
        var currentDate = new Date();
        var currentMonth = (new Date).getMonth();
        var currentDay = (new Date).getDate();
        var currentYear = (new Date).getFullYear();
        currentYear = currentYear - 15;
        $("#dobdatepicker").datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    <!-- Datepicker dob end -->

    <!-- Datepicker signup start -->
    $(function () {
        $("#signupdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-1:+0",
            dateFormat: "dd-mm-yy"
        });
    });
    <!-- Datepicker signup end -->

    //
    <!-- the script for the homePhone & mobilePhone-->
    $('.homePhone').formatter({
        //change these if you want to change the format.
        'pattern': '({{99}}) {{9999}} {{9999}}'
    });
    $('.mobilePhone').formatter({
        'pattern': '({{99}}) {{9999}} {{9999}}'
    });
    $('#postCode').formatter({
        'pattern': '{{9999}}'
    });
    $('#medicareNumber').formatter({
        'pattern': '{{9999}} {{99999}} {{9}}'
    });
    $('#workingWithChildrenNumber').formatter({
        'pattern': '{{99999999}} {{99}}'
    });
    //from http://felipe.sabino.me/javascript/2012/01/30/javascipt-checking-the-file-size/
    //Here is the Javascript code to alert the file size every time the user selects a different file.
    //gets the element by its id
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
        ;
    });

    /*Form Validator Start*/
    function activaTab(tabID) {
        $('.nav-tabs a[href="#' + tabID + '"]').tab('show');
    }

    $(document).ready(
        function () {
            $("#submitBtn").click(function () {
                    if (!validateText("givenName")) {
                        return false;
                    }
                    if (!validateText("familyName")) {
                        return false;
                    }
                    if (!validateText("dobdatepicker")) {
                        return false;
                    }
                    if (!validateSelect("gender")) {
                        return false;
                    }
                    if (!validateText("email")) {
                        return false;
                    }
                    if (!validateEmail("email")) {
                        return false;
                    }
                    if (!validateText("streetAddress")) {
                        return false;
                    }
                    if (!validateText("suburb")) {
                        return false;
                    }
                    if (!validateLengthPost("postCode")) {
                        return false;
                    }
                    if (!validateEmpty("homePhone")) {
                        if (!validateLength("homePhone")) {
                            return false;
                        }
                    }
                    if (!validateLength("mobilePhone")) {
                        return false;
                    }
                    if (!validateSelect("tier")) {
                        return false;
                    }
                    if (!validateText("egivenName")) {
                        activaTab('tab2');
                        return false;
                    }
                    if (!validateText("efamilyName")) {
                        activaTab('tab2');
                        return false;
                    }
                    if (!validateEmpty("ehomePhone")) {
                        if (!validateLength("ehomePhone")) {
                            return false;
                        }
                    }
                    if (!validateLength("emobilePhone")) {
                        activaTab('tab2');
                        return false;
                    }
                    if (!validateText("erelationshipMember")) {
                        activaTab('tab2');
                        return false;
                    }

                    if (document.getElementById("tier").value == 'V') {
                        if (document.getElementById("volunteer_category").value == '4') {
                            if (!validateLengthWWCC("workingWithChildrenNumber")) {
                                activaTab('tab4');
                                return false;
                            }
                            if (!validateText("childexpirydatepicker")) {
                                activaTab('tab4');
                                return false;
                            }
                        } else {
                            if (!validateText("privateHealthFundName") && !validateText("medicareNumber")) {
                                activaTab('tab4');
                                alert("Please fill either the Medicare Number or the Private Health Fund");
                                return false;
                            } else {
                                if (validateText("privateHealthFundName") == true && validateText("medicareNumber") == false) {
                                    validateEmpty("medicareNumber");
                                    if (!validateText("privateHealthFundNumber")) {
                                        activaTab('tab4');
                                        return false;
                                    }
                                } else {
                                    validateEmpty("privateHealthFundName");
                                }
                            }
                            if (!validateText("workingWithChildrenNumber") && !validateText("policeexpirydatepicker")) {
                                activaTab('tab4');
                                alert("Please fill either the Working With Children Membership Number or the Police Check Expiry Date");
                                return false;
                            } else {
                                if (validateText("workingWithChildrenNumber") == true && validateText("policeexpirydatepicker") == false) {
                                    validateEmpty("policeexpirydatepicker");
                                    if (!validateText("childexpirydatepicker")) {
                                        activaTab('tab4');
                                        return false;
                                    }
                                } else {
                                    validateEmpty("workingWithChildrenNumber");
                                }
                            }
                        }
                        if (document.getElementById("refereeNum").value == 1) {
                            if (!validateText("referee_name")) {
                                //console.log('check referee_name');
                                activaTab('tab4');
                                return false;
                            }

                            if (!validateLength("referee_phone")) {
                                activaTab('tab4');
                                //console.log('check referee_phone');
                                return false;
                            }


                        } else if (document.getElementById("refereeNum").value == 2) {
                            if (!validateText("referee1_name")) {
                                //console.log('check referee1_name');
                                activaTab('tab4');

                                return false;
                            }

                            if (!validateLength("referee1_phone")) {
                                //console.log('check referee1_phone');
                                activaTab('tab4');
                                return false;
                            }

                            if (!validateText("referee2_name")) {
                                //console.log('check referee2_name');
                                activaTab('tab4');
                                return false;
                            }

                            if (!validateLength("referee2_phone")) {
                                //console.log('check referee2_phone');
                                activaTab('tab4');
                                return false;
                            }

                        }
                    }


                }
            );
        }
    );
    /*Form Validator End*/


    $(function () { // Shorthand for $(document0.ready(function() {
        // alert(document.getElementById("tier").value);

        //$('#addAsCustodian').hide();
        $('#volunteers').hide();
        $('#single_referee').hide();
        $('#two_referees').hide();
       $('#hide').hide();
//        $('#custCheckBox').hide();

        if($("#categories-ids-4").prop('checked')){
            $('#hide').show();
            $('#addAsCustodian').show();
            $('#custCheckBox').show();
        }

        if ($('#addAsCustodian').prop('checked')) {
            $('#addAsCustodian').show();
        }

        $("#categories-ids-4").change(function () {
            if ($(this).is(':checked')) {
                $('#custCheckBox').show();
                $('#hide').show();
            }
            else {
                $('#isCustodian').prop('checked', false);
                $('#custCheckBox').hide();
                $('#hide').hide();
            }

        });

        var isReferee = "<?php if (!empty($vol)) {
            echo 'true';
        } else {
            echo 'false';
        }

            ?>";
        var refereenum = 0;
        if (isReferee == 'true') {
            refereenum = "<?php if (empty($referees)) {
                echo 0;
            } else {
                echo $referees;
            }?>";
            //console.log(isReferee);
            if (refereenum == 1) {
                $('select[name="refereeNum"] option:contains(No)').hide();
                //console.log(refereenum);
            }
        } //else {
        //console.log(isReferee);

        //}

        if (document.getElementById("tier").value == 'V') {
            //$('.nav-tabs a[href="#tab4"]').tab('show')
            $('#volunteers').show();
            $('#voltext').hide();


            console.log($('#relatedMember').hide(document.getElementById("refereeNum").value));


            if (document.getElementById("refereeNum").value == 1 || refereeNum == 1) {
                $('#single_referee').show();
                $('#referee_name').prop('required', true);
                $('#referee_phone').prop('required', true);

                $('#two_referees').hide();
                $('#referee1_name').removeAttr('required');
                $('#referee1_phone').removeAttr('required');
                $('#referee2_name').removeAttr('required');
                $('#referee2_phone').removeAttr('required');

            }
            if (document.getElementById("refereeNum").value == 2 || refereeNum == 2) {
                $('#two_referees').show();
                $('#referee1_name').prop('required', true);
                $('#referee1_phone').prop('required', true);
                $('#referee2_name').prop('required', true);
                $('#referee2_phone').prop('required', true);

                $('#single_referee').hide();
                $('#referee_name').removeAttr('required');
                $('#referee_phone').removeAttr('required');

            }
            if (document.getElementById("refereeNum").value == 0 || refereeNum == 0) {
                $('#single_referee').hide();
                $('#two_referees').hide();
                $('#referee_name').removeAttr('required');
                $('#referee_phone').removeAttr('required');
                $('#referee1_name').removeAttr('required');
                $('#referee1_phone').removeAttr('required');
                $('#referee2_name').removeAttr('required');
                $('#referee2_phone').removeAttr('required');
            }

        } else if (document.getElementById("tier").value == 'F') {
            $('#relatedMember').show();
            $('#volunteers').hide();
            $('#voltext').show();

        } else {
            $('#volunteers').hide();
            $('#voltext').show();
            $('#relatedMember').hide();
        }

        $('#tier').change(function () { // When an option is selected
            if ($(this).val() == 'V') {
                $('#voltext').hide();

                console.log(refereenum);

                $('#single_referee').hide();
                $('#two_referees').hide();


                if (document.getElementById("refereeNum").value == 1 || refereeNum == 1) {
                    $('#single_referee').show();
                    $('#referee_name').prop('required', true);
                    $('#referee_phone').prop('required', true);

                    $('#two_referees').hide();
                    $('#referee1_name').removeAttr('required');
                    $('#referee1_phone').removeAttr('required');
                    $('#referee2_name').removeAttr('required');
                    $('#referee2_phone').removeAttr('required');

                }
                if (document.getElementById("refereeNum").value == 2 || refereeNum == 2) {
                    $('#two_referees').show();
                    $('#referee1_name').prop('required', true);
                    $('#referee1_phone').prop('required', true);
                    $('#referee2_name').prop('required', true);
                    $('#referee2_phone').prop('required', true);

                    $('#single_referee').hide();
                    $('#referee_name').removeAttr('required');
                    $('#referee_phone').removeAttr('required');

                }
                if (document.getElementById("refereeNum").value == 0 || refereeNum == 0) {
                    $('#single_referee').hide();
                    $('#two_referees').hide();
                    $('#referee_name').removeAttr('required');
                    $('#referee_phone').removeAttr('required');
                    $('#referee1_name').removeAttr('required');
                    $('#referee1_phone').removeAttr('required');
                    $('#referee2_name').removeAttr('required');
                    $('#referee2_phone').removeAttr('required');
                }


                $('.nav-tabs a[href="#tab4"]').tab('show');
                $('#volunteers').show();
                $("#startdatepicker").datepicker("setDate", new Date());
            }
            else if ($(this).val() == 'F') {
                $('#relatedMember').show();
                $('#volunteers').hide();
                $('#voltext').show();

            }
            else {
                $('#volunteers').hide();
                $('#voltext').show();
                $('#relatedMember').hide();
                $("#startdatepicker").val('');
            }
        });
        $('#refereeNum').change(function () {
            if ($(this).val() == 1) {
                $('#single_referee').show();
                $('#two_referees').hide();
                $('#referee1_name').removeAttr('required');
                $('#referee1_phone').removeAttr('required');
                $('#referee2_name').removeAttr('required');
                $('#referee2_phone').removeAttr('required');

            } else if ($(this).val() == 2) {
                $('#two_referees').show();
                $('#single_referee').hide();
            } else {

                $('#referee_name').removeAttr('required');
                $('#referee_phone').removeAttr('required');
                $('#referee1_name').removeAttr('required');
                $('#referee1_phone').removeAttr('required');
                $('#referee2_name').removeAttr('required');
                $('#referee2_phone').removeAttr('required');

                $('#single_referee').hide();
                $('#two_referees').hide();
            }
        });
    });
    <!--Volunteers Date pickers-->
    $(function () {
        var currentDate = new Date();
        var currentMonth = (new Date).getMonth();
        var currentDay = (new Date).getDate();
        var currentYear = (new Date).getFullYear();
        $("#startdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear + 5, currentMonth, currentDay),
            minDate: new Date(currentYear - 5, currentMonth, currentDay)
        });
        $("#policeexpirydatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear + 5, currentMonth, currentDay),
            minDate: new Date(currentYear - 5, currentMonth, currentDay)
        });
        $("#childexpirydatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear + 5, currentMonth, currentDay),
            minDate: new Date(currentYear - 5, currentMonth, currentDay)
        });
    });


    //Make Working For Children Number required if the volunteer is in the Childcare category
    function setRequired(selected) {
        if (selected.value == '4') {
            document.getElementById("volunteers-workingwithchildrennumber").required = true;
        }
        else {
            document.getElementById("volunteers-workingwithchildrennumber").required = false;
        }
    }

    $("#deleteReferee").click(function () {
        if (confirm('Are you sure you want to delete this Referee?') == false) {
            return false;
        } else {
            return true;
        }
    });
    $("#deleteReferee1").click(function () {
        if (confirm('Are you sure you want to delete this Referee?') == false) {
            return false;
        } else {
            return true;
        }
    });
    $("#deleteReferee2").click(function () {
        if (confirm('Are you sure you want to delete this Referee?') == false) {
            return false;
        } else {
            return true;
        }
    });

</script>
</body>
</html>

