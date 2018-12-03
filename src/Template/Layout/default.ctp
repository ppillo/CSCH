<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
      rel="stylesheet">

<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?= $this->Html->meta('icon') ?>

<?= $this->Html->css('bootstrap.min.css') ?>

<!-- Cake Bake Templates start-->
<?= $this->Html->css('base.css') ?>
<?= $this->Html->css('cake.css') ?>
<!-- Cake Bake Templates end-->

<!-- Data Tables CSS Start-->
<?= $this->Html->css('jquery.dataTables.min') ?>
<?= $this->Html->css('responsive.dataTables.min') ?>
<!-- Data Tables CSS End-->

<!-- Data Tables Css Start PDF -->
<?= $this->Html->css('buttons.dataTables.min.css') ?>
<!-- Data Tables Css End PDF -->


<!-- Datepicker start -->
<?= $this->Html->css('jquery-ui.css') ?>
<?= $this->Html->css('jquery-ui.structure.css') ?>
<?= $this->Html->css('jquery-ui.structure.min.css') ?>
<?= $this->Html->css('jquery-ui.theme.css') ?>
<?= $this->Html->css('jquery-ui.theme.min.css') ?>
<!-- Datepicker end -->

<!-- Chosen css start -->
<?= $this->Html->css('chosen.css') ?>
<!-- Chosen css end -->

<!-- Custom css start -->
<?= $this->Html->css('style.css') ?>
<!-- Custom css end -->


<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('jquery-1.12.4'); ?>
<?php echo $this->Html->script('jquery-ui'); ?>
<?php echo $this->Html->script('jquery-ui.min'); ?>
<?php echo $this->Html->script('chosen.jquery'); ?>
<?php echo $this->Html->script('jquery.dataTables.min'); ?>
<?php echo $this->Html->script('dataTables.responsive.min'); ?>
<?php echo $this->Html->script('jquery.formatter.min'); ?>
<?php echo $this->Html->script('validator'); ?>
<?php echo $this->Html->script('validator.min'); ?>

<!-- Data Tables Buttons Start-->
<?php echo $this->Html->script('dataTables.buttons.min'); ?>
<?php echo $this->Html->script('buttons.flash.min'); ?>
<?php echo $this->Html->script('buttons.html5.min'); ?>
<?php echo $this->Html->script('jszip.min'); ?>
<?php echo $this->Html->script('pdfmake.min'); ?>
<?php echo $this->Html->script('vfs_fonts'); ?>
<?php echo $this->Html->script('buttons.print.min'); ?>
<?php echo $this->Html->script('buttons.colVis.min'); ?>
<!-- Data Tables Buttons End -->


<?php echo $this->Html->script('bootstrap.min') ?>
<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>

<!-- Start of Banner -->

<div id="wide">
    <div class="help">
        <?= $this->Html->link(__('View'), ['controller' => 'Pages', 'action' => 'help'], array('class' => 'help_button')) ?>&nbsp;&nbsp;
    </div>
</div>

<!-- End of Banner -->

<!-- Start of Navigation Bar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <?php
            if (is_null($this->request->session()->read('Auth.User.username'))) {
                echo "";
            } else { ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-WDM-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <?php } ?>

            <?= $this->Html->image('cschlogo.png', ['alt' => 'logo', 'url' => ['controller' => 'Pages', 'action' => 'home'], 'height' => '50', 'width' => '150']) ?>
        </div>

        <?php
        if (is_null($this->request->session()->read('Auth.User.username'))) {
            echo "";
        } else { ?>
            <div class="collapse navbar-collapse navbar-right" id="bs-WDM-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Members <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link(__('View Members'), ['controller' => 'members', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('New Member'), ['controller' => 'members', 'action' => 'add']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('View Volunteers'), ['controller' => 'volunteers', 'action' => 'index']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('Batch Upload Members'), ['controller' => 'Pages', 'action' => 'batch_upload_member']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Children <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link(__('View Children'), ['controller' => 'children', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('New Child'), ['controller' => 'children', 'action' => 'add']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('View Custodians'), ['controller' => 'custodians', 'action' => 'index']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('View Childcare Classes'), ['controller' => 'childcares', 'action' => 'index']) ?>
                            <li><?= $this->Html->link(__('New Childcare Class'), ['controller' => 'childcares', 'action' => 'add']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('Emergency Call List'), ['controller' => 'children', 'action' => 'emergencylist']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('Batch Upload Children'), ['controller' => 'Pages', 'action' => 'batch_upload_children']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Programs <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link(__('View Programs'), ['controller' => 'programs', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('New Program'), ['controller' => 'programs', 'action' => 'add']) ?></li>
                            <li role="separator" class="divider"></li>
                            <li><?= $this->Html->link(__('View Categories'), ['controller' => 'categories', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('New Category'), ['controller' => 'categories', 'action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Users <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link(__('View Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('New User'), ['controller' => 'users', 'action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <li><?= $this->Html->link(__('Logout from ' . $this->request->session()->read('Auth.User.username')), ['controller' => 'users', 'action' => 'logout']) ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>
<!-- End of Navigation Bar -->
<div >
<?php
$this->Breadcrumbs->prepend(
    'Home',
    ['controller' => 'pages', 'action' => 'home']
);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs']
);
?>
</div>

<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>


<!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- Validator for de-activating all members. -->
<!-- Datepicker start -->
<script type="application/javascript">
    $(function () {
        var currentDate = new Date();
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            yearRange: "1930:2016",
            defaultDate: currentDate
        });
    });

    // ===== Scroll to Top ====
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function () {      // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0                       // Scroll to top of body
        }, 500);
    });
    
function goBack() {
    window.history.back();
}
    
</script>
<!-- Datepicker end -->

<script type="text/javascript">
    $(function () {
        $(".chosen-select").chosen();
    });
</script>

