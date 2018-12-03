<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Note</title>
    <?= $this->Html->css('children')?>
</head>
<div style="padding:10px;"></div>
<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_children">
        <h3 style="color:white; font-weight:400;">Note details</h3>
    </div>
    <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
           border="0">

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Child') ?></th>
            <td><?= $note->has('child') ? $this->Html->link(($note->child->givenName. ' ' . $note->child->familyName), ['controller' => 'Children', 'action' => 'view', $note->child->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($note->date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($note->description)); ?>
    </div>
    </table>
</div>
