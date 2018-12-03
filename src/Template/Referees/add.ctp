<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Referees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Volunteers'), ['controller' => 'Volunteers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Volunteer'), ['controller' => 'Volunteers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="referees form large-9 medium-8 columns content">
    <?= $this->Form->create($referee) ?>
    <fieldset>
        <legend><?= __('Add Referee') ?></legend>
        <?php
            echo $this->Form->input('volunteer_id', ['options' => $volunteers]);
            echo $this->Form->input('name');
            echo $this->Form->input('phone');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
