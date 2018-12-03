<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('children') ?>
    <title>New Volunteer</title>
</head>
<?php
$this->Breadcrumbs->add(
    'Volunteers',
    ['controller' => 'volunteers', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add Volunteer'
)
?>
<body>
<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
    <div class="material_volunteers">
        <h3 style="color:white; font-weight:400;"><?= __('New Volunteer') ?></h3>
    </div>
    <?= $this->Form->create($volunteer) ?>
    <fieldset>
        <?php
            echo $this->Form->input('member_id', ['options' => $members,'class'=>'chosen-select']);
            echo $this->Form->input('category_id', ['options' => $categories,'class'=>'chosen-select']);
            echo $this->Form->input('medicare_number');
            echo $this->Form->input('private_health_fund');
            echo $this->Form->input('private_health_number');
    
            echo $this->Form->input('start_date', array('style' => 'width:125px', 'id' => 'startdatepicker', 'type' => 'text', 'readonly' => 'readonly',));  
            echo $this->Form->input('police_check_date', array('style' => 'width:125px', 'id' => 'policedatepicker', 'type' => 'text', 'readonly' => 'readonly',)); 
            echo $this->Form->input('children_check_date', array('style' => 'width:125px', 'id' => 'childdatepicker', 'type' => 'text', 'readonly' => 'readonly',)); 
            echo $this->Form->input('reference_check_complete');
        ?>
        <label for="refereeNum">Has referees?</label>
        <select name = "refereeNum" id="refereeNum">
            <option value="0" selected="selected">No</option>
            <option value="1" >Yes, 1 Referee</option>
            <option value="2" >Yes, 2 Referees</option> 
        </select> 
          <div style="margin-bottom:-50px;">
             <?php echo $this->Form->button('Reset',['type' => 'reset']); ?>
          <?= $this->Form->button(__('Submit'), array('style' => 'width: 190px')) ?>
            </div>
    </fieldset>
    
    <fieldset id="single_referee">
        
    <legend><?= __('Add Referee') ?></legend>
    <?php
            echo $this->Form->input('referees.name');
            echo $this->Form->input('referees.phone');
        ?>
    </fieldset>
    
    <fieldset id="two_referees">
       <legend><?= __('Add Referee') ?></legend> 
        <h4 style="color:black">Referee 1</h4>
        <?php
            echo $this->Form->input('referee1.name');
            echo $this->Form->input('referee1.phone');
        ?>
        <h4 style="color:black">Referee 2</h4>
        <?php
            echo $this->Form->input('referee2.name');
            echo $this->Form->input('referee2.phone');
        ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
    </div>
    </body>
</html>


<script type="text/javascript">
$(function() { // Shorthand for $(document0.ready(function() {
    //hide the referees form by default.
    $('#single_referee').toggle(0);
    $('#two_referees').toggle(0);
    
    //show them ONLY when the select 'Has Referees?' is chosen.
    $('#refereeNum').change(function() { // When an option is selected
            var hasOneReferee = $(this).val() == '1'; // Retrieve the chosen value and test it
            $('#single_referee').toggle(hasOneReferee); // Show/hide other fieldsets based on its value 
            var hasTwoReferees = $(this).val() == '2';
            $('#two_referees').toggle(hasTwoReferees);
    
    });
});
<!-- Datepicker dob Start -->
    $(function () {
        var currentDate = new Date();
        var currentMonth = (new Date).getMonth();
        var currentDay = (new Date).getDate();
        var currentYear = (new Date).getFullYear();
        $("#startdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
        $("#policedatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
        $("#childdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            maxDate: new Date(currentYear, currentMonth, currentDay)
        });
    });
    <!-- Datepicker dob end -->


</script>