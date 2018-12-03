<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Emergency Contacts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emergencyContacts form large-9 medium-8 columns content">
    <?= $this->Form->create($emergencyContact) ?>
    <fieldset>
        <legend><?= __('Add Emergency Contact') ?></legend>
        <?php
            echo $this->Form->input('givenName');
            echo $this->Form->input('familyName');
            echo $this->Form->input('mobilePhone');
            echo $this->Form->input('homePhone');
            echo $this->Form->input('relationshipMember');
            echo $this->Form->input('member_id', ['options' => $members]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
