<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Childcares Children'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Childcares'), ['controller' => 'Childcares', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Childcare'), ['controller' => 'Childcares', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="childcaresChildren form large-9 medium-8 columns content">
    <?= $this->Form->create($childcaresChild) ?>
    <fieldset>
        <legend><?= __('Add Childcares Child') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
