<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Caulfield South Community House</title>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('actions.css') ?>


</head>
<?php

use Cake\ORM\TableRegistry;

//this page has no model, so we'll have to get the info ourself.

$membersTable = TableRegistry::get('members'); //get the members table
$childrenTable = TableRegistry::get('children'); //get the children table

//get the members
$membersQuery = $membersTable->find('all');
$membersResult = $membersQuery->find('all');
$members = $membersResult->toArray();


$childrenQuery = $childrenTable->find('all');
$childrenResult = $childrenQuery->find('all');
$children = $childrenResult->toArray();


$memberSize = sizeof($members);
$childrenSize = sizeof($children);
?>

<body>
<div style="padding:10px;">
</div>
<div class="row">
    <div class="col-md-6 no-padding no-margin">
        <div class='material_home' style="height:372px;">
            <div class='material_links'>
                <h3 style="color:white; font-weight:400;"><?= __('Quicklinks') ?></h3>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6 no-padding no-margin">

                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>members/add" class="custom_button">
                        <div type="custom_button"><span>New Member</span></div>
                    </a>
                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>children/add" class="custom_button">
                        <div type="custom_button"><span>New Child</span></div>
                    </a>
                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>childcares/add" class="custom_button">
                        <div type="custom_button"><span>New Childcare</span></div>
                    </a>
                    <br/>
                </div>
                <div class="col-xs-6  col-md-6 no-padding no-margin">
                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>programs/add" class="custom_button">
                        <div type="custom_button"><span>New Program</span></div>
                    </a>
                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>members/index" class="custom_button">
                        <div type="custom_button"><span>View Members</span></div>
                    </a>
                    <br/>
                    <a href="<?php echo $this->request->webroot; ?>children/index" class="custom_button">
                        <div type="custom_button"><span>View Children</span></div>
                    </a>
                    <br/>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 no-padding no-margin">

        <div class='material_home'>
            <div class='material_weather'>
                <h3 style="color:white; font-weight:400;"><?= __('Weather Forecast') ?></h3>
            </div>
            <iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%"
                    src="http://forecast.io/embed/#lat=-37.891917&lon=145.026033&units=ca"></iframe>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 no-padding no-margin">
        <div class='material_home'>
            <div class='material_children'>
                <h3 style="color:white; font-weight:400;"><?= __('Recently Added Children') ?></h3>
            </div>

            <?php
            if ($childrenSize <= 10 && $childrenSize != 0) { ?>
                <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                       border="0">
                    <thead>
                    <tr>
                        <td class="heading nowrap">Name</td>
                        <td class="heading nowrap">Age</td>
                        <td class="heading" style="width:90px;">Active?</td>
                        <td class="heading" style="text-align:left; width:50px;">View</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = ($childrenSize - 1); $i >= 0; $i--) {
                        ?>
                        <tr class="list">
                            <td class="datatable nowrap"><?php echo $children[$i]['givenName'] . ' ' . $children[$i]['familyName']; ?></td>
                            <td class="datatable nowrap">
                                <?php
                                //changes the DOB to x year old.
                                $dob = new DateTime($children[$i]['dateOfBirth']);
                                $today = new DateTime();
                                $interval = $today->diff($dob);
                                $year = $interval->format('%y');
                                $month = $interval->format('%m');
                                if ($year == 1 && $month > 1) {
                                    echo $year . ' year ' . $month . ' months';
                                } else if ($month < 2) {
                                    echo $year . ' years ' . $month . ' month';
                                } else {
                                    echo $year . ' years ' . $month . ' months';
                                }
                                ?>
                            </td>
                            <td class="datatable">
                                <?php
                                if (h($children[$i]['active']) == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'children', 'action' => 'view', ($children[$i]['id'])], array('class' => 'view_button')) ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>

                <?php
            }
            if ($childrenSize > 10) {
                ?>
                <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                       border="0">
                    <thead>
                    <tr>
                        <td class="heading nowrap">Name</td>
                        <td class="heading nowrap">Age</td>
                        <td class="heading" style="width:90px;">Active?</td>
                        <td class="heading" style="text-align:left; width:50px;">View</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = ($childrenSize - 1); $i >= ($childrenSize - 10); $i--) {
                        ?>
                        <tr class="list">
                            <td class="datatable nowrap"><?php echo $children[$i]['givenName'] . ' ' . $children[$i]['familyName']; ?></td>
                            <td class="datatable nowrap">
                                <?php
                                //changes the DOB to x year old.
                                $dob = new DateTime($children[$i]['dateOfBirth']);
                                $today = new DateTime();
                                $interval = $today->diff($dob);
                                $year = $interval->format('%y');
                                $month = $interval->format('%m');
                                if ($year == 1 && $month > 1) {
                                    echo $year . ' year ' . $month . ' months';
                                } else if ($month < 2) {
                                    echo $year . ' years ' . $month . ' month';
                                } else {
                                    echo $year . ' years ' . $month . ' months';
                                }
                                ?>
                            </td>
                            <td class="datatable">
                                <?php
                                if (h($children[$i]['active']) == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'children', 'action' => 'view', ($children[$i]['id'])], array('title' => 'View', 'class' => 'view_button')) ?>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            <?php }
            if ($childrenSize == 0) {
                echo '<center>No record found</center>';
            }
            ?>

        </div>
    </div>

    <div class="col-md-6 no-padding no-margin">
        <div class='material_home'>
            <div class="material_members">
                <h3 style="color:white; font-weight:400;"><?= __('Recently Added Members') ?></h3>
            </div>
            <?php
            if (sizeof($members) > 10) { ?>
                <table class="table table-hover" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                       border="0">
                    <thead>
                    <tr>
                        <td class="heading nowrap">Name</td>
                        <td class="heading">Email</td>
                        <td class="heading">Subscription</td>
                        <td class="heading" style="text-align:left; width:60px;">Active</td>
                        <td class="heading" style="text-align:left; width:50px;">View</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = (sizeof($members) - 1); $i >= (sizeof($members) - 10); $i--) {
                        ?>
                        <tr class="list">
                            <td class="datatable nowrap"><?php echo $members[$i]['givenName'] . ' ' . $members[$i]['familyName']; ?></td>
                            <!--Email Hover-over-->
                            <td class="datatable"
                                title="<?php echo $members[$i]['email']; ?>"><?php echo $members[$i]['email']; ?></td>
                            <td class="datatable">
                                <?php if (($members[$i]['tier']) == 'F') {
                                    echo 'Family';
                                } else if (($members[$i]['tier']) == 'I') {
                                    echo 'Individual';
                                } else if (($members[$i]['tier']) == 'C') {
                                    echo 'Concession';
                                } else if (($members[$i]['tier']) == 'Y') {
                                    echo 'Youth';
                                } else if (($members[$i]['tier']) == 'G') {
                                    echo 'Garden';
                                } else if (($members[$i]['tier']) == 'V') {
                                    echo 'Volunteer';
                                } else {
                                    echo '';
                                }
                                ?>
                            <td class="datatable" style="text-align:left;">
                                <?php if (($members[$i]['active']) == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                            <td class="actions" style="text-align: left;">
                                <?= $this->Html->link(__('View'), ['controller' => 'members', 'action' => 'view', ($members[$i]['id'])], array('title' => 'View', 'class' => 'view_button')) ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
                <?php
            }
            if (sizeof($members) <= 10 && sizeof($members) != 0) {
                ?>
                <table class="table table-hover" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                       border="0">
                    <thead>
                    <tr>
                        <td class="heading nowrap">Name</td>
                        <td class="heading">Email</td>
                        <td class="heading">Subscription</td>
                        <td class="heading" style="text-align:left; width:60px;">Active</td>
                        <td class="heading" style="text-align:left; width:50px;">View</td>
                    </tr>
                    </thead>
                    <tbody>


                    <?php
                    for ($i = (sizeof($members) - 1); $i >= 0; $i--) {
                        ?>

                        <tr class="list">
                            <td class="datatable nowrap"><?php echo $members[$i]['givenName'] . ' ' . $members[$i]['familyName']; ?></td>
                            <!--Email Hover-over-->
                            <td class="datatable"
                                title="<?php echo $members[$i]['email']; ?>"><?php echo $members[$i]['email']; ?></td>
                            <td class="datatable">
                                <?php if (($members[$i]['tier']) == 'F') {
                                    echo 'Family';
                                } else if (($members[$i]['tier']) == 'I') {
                                    echo 'Individual';
                                } else if (($members[$i]['tier']) == 'C') {
                                    echo 'Concession';
                                } else if (($members[$i]['tier']) == 'Y') {
                                    echo 'Youth';
                                } else if (($members[$i]['tier']) == 'G') {
                                    echo 'Garden';
                                } else if (($members[$i]['tier']) == 'V') {
                                    echo 'Volunteer';
                                } else {
                                    echo '';
                                }
                                ?>
                            <td class="datatable" style="text-align:left;">
                                <?php if (($members[$i]['active']) == 1) {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?>
                            </td>
                            <td class="actions" style="text-align: left;">
                                <?= $this->Html->link(__('View'), ['controller' => 'members', 'action' => 'view', ($members[$i]['id'])], array('class' => 'view_button')) ?>
                            </td>
                        </tr>
                        <?php
                    } ?>

                    </tbody>
                </table>
                <?php
            }
            if (sizeof($members) == 0) {
                echo '<center>No record found</center>';
            }

            ?>
        </div>
    </div>
</div>
</body>
</html>
