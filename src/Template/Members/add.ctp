<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?= $this->Html->css('children') ?>
    <title>New Member</title>
</head>
<body>
<?php
$this->Breadcrumbs->add(
    'Members',
    ['controller' => 'members', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add member'
//['controller' => 'members', 'action' => 'add']
);
?>
<div style="padding:10px;">
</div>
<div class="members form large-12 columns content material">
    <div class="material_members">
        <h3 style="color:white; fontweight:regular;"><?= __('New Member') ?></h3>
    </div>
    <?= $this->Form->create($member, array('type' => 'file', 'id' => 'contactform')); ?>
    <div class="row">
        <div class="row no-padding">
        </div>
        <div class="col-md-4 no-padding">
            <div class="row">
                <h3 style="color:black;">Image Upload</h3>
                <div class="picturebox">
                </div>
            </div>
            <div class="row no-padding">
                <?php echo $this->Form->input('image', ['label' => '', 'type' => 'file', 'id' => 'image']); ?>
                <h6 style="color:black; font-weight:300;">Max image size is 2MB</h6>

            </div>
        </div>

        <div class="col-md-4">
            <div class="row form-group">
                <?php echo $this->Form->input('givenName', array('id' => 'givenName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina')); ?>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('familyName', array('id' => 'familyName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Saffary')); ?>
            </div>
            <div class="row form-group">
                <div class="col-md-6  no-margin no-padding">
                    <div style="padding-right:10px;">
                        <div align="left form-group">
                            <?php echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'placeholder' => 'DD-MM-YYYY')); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <div float="right">
                        <?php $gender = ['M' => 'Male', 'F' => 'Female', 'N' => 'Not Specified']; ?>
                        <?php echo $this->Form->input('gender', array('id' => 'gender', 'style' => 'width: 100%', 'label' => 'Gender', 'type' => 'select', 'options' => $gender, 'empty' => 'Select Gender')); ?>
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
                            <div class="col-sm-1 no-margin no-padding" style="padding-top:22px;">
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
                            <?php echo $this->Form->input('active', array('id' => 'Active', 'type' => 'checkbox', 'checked' => true)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tab 1 End -->

        <!-- Tab 2 -->
        <div class="tab-pane" id="tab2">
            <div class="row form-group">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding_left:-100px;">
                        <h3 style="color:white; fontweight:regular;"><?= __('Emergency Contact') ?></h3>
                    </div>
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
                            <?php echo $this->Form->input('emergency_contacts.homePhone', array('id' => 'ehomePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('emergency_contacts.mobilePhone', array('id' => 'emobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilePhone form-control')); ?>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="row form-group">
                            <?php echo $this->Form->input('emergency_contacts.relationshipToMember', array('id' => 'erelationshipMember', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Father')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 2 End -->

        <!-- Tab 3-->
        <div class="tab-pane" id="tab3">
            <div class="row form-group">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding_left:-100px; margin-bottom:50px;">
                        <h3 style="color:white; fontweight:regular;"><?= __('Interests & Enrolments') ?></h3>
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
                                <div class="col-md-6">
                                    <input type="checkbox" id="isCustodian" name="isCustodian" value="isCustodian"/>Add as Custodian?<br></input>
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" id="inHelpRoster" name="inHelpRoster"<label>In Help roster?</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 3 End -->

        <!-- Tab 4 Start -->
        <div class="tab-pane" id="tab4">
            <div id="voltext" style="padding-left: 40px;">
                <p>Ensure "Volunteer" is selected as a subscription type to see this part of the form</p>
            </div>

            <div class="row form-group" id="volunteers">
                <div class="members form large-12 columns content material">
                    <div class="material_volunteers" style="padding-left:-100px;">
                        <h3 style="color:white; fontweight:regular;"><?= __('Add Volunteer') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.category_id', array('id' => 'volunteer_category', 'style' => 'width: 100%', 'label' => 'Category', 'type' => 'select', 'options' => $categories, 'onchange' => 'setRequired(this)', 'empty' => 'Select Category')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.volunteerStartDate', array('id' => 'startdatepicker', 'type' => 'text', 'readonly' => 'readonly',)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.medicareNumber', array('id' => 'medicareNumber', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '4444 55555 1')); ?>
                        </div>
                        <div class="row form-group">

                            <?php
                            echo $this->Form->label('Has referees?');
                            $options = ['No', 'Yes, 1 Referee', 'Yes, 2 Referees']; ?>
                            <?php echo $this->Form->input('refereeNum', array('id' => 'refereeNum', 'style' => 'width: 100%', 'label' => false, 'type' => 'select', 'options' => $options)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="padding:37px"></div>
                        <div>
                            <?php echo $this->Form->hidden('volunteers.active', array('id' => 'vactive', 'type' => 'checkbox')); ?>
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
                            <?php echo $this->Form->input('volunteers.workingWithChildrenExpirydate', array('id' => 'childexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly',)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('volunteers.policeCheckExpiryDate', array('id' => 'policeexpirydatepicker', 'type' => 'text', 'readonly' => 'readonly',)); ?>
                        </div>
                    </div>
                </div>

                <div id="single_referee">
                    <div class="members form large-12 columns content material" style="margin-top:-30px;">
                        <div class="material_volunteers" style="padding_left:-100px;">
                            <h3 style="color:white; fontweight:regular;"><?= __('Add Referee') ?></h3>
                        </div>
                        <div class="col-md-12">
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee_name', array('id' => 'referee_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee_phone', array('id' => 'referee_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="two_referees">
                    <div class="members form large-12 columns content material" style="margin-top:-30px;">
                        <div class="material_volunteers" style="padding_left:-100px;">
                            <h3 style="color:white; fontweight:regular;"><?= __('Add Two Referees') ?></h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <h3 style="color:black">Referee 1</h3>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee1_name', array('id' => 'referee1_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee1_phone', array('id' => 'referee1_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <h3 style="color:black">Referee 2</h3>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee2_name', array('id' => 'referee2_name', 'label' => 'Referee Name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cina', 'required' => true, 'novalidate')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('referee2_phone', array('id' => 'referee2_phone', 'label' => 'Referee Phone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homePhone form-control', 'required' => true, 'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 4 End -->
    </div>
    <button onclick="goBack()" class="previous_button" style="margin-bottom:-4px; ">Previous Page</button>
    <?= $this->Form->button(__('Submit'), ['disabled' => false, 'id' => 'submitBtn', 'class' => 'submitBtn']) ?>
</div>
<?= $this->Form->end() ?>

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
            //altFormat: "yy-mm-dd",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    <!-- Datepicker dob end -->

    <!-- Datepicker signup start -->
    $(function () {
        $(".signupdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd"
        });
        $("#signupdatepicker").datepicker("setDate", new Date());
    });
    <!-- Datepicker signup end -->

    <!--Volunteers Date pickers-->
    $(function () {
        var currentDate = new Date();
        var currentMonth = (new Date).getMonth();
        var currentDay = (new Date).getDate();
        var currentYear = (new Date).getFullYear();
        $("#childexpirydatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd",
            minDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    $(function () {
        var currentDate = new Date();
        var currentMonth = (new Date).getMonth();
        var currentDay = (new Date).getDate();
        var currentYear = (new Date).getFullYear();
        $("#policeexpirydatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd",
            minDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    $(function () {
        $("#startdatepicker").datepicker({
            yearRange: "-40:+1",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd",
        });
    });

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
    });

    /*Form Validator Start*/
    //Make Working For Children Number required if the volunteer is in the Childcare category
    function setRequired(selected) {
        //alert(selected);
        //alert(setRequired);
        if (selected.value == '4') {
            document.getElementById("workingWithChildrenNumber").required = true;
        }
        else {
            document.getElementById("workingWithChildrenNumber").required = false;
        }
    }

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
                        activaTab('tab1');
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
                        if (!validateSelect("volunteer_category")) {
                            activaTab('tab4');
                            return false;
                        }
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
                                return false;
                            }
                            if (!validateLength("referee_phone")) {
                                return false;
                            }
                        } else if (document.getElementById("refereeNum").value == 2) {
                            if (!validateText("referee1_name")) {
                                return false;
                            }
                            if (!validateLength("referee1_phone")) {
                                return false;
                            }
                            if (!validateText("referee2_name")) {
                                return false;
                            }
                            if (!validateLength("referee2_phone")) {
                                return false;
                            }
                        }
                    }
                }
            );
        }
    );
    /*Form Validator End*/

    $(function () { // Shorthand for $(document0.ready(function()

        //by default, remove the required attribute from volunteer's referees.
        //only add them back when they will be added As a referee.
        $('#referee_name').removeAttr('required');
        $('#referee_phone').removeAttr('required');
        $('#referee1_name').removeAttr('required');
        $('#referee1_phone').removeAttr('required');
        $('#referee2_name').removeAttr('required');
        $('#referee2_phone').removeAttr('required');


        //on page load, hide
        $('#addAsCustodian').hide();
        $('#hide').hide();
        //on change
        $("#categories-ids-4").change(function () {
            if ($(this).is(':checked')) {
                $('#addAsCustodian').show();
                $('#hide').show();
            }
            else {
                $('#isCustodian').prop('checked', false);
                $('#addAsCustodian').hide();
                $('#hide').hide();
            }

        });
        //disable the required properties on referees by default.

        if (document.getElementById("tier").value == 'V') {
            //$('.nav-tabs a[href="#tab4"]').tab('show')
            $('#volunteers').show();
            $("#voltext").hide();
            $('#relatedMember').hide();
        } else if (document.getElementById("tier").value == 'F') {
            $('#relatedMember').show();
            $('#volunteers').hide();
            $("#voltext").show();
        } else {
            $('#volunteers').hide();
            $('#relatedMember').hide();
            $("#voltext").show();

        }

        $('#tier').change(function () { // When an option is selected
            if ($(this).val() == 'V') {
                $('#single_referee').hide();
                $('#two_referees').hide();
                $('.nav-tabs a[href="#tab4"]').tab('show');
                $('#volunteers').show();
                $("#startdatepicker").datepicker("setDate", new Date());
                $("#voltext").hide();
            }
            else if ($(this).val() == 'F') {
                $('#relatedMember').show();
                $('#volunteers').hide();
                $("#voltext").show();
            }
            else {
                $('#volunteers').hide();
                $('#relatedMember').hide();
                $("#startdatepicker").val('');
                $("#voltext").show();
            }
        });

        //hide and disable the required fields.
        $('#refereeNum').change(function () {
            if ($(this).val() == 1) {

                $('#single_referee').show();
                //add the required attributes back
                $('#referee_name').prop('required', true);
                $('#referee_phone').prop('required', true);


                $('#two_referees').hide();

            } else if ($(this).val() == 2) {
                $('#two_referees').show();
                $('#referee1_name').prop('required', true);
                $('#referee1_phone').prop('required', true);
                $('#referee2_name').prop('required', true);
                $('#referee2_phone').prop('required', true);

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


</script>
</body>
</html>
