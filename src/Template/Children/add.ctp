<?= $this->Html->css('children') ?>
<title>New Child</title>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->css('children') ?>

    <?= $this->Html->css('actions') ?>
    <title>New Child</title>
</head>
<body>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add Child'
);
?>
<div style="padding:10px;">
</div>
<div class="children form large-12 columns content material">
    <div class="material_children">
        <h3 style="color:white; font-weight:400;"><?= __('Add Child') ?></h3>
    </div>
    <?= $this->Form->create($child, array('type' => 'file', 'id' => 'contactform','novalidate' => true)); ?>
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
                            <?php echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly')); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <?php $gender = ['M' => 'Male', 'F' => 'Female', 'N' => 'Not Specified']; ?>
                    <?php echo $this->Form->input('gender', array('id' => 'gender', 'style' => 'width: 100%', 'label' => 'Gender: ', 'type' => 'select', 'options' => $gender, 'empty' => 'Select Gender')); ?>
                </div>
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
                            <?php echo $this->Form->input('postCode', array('id' => 'postCode', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%')); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                    <?php echo $this->Form->input('state', array('id' => 'state', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options)); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Child Details</a></li>
        <li><a href="#tab2" data-toggle="tab">Custodians</a></li>
        <li><a href="#tab3" data-toggle="tab">Emergency Contacts</a></li>
        <li><a href="#tab4" data-toggle="tab">Childcare Classes</a></li>
        <li><a href="#tab5" data-toggle="tab">Notes</a></li>
    </ul>

    <div class="tab-content">
        <!-- Tab 1 -->
        <div class="tab-pane active" id="tab1">
            <div class="row">
                <div class="children form large-12 columns content material">
                    <div class="material_children_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Child Details') ?></h3>
                    </div>
                    <div class="row" style="padding-top:10px;">
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('aboriginal'); ?>
                        <?php echo $this->Form->input('active', array('id' => 'Active', 'type' => 'checkbox', 'checked' => true)); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('islander', array('type' => 'checkbox')); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('allergy', array('type' => 'checkbox')); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('disability', array('type' => 'checkbox')); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('legal', array('type' => 'checkbox')); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $this->Form->input('immunisation', array('type' => 'checkbox')); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2 -->
        <div class="tab-pane" id="tab3">
            <div class="row form-group">
                <!-- ONLY THE PRIMARY CONTACTS WILL HAVE 'REQUIRED'. -->
                <div class="children form large-12 columns content material" id="primaryContact">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Emergency Contact') ?></h3>
                    </div>
                    <div class="row" style="padding-top:10px;">
                    </div>

                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.givenName', array('id' => 'cgivenName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Rob')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.familyName', array('id' => 'cfamilyName', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Smith')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->label('Additional Emergency Contacts'); ?>
                            <?php $options = ['None', '1 Additional Emergency Contact', '2 Additional Emergency Contacts', '3 Additional Emergency Contacts']; ?>
                            <?php echo $this->Form->select('moreContacts', $options, array('id' => 'moreContacts', 'style' => 'width: 100%', 'type' => 'select')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.mobileNumber', array('id' => 'cmobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.homeNumber', array('id' => 'chomePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.relationshipToChild', array('id' => 'crelationshipToChild', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Father', 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.streetAddress', array('id' => 'cstreetAddress', 'type' => 'text', 'class' => 'form-control', 'placeholder' => '1 Flinders Street')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts1.suburb', array('id' => 'csuburb', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park')); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts1.postCode', array('id' => 'cpostCode', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts1.state', array('id' => 'cstate', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options)); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Extra Contacts Start -->
                <div class="children form large-12 columns content material" id="extraContacts">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Second Contact') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.givenName', array('id' => 'cgivenName1', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob',  'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.familyName', array('id' => 'cfamilyName1', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith',  'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.mobileNumber', array('id' => 'cmobilePhone1', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'novalidate', 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.homeNumber', array('id' => 'chomePhone1', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control',  'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.relationshipToChild', array('id' => 'crelationshipToChild1', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father',  'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.streetAddress', array('id' => 'cstreetAddress1', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street',  'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.suburb', array('id' => 'csuburb1', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park',  'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts2.postCode', array('id' => 'cpostCode1', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%',  'novalidate')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts2.state', array('id' => 'cstate1', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'empty' => 'Select State',  'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extra Contacts End -->
                <!-- Extra Contacts 2 Start -->
                <div class="children form large-12 columns content material" id="extraContacts2">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Third Contact') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.givenName', array('id' => 'cgivenName2', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.familyName', array('id' => 'cfamilyName2', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith', 'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.mobileNumber', array('id' => 'cmobilePhone2', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'novalidate', 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.homeNumber', array('id' => 'chomePhone2', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.relationshipToChild', array('id' => 'crelationshipToChild2', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father', 'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.streetAddress', array('id' => 'cstreetAddress2', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.suburb', array('id' => 'csuburb2', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts3.postCode', array('id' => 'cpostCode2', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'novalidate')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts3.state', array('id' => 'cstate2', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'novalidate', 'empty' => 'Select State')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extra Contacts 2 End -->
                <!-- Extra Contacts 3 Start -->
                <div class="children form large-12 columns content material" id="extraContacts3">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('New Contact 3') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.givenName', array('id' => 'cgivenName3', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.familyName', array('id' => 'cfamilyName3', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith', 'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.mobileNumber', array('id' => 'cmobilePhone3', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'novalidate', 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.homeNumber', array('id' => 'chomePhone3', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.relationshipToChild', array('id' => 'crelationshipToChild3', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father', 'novalidate')); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.streetAddress', array('id' => 'cstreetAddress3', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.suburb', array('id' => 'csuburb3', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park', 'novalidate')); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts4.postCode', array('id' => 'cpostCode3', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'novalidate')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts4.state', array('id' => 'cstate3', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'novalidate')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extra Contacts 3 End -->
            </div>
        </div>
        <!-- Tab 2 End -->


        <!-- Tab 3 Start -->
        <div class="tab-pane" id="tab2">
            <div class="row form-group">
                <div class="children form large-12 columns content material">
                    <div class="material_custodians_tab">
                        <h3 style="color:white; font-weight:400;"><?= __('Primary Custodian') ?></h3>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('custodians._ids', array('style' => 'width: 100%', 'id' => 'custodians', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'empty' => 'Select Custodian', 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input('custodians.relationshipToChild', array('style' => 'width: 100%', 'id' => 'relationshipToChild', 'type' => 'select', 'options' => $relationshipToChild, 'empty' => 'Please Select', 'required' => true)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="row form-group">
                            <div class="col-md-12 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <div><?php echo $this->Form->input('custodians.childLivingWithYou', array('id' => 'childLivingWithYou', 'type' => 'checkbox')); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="children form large-12 columns content material">
                    <div class="material_custodians_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Custodians') ?></h3>
                    </div>
                    <div class="row form-group" style="padding-top:10px;">
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->label('Additional Custodians'); ?>
                            <?php $additionalCustodians = ['No', '1 Additional Custodian', '2 Additional Custodians', '3 Additional Custodians']; ?>
                            <?php echo $this->Form->select('additionalCustodians', $additionalCustodians, array('id' => 'moreCustodian', 'style' => 'width: 100%', 'type' => 'select')); ?>
                        </div>

                    </div>
                </div>

                <!-- Extra Custodian Start -->
                <div class="children form large-12 columns content material" id="extraCustodian">
                    <div class="material_custodians_tab">
                        <h3 style="color:white; font-weight:400;"><?= __('Additional Custodians') ?></h3>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('custodians1._ids', array('style' => 'width: 100%', 'id' => 'custodians1', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'onchange' => 'getNewVal(this)', 'empty' => 'Select Custodian',  'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input('custodians1.relationshipToChild', array('id' => 'relationshipToChild1', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'empty' => 'Please Select',  'required' => true)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="row form-group">
                            <div><?php echo $this->Form->input('custodians1.childLivingWithYou', array('id' => 'childLivingWithYou1', 'type' => 'checkbox')); ?></div>
                        </div>
                    </div>
                </div>
                <!-- Extra Custodian End -->

                <!-- Extra Custodian Start 2 -->
                <div class="children form large-12 columns content material" id="extraCustodian2">
                    <div class="material_custodians_tab">
                        <h3 style="color:white; font-weight:400;"><?= __('Additional Custodians') ?></h3>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('custodians2._ids', array('style' => 'width: 100%', 'id' => 'custodians2', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'empty' => 'Select Custodian',  'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input('custodians2.relationshipToChild', array('id' => 'relationshipToChild2', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'empty' => 'Please Select',  'required' => true)); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="row form-group">
                            <div><?php echo $this->Form->input('custodians2.childLivingWithYou', array('id' => 'childLivingWithYou2', 'type' => 'checkbox')); ?></div>
                        </div>
                    </div>
                </div>
                <!-- Extra Custodian End 2 -->

                <!-- Extra Custodian Start 3 -->

                <div class="children form large-12 columns content material" id="extraCustodian3">
                    <div class="material_custodians_tab">
                        <h3 style="color:white; font-weight:400;"><?= __('Additional Custodians') ?></h3>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row form-group">
                            <?php echo $this->Form->input('custodians3._ids', array('id' => 'custodians3', 'style' => 'width: 100%', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'onchange' => 'getNewVal(this)', 'empty' => 'Select Custodian',  'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input('custodians3.relationshipToChild', array('id' => 'relationshipToChild3', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'empty' => 'Please Select',  'required' => true)); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="row form-group">
                            <div><?php echo $this->Form->input('custodians3.childLivingWithYou', array('id' => 'childLivingWithYou3', 'type' => 'checkbox')); ?></div>
                        </div>
                    </div>
                </div>
                <!-- Extra Custodian End 3 -->

                <!--MODAL-->


            </div>
        </div>
        <!-- Tab 3 End -->

        <!-- Tab 4 Start -->
        <div class="tab-pane" id="tab4">
            <div class="row">
                <div class="children form large-12 columns content material">
                    <div class="material_childcares" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Classes') ?></h3>
                    </div>
                    <div class="row" style="padding-top:10px;">
                    </div>
                    <div class="col-md-4">
                        <p style="font-size: small">To add this child to a class, ensure "Active" is checked</p>
                        <div class="childcares hide_active">
                            <?php echo $this->Form->input('childcares._ids', array('multiple' => 'checkbox', 'label' => false)); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 4 End -->

        <!-- Tab 5 Start -->
        <div class="tab-pane" id="tab5">
            <div class="row">
                <div class="children form large-12 columns content material">
                    <div class="material_children_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Notes') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->input('notes.date', array('id' => 'notesdatepicker', 'type' => 'text', 'readonly' => 'readonly',));
                        echo $this->Form->input('notes.description');
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 5 End -->
    </div>
    <div class="row form-group" style="margin-bottom:-10px;">
        <div class="col-md-6  no-margin no-padding">
            <div align="left">
                <div style="margin-top:12px;">
                    <a class="previousbtn" onclick="goBack()" class="previous_button">Previous Page</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 no-margin no-padding">
            <div float="right">
                <div style="float:right;">
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
        currentYear = currentYear - 1;
        currentMonth = currentMonth - 3;
        $("#dobdatepicker").datepicker({
            yearRange: "-6:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    <!-- Datepicker dob end -->

    <!-- Datepicker notes start -->
    $(function () {
        var currentDate = new Date();
        $("#notesdatepicker").datepicker({
            yearRange: "-1:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            altFormat: "yy-mm-dd",
            defaultdate: currentDate
        });
        $("#notesdatepicker").datepicker("setDate", new Date())
    });
    <!-- Datepicker signup end -->

    <!-- Hide childcare options if Active is not checked-->
    this.checkActive();

    $('#Active').change(function () {
        self.hideTab();
        //uncheck childcares boxes when Active is unchecked
        $('.childcares input[type=checkbox]').each(function () {
            $(this).prop('checked', false)
        });
    });

    function hideTab() {
        $('div.childcares').toggleClass('hide_active');
    }

    function checkActive() {
        if ($('#Active').attr('checked', true)) {
            $('div.childcares').removeClass('hide_active');
        }
        else {
            $('div.childcares').addClass('hide_active');
        }
    }

    <!-- the script for the homephone & mobilephone-->
    $('.homephone').formatter({
        //change these if you want to change the format.
        'pattern': '({{99}}) {{9999}} {{9999}}'
    });
    $('.mobilephone').formatter({
        'pattern': '({{99}}) {{9999}} {{9999}}'
    });
    $('.postCode').formatter({
        'pattern': '{{9999}}'
    });
    <!-- Child Contacts Start -->
    $(function () {

        $('#extraContacts').toggle(0);
        $('#extraContacts2').toggle(0);
        $('#extraContacts3').toggle(0);

        $('#moreContacts').change(function () {
            if ($(this).val() == '1') {
                $('#extraContacts').show();
                $('#extraContacts2').hide();
                $('#extraContacts3').hide();
            }
            else if ($(this).val() == '2') {
                $('#extraContacts').show();
                $('#extraContacts2').show();
                $('#extraContacts3').hide();

            }
            else if ($(this).val() == '3') {
                $('#extraContacts').show();
                $('#extraContacts2').show();
                $('#extraContacts3').show();
            }
            else {
                $('#extraContacts').hide();
                $('#extraContacts2').hide();
                $('#extraContacts3').hide();

            }

        });
    });
    <!-- Child Contacts End -->

    <!-- Custodian Start -->


    $(function () {
        $('#extraCustodian').hide();
        $('#extraCustodian2').hide();
        $('#extraCustodian3').hide();


        $('#moreCustodian').change(function () {

            if ($(this).val() == '1') {
                $('#extraCustodian').show();
                $('#extraCustodian2').hide();
                $('#extraCustodian3').hide();
            }
            else if ($(this).val() == '2') {
                $('#extraCustodian').show();
                $('#extraCustodian2').show();
                $('#extraCustodian3').hide();
            }
            else if ($(this).val() == '3') {
                $('#extraCustodian').show();
                $('#extraCustodian2').show();
                $('#extraCustodian3').show();
            }
            else {

                $('#extraCustodian').hide();
                $('#extraCustodian2').hide();
                $('#extraCustodian3').hide();
            }

        });

    });
    <!-- Custodian End -->

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
                    if (!validateText("streetAddress")) {
                        return false;
                    }
                    if (!validateText("suburb")) {
                        return false;
                    }
                    if (!validateLengthPost("postCode")) {
                        return false;
                    }
                    if (!validateChosen("custodians")) {
                        activaTab('tab2');
                        return false;
                    }
                    if (!validateSelect("relationshipToChild")) {
                        activaTab('tab2');
                        return false;
                    }

                    if (document.getElementById("moreCustodian").value != 0) {
                        var more = document.getElementById("moreCustodian").value;
                        for (i = 0; i < more;) {
                            i++;
                            var custodians = "custodians" + i;
                            var relationshipToChild = "relationshipToChild" + i;

                            if (!validateChosen(custodians)) {
                                activaTab('tab2');
                                return false;
                            }
                            if (!validateSelect(relationshipToChild)) {
                                activaTab('tab2');
                                return false;
                            }

                        }
                    }
                    if (!validateText("cgivenName")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateText("cfamilyName")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateLength("cmobilePhone")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateEmpty("chomePhone")) {
                        if (!validateLength("chomePhone")) {
                            activaTab('tab3');
                            return false;
                        }
                    }
                    if (!validateText("crelationshipToChild")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateText("cstreetAddress")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateText("csuburb")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (!validateLengthPost("cpostCode")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (validateEmpty("cstate")) {
                        activaTab('tab3');
                        return false;
                    }
                    if (document.getElementById("moreContacts").value != 0) {
                        var moreContacts = document.getElementById("moreContacts").value;
                        for (i = 0; i < moreContacts;) {
                            i++;
                            var cgivenName = "cgivenName" + i;
                            var cfamilyName = "cfamilyName" + i;
                            var chomePhone = "chomePhone" + i;
                            var cmobilePhone = "cmobilePhone" + i;
                            var crelationshipToChild = "crelationshipToChild" + i;
                            var cstreetAddress = "cstreetAddress" + i;
                            var csuburb = "csuburb" + i;
                            var cpostCode = "cpostCode" + i;
                            var cstate = "cstate" + i;
                            if (!validateText(cgivenName)) {
                                activaTab('tab3');
                                console.log('check ' + cfamilyName);
                                return false;
                            }
                            if (!validateText(cfamilyName)) {
                                activaTab('tab3');
                                console.log('check ' + cfamilyName);
                                return false;
                            }
                            if (!validateLength(cmobilePhone)) {
                                activaTab('tab3');
                                console.log('check ' + cmobilePhone);
                                return false;
                            }
                            if (!validateEmpty(chomePhone)) {
                                if (!validateLength(chomePhone)) {
                                    activaTab('tab3');
                                    console.log('check ' + chomePhone);
                                    return false;
                                }
                            }
                            if (!validateText(crelationshipToChild)) {
                                activaTab('tab3');
                                console.log('check ' + crelationshipToChild);
                                return false;
                            }
                            if (!validateText(cstreetAddress)) {
                                activaTab('tab3');
                                console.log('check ' + cstreetAddress);
                                return false;
                            }
                            if (!validateText(csuburb)) {
                                activaTab('tab3');
                                console.log('check ' + csuburb);
                                return false;
                            }
                            if (!validateLengthPost(cpostCode)) {
                                activaTab('tab3');
                                console.log('check ' + cpostCode);
                                return false;
                            }
                            if (!validateSelect(cstate)) {
                                activaTab('tab3');
                                console.log('check ' + cstate);
                                return false;
                            }
                        }
                    }
                }
            );
        }
    );
    /*Form Validator End*/
</script>
</body>
</html>