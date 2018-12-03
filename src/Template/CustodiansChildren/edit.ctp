<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $custodiansChild->custodian_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $custodiansChild->custodian_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Custodians Children'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Custodians'), ['controller' => 'Custodians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Custodian'), ['controller' => 'Custodians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="custodiansChildren form large-9 medium-8 columns content">
    <?= $this->Form->create($custodiansChild) ?>
    <fieldset>
        <legend><?= __('Edit Custodians Child') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
