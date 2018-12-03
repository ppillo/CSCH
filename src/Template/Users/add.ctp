<title>New User</title>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
   <!--<?php echo $this->Html->link("<<Back to list", array('controller' => 'users','action'=> 'index'))?>-->

</nav>
<?php
$this->Breadcrumbs->add(
    'Users',
    ['controller' => 'users', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add user'

);
?>

<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_users">
<h3 style="color:white; font-weight:400;"><?= __('Add User') ?></h3>
        </div>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
        echo $this->Form->input('username', array('style' => 'width: 300px'));
        echo $this->Form->input('password', array('style' => 'width: 300px'));
        echo $this->Form->input('cPassword', array('type' => 'password', 'label' => 'Confirm Password','style' => 'width: 300px'));
        echo $this->Form->input('role', [
            'options' => [null => 'Role' ,'admin' => 'Admin', 'staff' => 'Staff']
        ]);
        ?>
        
        
        <div style="margin-bottom:-20px;">
            <a class="previousbtn" style="float: left; padding: -10px;" onclick="goBack()">Back</a>

           <div style="float: right"><?= $this->Form->button(__('Submit')); ?></div>
            </div>
    </fieldset>
  
    <?= $this->Form->end() ?>
    </div>
</div>
