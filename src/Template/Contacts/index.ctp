<title>Forgot Password</title>
<?= $this->Html->css('actions')?>
<body>
    <div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_users"> <?= $this->Html->link("123", array('controller' => 'users','action'=> 'login'), array( 'class' => 'back_button'))?>    
<h3 style="color:white; font-weight:400; display:inline;"><?= __('Password Reset') ?></h3>
        </div>
    <?= $this->Form->create() ?>
  
        <h3 style="color:black;">Please enter your name, and an Admin will be notified.</h3>
        
        <?= $this->Form->input('name', array('style' => 'width: 350px')) ?>
        <div style="margin-bottom:-10px;">
        <?= $this->Form->button(__('Submit'), array('style' => 'width: 350px')) ?>
        </div>
        <?= $this->Form->end() ?>


        </div>
    </div>

</body>

