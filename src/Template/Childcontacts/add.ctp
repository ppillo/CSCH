<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Childcontacts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="childcontacts form large-9 medium-8 columns content">
    <?= $this->Form->create($childcontact) ?>
    <fieldset>
        <legend><?= __('Add Childcontact') ?></legend>
        <?php
            echo $this->Form->input('givenname');
            echo $this->Form->input('familyname');
            echo $this->Form->input('phonenumber');
            echo $this->Form->input('mobilenumber');
            echo $this->Form->input('address');
            echo $this->Form->input('relationshiptochild');
            echo $this->Form->input('children_id', ['options' => $children]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
