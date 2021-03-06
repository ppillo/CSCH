<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('children') ?>
    <title>Add Category</title>
    <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.min.css"/>

</head>
<body>
<?php
$this->Breadcrumbs->add(
    'Categories',
    ['controller' => 'categories', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add category'
//['controller' => 'categories', 'action' => 'add']
);
?>
<div class="large-12 columns content">
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_programs_events">
            <h3 style="color:white; font-weight:400;"><?= __('Add Category') ?></h3>
        </div>
        <?= $this->Form->create($category) ?>
        <fieldset>
            <?php echo $this->Form->input('name', array('id' => 'name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Childcare')); ?>
            <?php echo $this->Form->input('description', array('id' => 'description', 'type' => 'text', 'class' => 'form-control', 'program for children upto the age of 5' => '')); ?>
             <div style="margin-bottom:-30px; margin-top:10px;">
                <?= $this->Form->button(__('Submit'), array('style' => 'width: 310px')) ?>
                <a class="previousbtn" onclick="goBack()">Previous Page</a>
            </div>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>
</body>


<?php echo $this->Html->script('validation'); ?>
<script type="text/javascript">
    $(document).ready(
        function () {
            $("#submitBtn").click(function () {
                    if (!validateText("name")) {
                        return false;
                    }
                    if (!validateText("description")) {
                        return false;
                    }
                }
            )
        }
    );
</script>
</html>

 