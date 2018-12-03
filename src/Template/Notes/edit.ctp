<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Note</title>
    <?= $this->Html->css('children')?>
</head>
<div style="padding:10px;"></div>
<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_children">
        <h3 style="color:white; font-weight:400;">Edit Note</h3>
    </div>
</nav>
    <body>
<div class="notes form large-9 medium-8 columns content">
    <?= $this->Form->create($note) ?>
    <fieldset>
        <?php
        echo $this->Form->input('date', array('style' => 'width:125px', 'id' => 'notesdatepicker', 'type' => 'text', 'readonly' => 'readonly',), ['required' => true]);
            echo $this->Form->input('description');
           // echo $this->Form->input('children_id', ['options' => $children]);
        //Get child_id from prev page
        echo $this->Form->text('children_id', array('readonly' => 'readonly'));
        ?>
    </fieldset>
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