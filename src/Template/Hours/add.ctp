<html>
<title>Add Hours</title>
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
            $id=$_GET['id'];
            $volunteerTable = TableRegistry::get('volunteers');
            $memberTable = TableRegistry::get('members');
            $volunteer = $volunteerTable->get($id);
            $member = $memberTable->get($volunteer->member_id);
        ?>
        
        <?php
            echo $this->Form->hidden('volunteer_id', array('value'=>$id));
            //echo $this->Form->input('hours');
        ?>
        <div class="col-md-12">
            <p>For Volunteer = <?php echo $member->givenName.' '.$member->familyName;  ?></p>
        
         <?php 
            
            echo $this->Form->input('program_id', ['options' => $programs]);
            echo $this->Form->input('date', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'hoursdatepicker', 'type' => 'text', 'readonly' => 'readonly',));?>
        </div>
        <div class="col-md-6">
          <label for="single_hours" >Hours</label>
        <select id="single_hours" name="single_hours" style="width:100px">
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
        </select>
            </div>
            <div class="col-md-6">
        <label for="minutes" >Minutes</label>
        <select id="minutes" name="minutes"  style="width:100px">
            <option value=0>00</option>
            <option value=0.25>15</option>
            <option value=0.5>30</option>
            <option value=0.75>45</option>
        </select>
            </div>
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