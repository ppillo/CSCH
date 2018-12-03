<title>Edit User</title>

<?php
$this->Breadcrumbs->add(
    'Users',
    ['controller' => 'users', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Edit user'
);
?>

<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_users">
<h3 style="color:white; font-weight:400;"><?= __('Edit User') ?></h3>
        </div>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
        echo $this->Form->input('username', array('style' => 'width: 300px'));
        echo $this->Form->input('password', array('value' => "", 'style' => 'width: 300px'));
        echo $this->Form->input('cPassword', array('type' => 'password','label' => 'Confirm Password','style' => 'width: 300px'));
        echo $this->Form->input('role', [
            'options' => [null => 'Choose Role' ,'admin' => 'Admin', 'staff' => 'Staff']
        ]);
        ?>
          <div style="margin-bottom:-20px;">
        <a class="previousbtn" onclick="goBack()" style="float: left;">Back</a>
              <?= $this->Form->button(__('Submit'), array('style' => 'float :right')) ?>

          </div>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
</div>
