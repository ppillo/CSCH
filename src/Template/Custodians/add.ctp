<head>
    <meta charset="UTF-8">
    <title>Add Custodian</title>
</head>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Custodians',
    ['controller' => 'custodians', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Add Custodian'
);

?>
<body>
<div style="padding:10px;">
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
    <div class="material_children">
        <?= $this->Form->create($custodian) ?>
<h3 style="color:white; font-weight:400;"><?= __('Add Custodian') ?></h3>
    </div>
        <fieldset>
            <?php
            echo $this->Form->input('member_id', ['options' => $members,'class'=>'chosen-select', 'empty'=>true]);

            echo $this->Form->input('children._ids', ['options' => $children,'class'=>'chosen-select','empty'=>true]);

            ?>

            <label>In help roster?</label>
            <?php echo $this->Form->select('helpRoster',['Yes'=>'Yes','No'=>'No']); ?>


            <div style="margin-bottom:-20px;">
                <?php echo $this->Form->button('Reset',['type' => 'reset']); ?>
                <?= $this->Form->button(__('Submit'), array('style' => 'width: 190px')) ?>
                <a class="previousbtn" onclick="goBack()" class="previous_button">Previous Page</a>
            </div>
        </fieldset>

    <?= $this->Form->end() ?>
    </div>
</div>
