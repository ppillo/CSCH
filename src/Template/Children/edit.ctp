<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('children') ?>
    <?= $this->Html->css('actions') ?>
    <title>Edit Child</title>
</head>
<body>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Edit Child'
);
?>
<div style="padding:10px;">
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?php
use Cake\ORM\TableRegistry;

?>
<div class="large-12 columns content material">
    <div class="material_children">
        <h3 style="color:white; font-weight:400;"><?= __('Edit Child') ?></h3>
    </div>
    <?= $this->Form->create($child, array('type' => 'file','novalidate' => true)); ?>
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
                <?php
                if ($child->image != null) {
                    //echo $member->image."<br /><br />";
                    echo $this->Html->image('images/children/' . $child->image, ['width' => '200px', 'hheight' => '200px', 'class' => 'img-responsive']);                    // debug($member);
                } else {
                    echo "no image available";
                }
                ?>

                <div style="padding-top:20px; ">
                <?php echo $this->Form->input('image', ['label' => '', 'type' => 'file', 'id' => 'image']); ?>
                </div>
                <h6 style="color:black; font-weight:300;">Max image size is 2MB</h6>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row form-group">
                <?php echo $this->Form->input('givenName', array('id' => 'givenName', 'class' => 'form-control', 'placeholder' => 'Cina')); ?>
            </div>

            <div class="row form-group">
                <?php echo $this->Form->input('familyName', array('id' => 'familyName', 'class' => 'form-control', 'placeholder' => 'Saffary', 'style')); ?>
            </div>

            <div class="row form-group">
                <div class="col-md-6  no-margin no-padding">
                    <div style="padding-right:10px;">
                        <div align="left form-group">
                            <?php
                            $newdob = $child->dateOfBirth;

                            if (!empty($child->dateOfBirth)) {
                                echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => (date_format($newdob, 'd-m-Y'))));
                            } else {
                                echo $this->Form->input('dateOfBirth', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'dobdatepicker', 'type' => 'text', 'readonly' => 'readonly'));

                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no-margin no-padding">
                    <div float="right">
                        <?php $gender = ['M' => 'Male', 'F' => 'Female', 'N' => 'Not Specified']; ?>
                        <?php echo $this->Form->input('gender', array('id' => 'gender', 'style' => 'width: 100%', 'label' => 'Gender: ', 'type' => 'select', 'options' => $gender)); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row form-group">
                <?php echo $this->Form->input('streetAddress', array('id' => 'streetAddress', 'class' => 'form-control', 'placeholder' => '1 Flinders Street')); ?>
            </div>
            <div class="row form-group">
                <?php echo $this->Form->input('suburb', array('id' => 'suburb', 'class' => 'form-control', 'placeholder' => 'Noble Park')); ?>
            </div>

            <div class="row form-group">
                <div class="col-md-6 no-margin no-padding">
                    <div style="padding-right:10px;">
                        <div align="left">
                            <?php echo $this->Form->input('postCode', array('id' => 'postCode', 'class' => 'form-control', 'placeholder' => '3000', 'style' => 'width: 100%')); ?>
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
            <div class="row">
                <div class="members form large-12 columns content material">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('Emergency Contacts') ?></h3>
                    </div>
                    <div class="row" style="padding-top:10px;">
                    </div>
                    <?php
                    if (sizeof($child->childcontacts) == 0){
                        //leave the blank form if this child have no childcontacts
                        ?>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.givenName', array('id' => 'cgivenName', 'class' => 'form-control', 'placeholder' => 'Rob')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.familyName', array('id' => 'cfamilyName', 'class' => 'form-control', 'placeholder' => 'Smith')); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.mobileNumber', array('id' => 'cmobilePhone', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'required' => true)); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.homeNumber', array('id' => 'chomePhone', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.relationshipToChild', array('id' => 'crelationshipToChild', 'class' => 'form-control', 'placeholder' => 'Father', 'required' => true)); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.streetAddress', array('id' => 'cstreetAddress', 'class' => 'form-control', 'placeholder' => '1 Flinders Street')); ?>
                            </div>
                            <div class="row form-group">
                                <?php echo $this->Form->input('childcontacts.suburb', array('id' => 'csuburb', 'class' => 'form-control', 'placeholder' => 'Noble Park')); ?>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6 no-margin no-padding">
                                    <div style="padding-right:10px;">
                                        <div align="left">
                                            <?php echo $this->Form->input('childcontacts.postCode', array('id' => 'cpostCode', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 no-margin no-padding">
                                    <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                    <?php echo $this->Form->input('childcontacts.state', array('id' => 'cstate', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options)); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    else{
                    //fill the form if this child DO have one.
                    $i = 0;
                    foreach ($child->childcontacts as $cc) {

                    echo '<div class="members form large-12 columns content material">';
                    echo '  <div class="material_members_tab" style="padding-left:-100px;">';

                    if ($i != 0) {
                        $formName = 'ext_childcontacts' . $i;
                    } else {
                        $formName = 'ext_childcontacts';
                    }
                    if ($i == 0) {
                        echo '<h3 style="color:white; font-weight:400;">First Contact</h3>';
                    } else if ($i == 1) {
                        echo '<h3 style="color:white; font-weight:400;">Second Contact</h3>';
                    } else if ($i == 2) {
                        echo '<h3 style="color:white; font-weight:400;">Third Contact</h3>';
                    } else if ($i == 3) {
                        echo '<h3 style="color:white; font-weight:400;">Fourth Contact</h3>';
                    }
                    echo '</div>';
                    ?>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->hidden($formName . '.id', ['value' => $cc['id']]); ?>
                            <?php echo $this->Form->input($formName . '.givenName', array('label' => 'Given Name', 'id' => 'cgivenName'.$i, 'class' => 'form-control', 'placeholder' => 'Rob', 'value' => $cc['givenName'])); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.familyName', array('label' => 'Family Name', 'id' => 'cfamilyName'.$i, 'class' => 'form-control', 'placeholder' => 'Smith', 'value' => $cc['familyName'])); ?>
                        </div>
                        <div class="row form-group">
                        <?php    
                                echo '<div class="row form-group" id="deleteBtn'.$i.'">';
                                echo $this->Form->postLink(__('Delete'), ['controller'=>'childcontacts','action' => 'deleteFromEdit', $cc['id']], ['confirm' => __('Are you sure you want to delete this emergency contacts?', $cc['id'] )]);
                                echo '</div>';
                            
                        ?>
                            
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.mobileNumber', array('label' => 'Mobile Number', 'id' => 'cmobilePhone'.$i, 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'value' => $cc['mobileNumber'], 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.homeNumber', array('label' => 'Home Number', 'id' => 'chomePhone'.$i, 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control', 'value' => $cc['homeNumber'])); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.relationshipToChild', array('label' => 'Relationship To Child', 'id' => 'crelationshipToChild'.$i, 'class' => 'form-control', 'placeholder' => 'Father', 'value' => $cc['relationshipToChild'], 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.streetAddress', array('label' => 'Street Address', 'id' => 'cstreetAddress'.$i, 'class' => 'form-control', 'placeholder' => '1 Flinders Street', 'value' => $cc['streetAddress'], 'required')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '.suburb', array('label' => 'Suburb', 'id' => 'csuburb'.$i, 'class' => 'form-control', 'placeholder' => 'Noble Park', 'value' => $cc['suburb'])); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input($formName . '.postCode', array('label' => 'Postcode', 'id' => 'cpostCode'.$i, 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'value' => $cc['postCode'])); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input($formName . '.state', array('label' => 'State', 'id' => 'cstate'.$i, 'style' => 'width: 100%', 'type' => 'select', 'options' => $options, 'value' => $cc['state'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
                }
                }

                $additionalContacts = ['No', '1 Additional Contact', '2 Additional Contacts', '3 Additional Contacts']; //the options.
                if (sizeof($child->childcontacts) < 4) { //if this child has less than 4 childcontacts, allow the user to add more.
                    if ((sizeof($child->childcontacts) == 3)) {
                        array_pop($additionalContacts);
                        array_pop($additionalContacts);
                    } else if ((sizeof($child->childcontacts) == 2)) {
                        array_pop($additionalContacts);
                    }
                    echo $this->Form->label('Add New Contact(s)?');
                    echo $this->Form->select('newContacts', $additionalContacts, array('id' => 'newContacts', 'style' => 'width: 25%', 'type' => 'select'));
                }
                ?>
                <!-- Extra Contacts Start -->
                <div class="children form large-12 columns content material" id="extraContacts">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('New Contact') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.givenName', array('id' => 'ext_cgivenName2', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.familyName', array('id' => 'ext_cfamilyName2', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith', 'formObject.noValidate' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.mobileNumber', array('id' => 'ext_cmobilePhone2', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.homeNumber', array('id' => 'ext_chomePhone2', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.relationshipToChild', array('id' => 'ext_crelationshipToChild2', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.streetAddress', array('id' => 'ext_cstreetAddress2', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts2.suburb', array('id' => 'ext_csuburb2', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts2.postCode', array('id' => 'ext_cpostCode2', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'formObject.noValidate' => true)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts2.state', array('id' => 'ext_cstate2', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'formObject.noValidate' => true, 'empty' => 'Select State')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extra Contacts End -->
                <!-- Extra Contacts 2 Start -->
                <div class="children form large-12 columns content material" id="extraContacts2">
                    <div class="material_members_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?= __('New Contact 2') ?></h3>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.givenName', array('id' => 'ext_cgivenName3', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.familyName', array('id' => 'ext_cfamilyName3', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith', 'formObject.noValidate' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.mobileNumber', array('id' => 'ext_cmobilePhone3', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.homeNumber', array('id' => 'ext_chomePhone3', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.relationshipToChild', array('id' => 'ext_crelationshipToChild3', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.streetAddress', array('id' => 'ext_cstreetAddress3', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts3.suburb', array('id' => 'ext_csuburb3', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts3.postCode', array('id' => 'ext_cpostCode3', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'formObject.noValidate' => true)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts3.state', array('id' => 'ext_cstate3', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'formObject.noValidate' => true, 'empty' => 'Select State')); ?>
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
                            <?php echo $this->Form->input('childcontacts4.givenName', array('id' => 'ext_cgivenName4', 'type' => 'text', 'class' => 'givenName form-control', 'placeholder' => 'Rob', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.familyName', array('id' => 'ext_cfamilyName4', 'type' => 'text', 'class' => 'familyName form-control', 'placeholder' => 'Smith', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.mobileNumber', array('id' => 'ext_cmobilePhone4', 'type' => 'text', 'placeholder' => '(04) 9999 9999', 'class' => 'mobilephone form-control', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.homeNumber', array('id' => 'ext_chomePhone4', 'type' => 'text', 'placeholder' => '(03) 9999 9999', 'class' => 'homephone form-control')); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.relationshipToChild', array('id' => 'ext_crelationshipToChild4', 'type' => 'text', 'class' => 'relationshipToChild form-control', 'placeholder' => 'Father', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.streetAddress', array('id' => 'ext_cstreetAddress4', 'type' => 'text', 'class' => 'streetAddress form-control', 'placeholder' => '1 Flinders Street', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->input('childcontacts4.suburb', array('id' => 'ext_csuburb4', 'type' => 'text', 'class' => 'suburb form-control', 'placeholder' => 'Noble Park', 'formObject.noValidate' => true)); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php echo $this->Form->input('childcontacts4.postCode', array('id' => 'ext_cpostCode4', 'type' => 'text', 'class' => 'postCode form-control', 'placeholder' => '3000', 'style' => 'width: 100%', 'formObject.noValidate' => true)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 no-margin no-padding">
                                <?php $options = ['VIC' => 'VIC', 'NSW' => 'NSW', 'TAS' => 'TAS', 'SA' => 'SA', 'QLD' => 'QLD', 'NT' => 'NT', 'WA' => 'WA']; ?>
                                <?php echo $this->Form->input('childcontacts4.state', array('id' => 'ext_cstate4', 'style' => 'width: 100%', 'label' => 'State: ', 'type' => 'select', 'options' => $options, 'formObject.noValidate' => true)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extra Contacts 3 End -->

            </div>

        </div>
    </div>

    <!-- Tab 3 -->
    <div class="tab-pane" id="tab2">
        <div class="row form-group">
            <div class="members form large-12 columns content material">
                <div class="material_custodians_tab" style="padding-left:-100px;">
                    <h3 style="color:white; font-weight:400;"><?= __('Primary Custodian') ?></h3>
                </div>
                <?php

                $primaryCust = 0;
                $custodianTable = TableRegistry::get('custodians');
                $custodianChildrenTable = TableRegistry::get('custodians_children'); //get the custodians_children table
                if ($child->primary_custodian != 0) {
                    $primaryCust = $custodianTable->get($child->primary_custodian);
                }

                if ($child->primary_custodian == 0){

                ?>

                <div class="col-sm-6 col-md-4">
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
                                    <?php echo $this->Form->input('custodians.relationshipToChild', array('style' => 'width: 100%', 'id' => 'relationshipToChild', 'type' => 'select', 'options' => $relationshipToChild, 'empty' => 'Select', 'required' => true)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <div><?php echo $this->Form->input('custodians.childLivingWithYou', array('id' => 'childLivingWithYou', 'type' => 'checkbox')); ?></div>
                    </div>
                    <div class="row form-group">
                    </div>
                    <p>This child does not have a primary custodian. Please choose one.</p>
                </div>
            </div>
            <?php
            }else{//show this form if the primary custodian exists.
            $custodianDetails = $custodianChildrenTable->get(['custodian_id' => $child->primary_custodian, 'child_id' => $child->id]);
            ?>
            <div class="col-sm-6 col-md-4">
                <div class="row form-group">
                    <?php echo $this->Form->input('custodians._ids', array('style' => 'width: 100%', 'id' => 'custodians', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'value' => $child->primary_custodian, 'required' => true)); ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="row form-group">
                    <div class="col-md-10 no-margin no-padding">
                        <div style="padding-right:10px;">
                            <div align="left">
                                <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                <?php echo $this->Form->input('custodians.relationshipToChild', array('style' => 'width: 100%', 'id' => 'relationshipToChild', 'type' => 'select', 'options' => $relationshipToChild, 'value' => $custodianDetails->relationshipToChild, 'required' => true)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="row form-group">
                    <div><?php echo $this->Form->input('custodians.childLivingWithYou', array('id' => 'childLivingWithYou', 'type' => 'checkbox', 'value' => !($custodianDetails->childLivingWithYou))); ?></div>
                </div>
                <div class="row form-group">
                </div>
            </div>
        </div>


        <?php
        }

        $i = 1;
        foreach ($child->custodians as $extraCustodian) {
            if ($extraCustodian['id'] != $child->primary_custodian && $child->primary_custodian != 0) {
                //if this child has an extra custodian, show them.
                $extraCustodianDetails = $custodianChildrenTable->get(['custodian_id' => $extraCustodian->id, 'child_id' => $child->id]);
                $formName = 'extraCustodian' . $i;
                ?>
                <div class="members form large-12 columns content material">
                    <div class="material_custodians_tab" style="padding-left:-100px;">
                        <h3 style="color:white; font-weight:400;"><?php echo 'Custodian ' . ($i + 1); ?></h3>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input($formName . '._ids', array('style' => 'width: 100%', 'id' => 'custodians', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'value' => $extraCustodian->id, 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input($formName . '.relationshipToChild', array('style' => 'width: 100%', 'id' => 'relationshipToChild', 'type' => 'select', 'options' => $relationshipToChild, 'value' => $extraCustodianDetails->relationshipToChild, 'formObject.noValidate' => true, 'required' => true)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div><?php echo $this->Form->input($formName . '.childLivingWithYou', array('id' => 'childLivingWithYou', 'type' => 'checkbox', 'value' => !($extraCustodianDetails->childLivingWithYou))); ?></div>
                        </div>
                        <div class="col-sm-6 col-md-4">

                        </div>
                        <div class="row form-group">
                        </div>
                    </div>
                </div>

                <?php
                $i++;
            }//end for each
        }

        ?>
        <?php
        $additionalCustodians = ['No', '1 Additional Custodian', '2 Additional Custodians', '3 Additional Custodians']; //the options.
        if (sizeof($child->custodians) < 4) { //if this child has less than 4 custodians, allow the user to add more.
            if ((sizeof($child->custodians) == 3)) {
                array_pop($additionalCustodians);
                array_pop($additionalCustodians);
            } else if ((sizeof($child->custodians) == 2)) {
                array_pop($additionalCustodians);
            } ?>


            <div class="children form large-12 columns content material">
                <div class="material_custodians_tab" style="padding-left:-100px;">
                    <h3 style="color:white; font-weight:400;"><?= __('Custodians') ?></h3>
                </div>
                <div class="row form-group" style="padding-top:10px;">
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">

                        <?php echo $this->Form->label('Add New Custodian(s)?'); ?>
                        <?php echo $this->Form->select('newCustodians', $additionalCustodians, array('id' => 'newCustodians', 'style' => 'width: 100%', 'type' => 'select')); ?>

                    </div>

                </div>
            </div>
            <?php
        } else {//set the newCustodians to 0.
            echo $this->Form->hidden('newCustodians', array('id' => 'newCustodians', 'style' => 'width: 25%', 'value' => '0'));
        }
        ?>
        <div id="newCustodian1" class="members form large-12 columns content material">
            <div class="material_custodians_tab" style="padding-left:-100px;">
                <h3 style="color:white; font-weight:400;"><?= __('New Custodian 1') ?></h3>
            </div>
            <div>
                <div class="col-md-12 no-margin no-padding">
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <?php echo $this->Form->input('newCustodian1._ids', array('style' => 'width: 100%', 'id' => 'custodians1', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'empty' => 'Select Custodian', 'onchange' => 'getNewVal(this)', 'formObject.noValidate' => true, 'required' => true)); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div class="col-md-10 no-margin no-padding">
                                <div style="padding-right:10px;">
                                    <div align="left">
                                        <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                        <?php echo $this->Form->input('newCustodian1.relationshipToChild', array('empty' => 'Choose', 'id' => 'relationshipToChild1', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'formObject.noValidate' => true, 'required' => true)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="row form-group">
                            <div><?php echo $this->Form->input('newCustodian1.childLivingWithYou', array('id' => 'childLivingWithYou1', 'type' => 'checkbox')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="newCustodian2" class="members form large-12 columns content material">
            <div class="material_custodians_tab" style="padding-left:-100px;">
                <h3 style="color:white; font-weight:400;"><?= __('New Custodian 2') ?></h3>
            </div>
            <div class="col-md-12 no-margin no-padding">
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <?php echo $this->Form->input('newCustodian2._ids', array('style' => 'width: 100%', 'id' => 'custodians2', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'empty' => 'Select Custodian', 'onchange' => 'getNewVal(this)', 'formObject.noValidate' => true, 'required' => true)); ?>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <div class="col-md-10 no-margin no-padding">
                            <div style="padding-right:10px;">
                                <div align="left">
                                    <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                    <?php echo $this->Form->input('newCustodian2.relationshipToChild', array('empty' => 'Choose', 'id' => 'relationshipToChild2', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'formObject.noValidate' => true, 'required' => true)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <div><?php echo $this->Form->input('newCustodian2.childLivingWithYou', array('id' => 'childLivingWithYou2', 'type' => 'checkbox')); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="newCustodian3" class="members form large-12 columns content material">
            <div class="material_custodians_tab" style="padding-left:-100px;">
                <h3 style="color:white; font-weight:400;"><?= __('New Custodian 3') ?></h3>
            </div>
            <div class="col-md-12 no-margin no-padding">
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <?php echo $this->Form->input('newCustodian3._ids', array('style' => 'width: 100%', 'id' => 'custodians3', 'class' => 'chosen-select form-control', 'label' => 'Custodians', 'type' => 'select', 'options' => $custodians, 'empty' => 'Select Custodian', 'onchange' => 'getNewVal(this)', 'formObject.noValidate' => true, 'required' => true)); ?>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <div class="col-md-10 no-margin no-padding">
                            <div style="padding-right:10px;">
                                <div align="left">
                                    <?php $relationshipToChild = ['M' => 'Mother', 'F' => 'Father', 'R' => 'Relative']; ?>
                                    <?php echo $this->Form->input('newCustodian3.relationshipToChild', array('empty' => 'Choose', 'id' => 'relationshipToChild3', 'style' => 'width: 100%', 'type' => 'select', 'options' => $relationshipToChild, 'formObject.noValidate' => true, 'required' => true)); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="row form-group">
                        <div><?php echo $this->Form->input('newCustodian3.childLivingWithYou', array('id' => 'childLivingWithYou3', 'type' => 'checkbox')); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tab 4 -->
<div class="tab-pane" id="tab4">
    <div class="row">
        <div class="members form large-12 columns content material">
            <div class="material_childcares" style="padding-left:-100px;">
                <h3 style="color:white; font-weight:400;"><?= __('Classes') ?></h3>
            </div>
            <div class="row" style="padding-top:10px;">
            </div>
            <div class="col-md-4">
                <p style="font-size: small">To add this child to a class, ensure "Active" is checked</p>
                <div class="childcares hide_active">
                    <?php echo $this->Form->input('childcares._ids', array('multiple' => 'checkbox')); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tab 5 -->

<div class="tab-pane" id="tab5">
    <div class="members form large-12 columns content material">
        <div class="material_children_tab" style="padding-left:-100px;">
            <div class='new_note' style="margin-top:-5px">
                <a href="#openModal" style="float:right;" class='new_note_button'></a>
            </div>
            <h3 style="color:white; font-weight:400;"><?= __('Child Notes') ?></h3>

        </div>
        <div class="related">
            <?php if (!empty($child->notes)) { ?>
                <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                       border="0">
                    <tr>
                        <th scope="col" style="color:black;"><?= __('Date') ?></th>
                        <th style="color:black;" scope="col"><?= __('Description') ?></th>
                        <th scope="col" style="color:black;"><?= __('Image') ?></th>
                    </tr>
                    <?php for ($i = 0; $i < sizeof($child->notes); $i++) { ?>
                        <tr>
                            <td><?php
                                $date = $child->notes[$i]['date'];
                                echo $date->format('d/m/Y');

                                ?></td>
                            <td><?php echo $child->notes[$i]['description']; ?></td>
                            <td><?php
                                if (!empty($child->notes[$i]['image'])) {
                                    echo '<a href="../../webroot/notes/' . $child->notes[$i]['image'] . '" download =' . $child->notes[$i]['image'] . '>Click To Download Attached Image</a>';
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
        </div>


        <!--
        <div class="row">
            <p>New note for this child</p>
        </div>
        <?php
        echo $this->Form->input('notes.date', array('style' => 'width:125px', 'id' => 'notesdatepicker', 'type' => 'text', 'readonly' => 'readonly', 'value' => ''));
        echo $this->Form->input('notes.description');
        //Get child_id
        $id = $child->id;
        echo $this->Form->text('notes.children_id', array('value' => $id, 'readonly' => 'readonly', 'style' => 'display: none'));
        ?>
        -->


    </div>
</div>

<div class="row form-group" style="margin-bottom:-10px;">
    <div class="col-md-6  no-margin no-padding">
        <div align="left">
            <div style="margin-top:12px;">
                <a class="previousbtn" onclick="goBack()" id="previous_button">Previous Page</a>
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

    <!-- MODAL FOR  NOTES -->
    <div id="openModal" class="modalDialog">
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
                <?= $this->Form->button(__('Submit'), array('name' => 'modal_submit')) ?>
                <?= $this->Form->end() ?>
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

    var myFile2 = document.getElementById('image2');
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

    $(function () {
        $('#newCustodian1').hide();
        $('#newCustodian2').hide();
        $('#newCustodian3').hide();

        $('#newCustodians').change(function () {
            
            if ($(this).val() == '1') { 
                $('#newCustodian1').show();
                $('#newCustodian2').hide();
                $('#newCustodian3').hide();
            }
            else if ($(this).val() == '2') {
                $('#newCustodian1').show();
                $('#newCustodian2').show();
                $('#newCustodian3').hide();
            }
            else if ($(this).val() == '3') {
                $('#newCustodian1').show();
                $('#newCustodian2').show();
                $('#newCustodian3').show();
            }
            else {

                $('#newCustodian1').hide();
                $('#newCustodian2').hide();
                $('#newCustodian3').hide();
            }

        });

    });

    //
    <!-- Child Contacts Start -->
    $(function () {
        $('#deleteBtn0').hide();
        $('#extraContacts').toggle(0);
        $('#extraContacts2').toggle(0);
        $('#extraContacts3').toggle(0);
        var contactNum = "<?php echo sizeof($child->childcontacts) ?>";

        $('#newContacts').change(function () {
            console.log(contactNum);
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

    /*Form Validator Start*/

    function activaTab(tabID) {
        $('.nav-tabs a[href="#' + tabID + '"]').tab('show');
    }
    
    
    
    $(document).ready( 
        function () {
            
            $("#submitBtn").click(function () {
                
                    var contactsNum = "<?php echo sizeof($child->childcontacts)  ?>";
                    console.log(contactsNum);
                
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

                    if (document.getElementById("newCustodians").value != 0) {
                        var more = document.getElementById("newCustodians").value;
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
                    /*
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
                    */
                                    
                    for (i = 0; i < contactsNum;) {
                            
                            
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
                                console.log('check '+cgivenName);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(cfamilyName)) {
                                console.log('check '+cfamilyName);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateLength(cmobilePhone)) {
                                console.log('check '+cmobilePhone);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateEmpty(chomePhone)) {
                                if (!validateLength(chomePhone)) {
                                    console.log('check '+chomePhone);
                                    return false;
                                }
                            }
                            if (!validateText(crelationshipToChild)) {
                                console.log('check '+crelationshipToChild);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(cstreetAddress)) {
                                console.log('check '+cstreetAddress);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(csuburb)) {
                                console.log('check '+csuburb);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateLengthPost(cpostCode)) {
                                console.log('check '+cpostCode);
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateSelect(cstate)) {
                                console.log('check '+cstate);
                                activaTab('tab3');
                                return false;
                            }
                        i++;
                        }
                
                    if($("#newContacts").length == 1){
                        console.log('can add new contacts');
                        
                        if (document.getElementById("newContacts").value != 0) {
                        var newContacts = document.getElementById("newContacts").value;
                        for (i = 1; i <= newContacts;) {
                            console.log('checking number '+i);
                            i++;
                            var cgivenName = "ext_cgivenName" + i;
                            var cfamilyName = "ext_cfamilyName" + i;
                            var chomePhone = "ext_chomePhone" + i;
                            var cmobilePhone = "ext_cmobilePhone" + i;
                            var crelationshipToChild = "ext_crelationshipToChild" + i;
                            var cstreetAddress = "ext_cstreetAddress" + i;
                            var csuburb = "ext_csuburb" + i;
                            var cpostCode = "ext_cpostCode" + i;
                            var cstate = "ext_cstate" + i;
                            if (!validateText(cgivenName)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(cfamilyName)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateLength(cmobilePhone)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateEmpty(chomePhone)) {
                                if (!validateLength(chomePhone)) {
                                    return false;
                                }
                            }
                            if (!validateText(crelationshipToChild)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(cstreetAddress)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateText(csuburb)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateLengthPost(cpostCode)) {
                                activaTab('tab3');
                                return false;
                            }
                            if (!validateSelect(cstate)) {
                                activaTab('tab3');
                                return false;
                            }
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