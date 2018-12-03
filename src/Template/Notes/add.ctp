<html>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Child'
);
$this->Breadcrumbs->add(
    'Add Note'
);
?>
<title>New Note</title>
<head>
    <?= $this->Html->css('children')?>
    <title>Add Program</title>
</head>
<body>
<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_children">
            <h3 style="color:white; font-weight:400;"><?= __('Add New Note') ?></h3>
        </div>
        <?= $this->Form->create($note,array('type' => 'file')) ?>
    <fieldset>
        <?php
            echo $this->Form->input('date', array('style' => 'width:125px', 'id' => 'notesdatepicker', 'type' => 'text', 'readonly' => 'readonly',), ['required' => true]);
            echo $this->Form->input('description', ['required' => true]);?>
        <p style="font-size: small">Note: Upload your scanned document as an image.</p>
        <?php
            echo $this->Form->input('image', ['label' => '', 'type' => 'file', 'id' => 'image']); 
            //Get child_id from prev page
            $id=$_GET['id'];
        ?>
    </fieldset>
        <div class="col-md-6  no-margin no-padding">
            <div align="left">
                <div style="margin-top:12px;">
                    <a class="previousbtn" onclick="goBack()" id="previous_button">Previous Page</a>
                </div>
            </div>
        </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </div>
</div>

<script  type="text/javascript">
    <!-- Datepicker notes start -->
    $(function () {
        var currentDate = new Date();
        $("#notesdatepicker").datepicker({
            yearRange: "-1:+0",
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            defaultdate: currentDate
        });
    });


</script>

</body>
</html>