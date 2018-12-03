<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <title>Member Details</title>
    <?= $this->Html->css('style.css') ?>


    <?php
    $this->Breadcrumbs->add(
        'Members',
        ['controller' => 'members', 'action' => 'index']
    );
    $this->Breadcrumbs->add(
        'View member'

    );

    ?>
    <?= $this->Html->css('actions') ?>
    <script type="application/javascript">

    </script>
</head>
<body>
<div style="padding:10px;"></div>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
<!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


<div id="layout" class="col-md-12 material">

    <div class="material_members" style="height:100px;">

        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $member->id], array('class' => 'editbtn')) ?>

        <button onclick="window.print();" class="printbutton">
        </button>


        <div class="col-md-1">
            <div style="margin-top:-2px;"><?php
                if ($member->image != null) {
                    //echo $member->image."<br /><br />";
                    echo '<a href="#openModal">' . $this->Html->image('images/members/' . $member->image, ['width' => '50px', 'hheight' => '50px', 'class' => 'img-responsive',]) . '</a>';
                    // debug($member);
                } else {
                    echo $this->Html->image('noimage2xwhite.png' . $member->image, ['width' => '50px', 'hheight' => '50px', 'class' => 'img-responsive',]);;
                }
                ?>
            </div>
        </div>

        <div class="col-md-8">
            <h3 style="color:white; fontWeight:regular; margin-left:-25px "><?php echo ($member->givenName) . ' ' . ($member->familyName) ?></h3>

        </div>
    </div>
    <!-- MODAL FOR  NOTES -->
    <div id="openModal" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <?php echo $this->Html->image('images/members/' . $member->image, ['class' => 'img-responsive',]); ?>
        </div>
    </div>

    <div id="layout" class="col-md-12 material">
        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
               border="0">

            <div class="col-md-3" style="padding-top:-50px">
                <h3 style="color:black; fontWeight:regular;">Personal Details</h3>
            </div>

            <thead>
            <tr>
                <td class="heading">Given Name</td>
                <td class="heading">Family Name</td>
                <td class="heading" style="text-align: inherit; width:30%; ">Email</td>
                <td class="heading">Address</td>
                <td class="heading" style="text-align:left; width:100px;">Mobile</td>
                <td class="heading">Gender</td>
                <td class="heading">Date of Birth</td>
            </tr>
            </thead>
            <tbody>
            <tr class="list">
                <td class="datatable"><?= h($member->givenName) ?></td>
                <td class="datatable"><?php echo h($member->familyName); ?></td>
                <!--Email Hover-over-->
                <td class="datatable" title="<?php echo h($member->email); ?>"
                    style="word-wrap: break-word"><a href="mailto:<?php echo($member->email);?>"><?php echo $member->email; ?></a></td>
                <td class="datatable">
                    <?php
                    echo $member->streetAddress . "<br />";
                    echo $member->suburb . "<br />";
                    echo $member->state . "&nbsp" . ($member->postCode);
                    ?>
                </td>
                <td class="datatable"><?php echo h($member->mobilePhone); ?></td>
                <td class="datatable">
                    <?php if (($member->gender) == 'M') {
                        echo 'Male';
                    } else if (($member->gender) == 'F') {
                        echo 'Female';
                    } else if (($member->gender) == 'N') {
                        echo 'Not Specified';
                    }
                    ?></td>
                <td class="datatable" style="text-align:left word-wrap: break-word">
                    <?php $dob = $member->dateOfBirth;
                    echo $dob->format('d/M/Y'); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="layout" class="col-md-12 material">
        <?php
        //if thr
        use Cake\ORM\TableRegistry;

        $membersTable = TableRegistry::get('members'); //get the members table
        ?>
        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
               border="0">
            <h3 style="color:black; fontWeight:regular;">Membership Details</h3>
            <thead>
            <tr>
                <td class="heading">Signup Date</td>
                <td class="heading">Newsletter</td>
                <td class="heading">Can Vote</td>
                <td class="heading">Active</td>
                <td class="heading">Subscription Type</td>
                <?php
                if ($member->related_member != "" && $member->tier == 'F') {
                    $relatedMember = $membersTable->get($member->related_member);
                    echo '<td class="heading">Related Member</td>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <tr class="list">
                <td class="datatable"><?php $signupDate = $member->signupDate;
                    echo $signupDate->format('d/M/Y'); ?></td>
                <td class="datatable"><?= $member->newsletter ? __('Yes') : __('No'); ?></td>
                <!--Email Hover-over-->
                <td class="datatable"><?= $member->voting ? __('Yes') : __('No'); ?></td>
                <td class="datatable"><?= $member->active ? __('Yes') : __('No'); ?>
                </td>
                <td class="datatable">
                    <?php if (($member->tier) == 'F') {
                        echo 'Family';
                    } else if (($member->tier) == 'I') {
                        echo 'Individual';
                    } else if (($member->tier) == 'C') {
                        echo 'Concession';
                    } else if (($member->tier) == 'Y') {
                        echo 'Youth';
                    } else if (($member->tier) == 'G') {
                        echo 'Garden';
                    } else if (($member->tier) == 'V') {
                        echo 'Volunteer';
                    } else {
                        echo '';
                    }
                    ?>
                    <?php
                    if ($member->related_member != "" && $member->tier == 'F') {
                        $relatedMember = $membersTable->get($member->related_member);
                        echo '<td class="datatable"><a href="../view/' . $member->related_member . '">' . $relatedMember['givenName'] . ' ' . $relatedMember['familyName'] . '</a></td>';
                    }
                    ?>
            </tr>
            </tbody>
        </table>
        <?php
        $paysFor = $membersTable->find()->where(['related_member' => $member->id])->toArray();
        if (sizeof($paysFor) != 0) {
            ?>
            <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <h3 style="color:black; fontWeight:regular;">Family Members</h3>
                <thead>
                <tr>
                    <td class="heading">Given Name</td>
                    <td class="heading">Family Name</td>
                    <td class="heading">Email</td>
                    <td class="heading">Address</td>
                    <td class="heading" style="text-align:left; width:100px;">Mobile</td>
                    <td class="heading">Gender</td>
                    <td class="heading">Date of Birth</td>
                    <td class="heading" style="text-align:left; width:80px;">Action</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($paysFor as $pays): ?>
                    <tr class="list">
                        <td class="datatable"><?= h($pays['givenName']) ?></td>
                        <td class="datatable"><?php echo h($pays['familyName']); ?></td>
                        <!--Email Hover-over-->
                        <td class="datatable" style="word-wrap: break-word"
                            title="<?php echo h($pays['email']); ?>"><?php echo h($pays['email']); ?></td>
                        <td class="datatable">
                            <?php
                            echo $pays['streetAddress'] . "<br />";
                            echo $pays['suburb'] . "<br />";
                            echo $pays->state . "&nbsp" . ($pays->postCode);
                            ?>
                        </td>
                        <td class="datatable"><?php echo h($member->mobilePhone); ?></td>
                        <td class="datatable">
                            <?php if (($pays->gender) == 'M') {
                                echo 'Male';
                            } else if (($pays->gender) == 'F') {
                                echo 'Female';
                            } else if (($pays->gender) == 'N') {
                                echo 'Not Specified';
                            }
                            ?></td>
                        <td class="datatable" style="text-align:left;">
                            <?php $dob = $pays->dateOfBirth;
                            echo $dob->format('d/M/Y'); ?>
                        </td>
                        <td class="actions" style="text-align: left;">
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pays->id], array('class' => 'edit_button')) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php
        }
        ?>
    </div>
    <div id="layout" class="col-md-12 material" style="margin-right:24px;">
        <h3 style="color:black; fontWeight:normal;">Enrolled Programs</h3>
        <?php 
            $categoryTable = TableRegistry::get('Categories');
            
            if (!empty($member->programs)): ?>
            <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <tr>
                    <th scope="col"><?= __('Program Name') ?></th>
                    <th scope="col"><?= __('Date') ?></th>
                    <th scope="col"><?= __('Category') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($member->programs as $programs): ?>
                    <tr>
                        <td><?= h($programs->name) ?></td>
                        <td><?php
                            $date = $programs->date;
                            echo $date->format('d/M/Y');?></td>
                        <td><?php echo $categoryTable->get($programs->category_id)->name; ?></td>
                        <td><?= h($programs->type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Programs', 'action' => 'view', $programs->id], array('title' => 'View', 'class' => 'view_button')) ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>





    <div id="layout" class="col-md-7 material" style="margin-right:24px;">
        <h3 style="color:black; fontWeight:normal;">Emergency Contacts</h3>
        <?php if (!empty($member->emergency_contacts)): ?>
            <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <tr>
                    <th scope="col"><?= __('Given Name') ?></th>
                    <th scope="col"><?= __('Family Name') ?></th>
                    <th scope="col"><?= __('Mobile') ?></th>
                    <th scope="col"><?= __('Relationship') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($member->emergency_contacts as $emergencyContacts): ?>
                    <tr>
                        <td><?= h($emergencyContacts->givenName) ?></td>
                        <td><?= h($emergencyContacts->familyName) ?></td>
                        <td><?= h($emergencyContacts->mobilePhone) ?></td>
                        <td><?= h($emergencyContacts->relationshipToMember) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'EmergencyContacts', 'action' => 'view', $emergencyContacts->id], array('title' => 'View', 'class' => 'view_button')) ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <!--    </div>-->

    <!--    <div class="tab-pane" id="tab2">-->
    <div id="layout" class="col-md-4 material" style=" width:430px;">
        <h3 style="color:black; fontWeight:normal;">Interests</h3>
        <?php if (!empty($member->categories)): ?>
            <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <tr>
                    <th scope="col"><?= __('Category') ?></th>
                </tr>
                <?php foreach ($member->categories as $category): ?>
                    <tr>
                        <td><?= $this->Html->link($category->name, ['controller' => 'Categories', 'action' => 'view', $category->id]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>
    <!--    </div>-->
    <button onclick="goBack()" class="previous_button" style="margin-bottom:-4px;">Previous Page</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>

</body>
</html>
