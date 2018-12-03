<html>
<title>Edit Hours</title>
<head>
    <?= $this->Html->css('children')?>
    <title>Add Hours</title>
    <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.min.css"/>
</head>
<body>
<div class="large-12 columns content" >
<div class="col-md-4 no-padding"></div>
<div class="col-md-4 no-padding" id="material">
<div class="material_volunteers">
            <h3 style="color:white; font-weight:400;"><?= __('Add New Hour') ?></h3>
</div>
    <?= $this->Form->create($hour) ?>
    <fieldset>
        <?php
            use Cake\ORM\TableRegistry;
            //Get volunteer id from prev page 
            //I need these as I want to show the volunteer's name.
            $volunteerTable = TableRegistry::get('volunteers');
            $memberTable = TableRegistry::get('members');
            $volunteer = $volunteerTable->get($hour->volunteer_id);
            $member = $memberTable->get($volunteer->member_id);
        ?>
        <p>For Volunteer = <?php echo $member->givenName.' '.$member->familyName;  ?></p>
        <?php
            echo $this->Form->hidden('volunteer_id', array('value'=>$hour->volunteer_id));
            echo $this->Form->input('program_id', ['options' => $programs]);
            echo $this->Form->input('date', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'hoursdatepicker', 'type' => 'text', 'readonly' => 'readonly',));
            echo $this->Form->input('hours');
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
        $("#hoursdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            defaultdate: currentDate
        });
    });


</script>

</body>
</html>