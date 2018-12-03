<?php
$this->Breadcrumbs->add(
    'Login'

);
?>
<?php echo $this->Html->script('validation'); ?>
<script>
    $(document).ready(
        function () {
            $("#login").click(function () {
                if (!validateUsername("user")) {
                    return false;
                }
            }
        }
    )
    );

</script>

<head>
<title>Login</title>
    <?= $this->Html->css('actions')?>
</head>
<body>
<div class="users form" style="padding-top: 30px;">
    <?= $this->Flash->render('Auth') ?>
    <?= $this->Form->create() ?>
	
	<div class="col-md-3 material_login_card" align="left" style="height: 297px;">
		<div class="row material_login_title">
			<h3 style="color:white; font-weight:400;"><?= __('Login') ?></h3>
		</div>
		<div class="row no-padding" id="user">
			<?= $this->Form->input('username') ?>
		</div>
		<div class="row no-padding">
			<?= $this->Form->input('password') ?>
		</div>
		<div class="row">
            
			<div class="col-md-12 no-padding">
				<div style="float:left;">
					<?= $this->Form->button('Login', array('id' => 'login','class' => 'loginbuttons')); ?>
				</div>
				<div style="padding:20px;">

				</div>
                <div class="forgot">
                <?= $this->Html->link('Forgot password','/contacts')?>
                </div>
			</div>
		</div>
        <?= $this->Form->end() ?>
	</div>
	
	<div class="col-md-9 no-padding">
		<?= $this->Html->image('childcare.png', ['alt'=>'childcare','img-responsive']) ?>
        
	</div>	
</div>

</body>





