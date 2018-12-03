<?php
$this->Breadcrumbs->add(
    'Programs',
    ['controller' => 'programs', 'action' => 'index']
);

$this->Breadcrumbs->add(
    'Edit Program'
);
?>
<html>
<head>
    <?= $this->Html->css('children') ?>
    <title>Edit Program</title>
    <?php echo $this->Html->css('jquery.datetimepicker.min.css'); ?>
</head>
<body>
<div class="large-12 columns content">
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material_prog">
        <div class="material_programs_events">
            <h3 style="color:white; font-weight:400;"><?= __('Edit Program') ?></h3>
        </div>
        <?= $this->Form->create($program, array('id' => 'contactform')) ?>
        <div class="col-md-5">
            <div class="row form-group">

                <?php echo $this->Form->input('name', array('id' => 'name','style' => 'width: 400px', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cooking')); ?>

            </div>
            <div class="row form-group">

                <?php echo $this->Form->input('date', array('id' => 'datetimepicker', 'type' => 'text','style' => 'width: 400px', 'class' => 'datetimepicker form-control', 'label' => 'Start Date & TIme', 'placeholder' => '2017-01-24 04:00')); ?>

            </div>

            <div class="row form-group">

                <?php $types = ['One-Off' => 'One-off', 'Ongoing' => 'Ongoing', 'Inactive' => 'Inactive']; ?>
                <?php echo $this->Form->input('type', array('id' => 'type', 'style' => 'width: 400px', 'label' => 'Class Frequency', 'type' => 'select', 'options' => $types, 'empty' => 'Please Select')); ?>

            </div>

            <div class="row form-group">
                <?php echo $this->Form->input('description', array('id' => 'description','type'=> 'textarea','maxlength'=> '200', 'label' => 'Description', 'placeholder' => 'Enter Description', 'required' => false)); ?>


            </div>


        </div>


        <div class="col-md-5">

            <div class="row">
                <?php echo $this->Form->input('category_id', array('id' => 'category', 'style' => 'width: 400px', 'label' => 'Category', 'type' => 'select', 'options' => $categories, 'empty' => 'Select Category', 'required' => true)); ?>
            </div>

            <div class="row">
                <?php echo $this->Form->input('classsize', array('id' => 'classsize', 'style' => 'width: 400px', 'label' => 'Class Size ', 'type' => 'number','max' => '99', 'class' => 'classsize form-control', 'placeholder' => '30')); ?>

            </div>

            <div class="row">
                <?php echo $this->Form->input('members._ids', array('id' => 'members',  'class' => 'chosen-select', 'style' => 'width: 500px', 'label' => 'Add Members', 'options' => $members, 'empty' => 'Select Members')); ?>
            </div>
        </div>


        <div class="col-md-10">
            <div style="margin-top:20px; margin-bottom:-30px;">
                <a class="previousbtn" onclick="goBack()" class="previous_button" style="margin-top:10px ">Back</a>
                <?= $this->Form->button(__('Submit'), ['disabled' => false, 'id' => 'submitBtn', 'class' => 'submitBtn', 'style'=> 'float: right']) ?>
            </div>
        </div>
    </div>

    <?= $this->Form->end() ?>
    </div>
</div>
</body>

<?php echo $this->Html->script('jquery.datetimepicker.full'); ?>
<?php echo $this->Html->script('validation'); ?>
<script type="text/javascript">
    $(document).ready(
        function () {

            $("#submitBtn").click(function () {
                    if (!validateText("name")) {
                        return false;
                    }
                    if (!validateSelect("type")) {
                        return false;
                    }
                    if (!validateSelect("category")) {
                        return false;
                    }
                }
            );
        }
    );

    $.datetimepicker.setLocale('en');
    //format the date so it won't change around.
    var date = "<?php

        $date = ($program->date);


         if(empty($date)){
             $formatted = $date->format('d/m/Y H:i');
        echo $formatted;
        }
        else {
            echo $date;
        }
        ?>"



    $('#datetimepicker').datetimepicker({
        readonly: true,
        dayOfWeekStart: 1,
        lang: 'en',
        minView: 2,
        format: 'd-m-Y H:i',
        startDate: new Date,
        autoclose: true,
    });

//    $('.classsize').formatter({
//        //change these if you want to change the format.
//        'pattern': '{{99}}'
//    });


    $('#classsize').change(function(){
        $(".chosen-select").chosen('destroy').chosen({max_selected_options: $('#classsize').val()});
    });
    $(".chosen-select").chosen({max_selected_options: $('#classsize').val()});



</script>

















