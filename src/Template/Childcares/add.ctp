<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('children') ?>
    <title>Add New Class</title>
</head>
<?php
$this->Breadcrumbs->add(
    'Childcare Classes',
    ['controller' => 'childcares', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add Childcare Class'
);
?>
<body>
<div class="large-12 columns content">
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_childcares">
            <h3 style="color:white; font-weight:400;"><?= __('Add Class') ?></h3>
        </div>
        <?= $this->Form->create($childcare, array('id' => 'contactform')) ?>
        <fieldset>
            <?php $day = ['Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday']; ?>
            <?php echo $this->Form->input('day', array('id' => 'day', 'class' => 'form-control', 'style' => 'width: 100%', 'label' => 'Day', 'type' => 'select', 'options' => $day, 'empty' => 'Select Day')); ?>
            <?php $starttime = ['9:00 AM' => '9:00 AM', '9:30 AM' => '9:30 AM',
                '10:00 AM' => '10:00 AM', '10:30 AM' => '10:30 AM',
                '11:00 AM' => '11:00 AM', '11:30 AM' => '11:30 AM',
                '12:00 PM' => '12 PM', '12:30 PM' => '12:30 PM',
                '1:00 PM' => '1:00 PM', '1:30 PM' => '1:30 PM',
                '2:00 PM' => '2:00 PM', '2:30 PM' => '2:30 PM',
                '3:00 PM' => '3:00 PM', '3:30 PM' => '3:30 PM',
                '4:00 PM' => '4:00 PM', '4:30 PM' => '4:30 PM',
                '5:00 PM' => '5:00 PM', '5:30 PM' => '5:30 PM',
                '6:00 PM' => '6:00 PM', '6:30 PM' => '6:30 PM',
                '7:00 PM' => '7:00 PM', '7:30 PM' => '7:30 PM',
                '8:00 PM' => '8:00 PM', '8:30 PM' => '8:30 PM',
                '9:00 PM' => '9:00 PM', '9:30 PM' => '9:30 PM']; ?>
            <?php echo $this->Form->input('starttime', array('id' => 'starttime', 'class' => 'form-control', 'style' => 'width:100%', 'label' => 'Start Time', 'type' => 'select', 'options' => $starttime, 'empty' => 'Select Start Time', 'required' => true)); ?>
            <?php $endtime = ['9:00 AM' => '9:00 AM', '9:30 AM' => '9:30 AM',
                '10:00 AM' => '10:00 AM', '10:30 AM' => '10:30 AM',
                '11:00 AM' => '11:00 AM', '11:30 AM' => '11:30 AM',
                '12:00 PM' => '12 PM', '12:30 PM' => '12:30 PM',
                '1:00 PM' => '1:00 PM', '1:30 PM' => '1:30 PM',
                '2:00 PM' => '2:00 PM', '2:30 PM' => '2:30 PM',
                '3:00 PM' => '3:00 PM', '3:30 PM' => '3:30 PM',
                '4:00 PM' => '4:00 PM', '4:30 PM' => '4:30 PM',
                '5:00 PM' => '5:00 PM', '5:30 PM' => '5:30 PM',
                '6:00 PM' => '6:00 PM', '6:30 PM' => '6:30 PM',
                '7:00 PM' => '7:00 PM', '7:30 PM' => '7:30 PM',
                '8:00 PM' => '8:00 PM', '8:30 PM' => '8:30 PM',
                '9:00 PM' => '9:00 PM', '9:30 PM' => '9:30 PM']; ?>
            <?php echo $this->Form->input('endtime', array('id' => 'endtime', 'class' => 'form-control', 'style' => 'width:100%', 'label' => 'End Time', 'type' => 'select', 'options' => $endtime, 'empty' => 'Select End Time', 'required' => true)); ?>
            <?php $type = ['Occasional Care' => 'Occasional Care', 'Kinder' => 'Kinder']; ?>
            <?php echo $this->Form->input('type', array('id' => 'editable', 'class' => 'form-control', 'style' => 'width: 100%', 'label' => 'Type', 'type' => 'select', 'options' => $type, 'default' => 'Please select Class Type')); ?>
            <?php echo $this->Form->input('children._ids', ['options' => $children,'class'=>'chosen-select','empty'=>true]); ?>

            <datalist id="editable">
                    <option value="Occasional Care">Occasional Care</option>
                    <option value="Kinder">Kinder</option>
                </datalist>

            <div style="margin-top:10px; margin-bottom:-20px;">
             <?php echo $this->Form->button('Reset',['type' => 'reset']); ?>
          <?= $this->Form->button(__('Submit'), array('id'=>'submitBtn','style' => 'width: 190px')) ?>
 <a class="previousbtn" onclick="goBack()" class="previous_button">Previous Page</a>
            </div>
        </fieldset>
    </div>
</div>
<?= $this->Form->end() ?>

<?php echo $this->Html->script('validation'); ?>
<script type="text/javascript">
    $(document).ready(
        function () {
            $("#submitBtn").click(function () {
                    //create 'dates' to compare the start/end time
                    var startTime = new Date(Date.parse("01/01/1970 "+document.getElementById("starttime").value));
                    var endTime = new Date(Date.parse("01/01/1970 "+document.getElementById("endtime").value));
                    if(startTime > endTime){
                        alert("Please check the class Start/End times. Start time cannot be after end time!");
                        return false;
                    }
                    if(startTime.getTime()===endTime.getTime()){
                        alert("Please check the class Start/End times. Start time cannot be the same as end time!");
                        return false;
                    }
                
                    if (!validateSelect("day")) {
                        return false;
                    }
                    if (!validateSelect("starttime")) {
                        return false;
                    }
                    if (!validateSelect("endtime")) {
                        return false;
                    }
                    if (!validateSelect("editable")) {
                        return false;
                    }
                }
            );
        }
    );
    /*Form Validator End*/ 
</script>
</body>
</html>