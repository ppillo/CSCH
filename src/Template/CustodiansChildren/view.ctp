<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Custodians Child'), ['action' => 'edit', $custodiansChild->custodian_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Custodians Child'), ['action' => 'delete', $custodiansChild->custodian_id], ['confirm' => __('Are you sure you want to delete # {0}?', $custodiansChild->custodian_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Custodians Children'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custodians Child'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Custodians'), ['controller' => 'Custodians', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custodian'), ['controller' => 'Custodians', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="custodiansChildren view large-9 medium-8 columns content">
    <h3><?= h($custodiansChild->custodian_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Custodian') ?></th>
            <td><?= $custodiansChild->has('custodian') ? $this->Html->link($custodiansChild->custodian->id, ['controller' => 'Custodians', 'action' => 'view', $custodiansChild->custodian->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Child') ?></th>
            <td><?= $custodiansChild->has('child') ? $this->Html->link($custodiansChild->child->id, ['controller' => 'Children', 'action' => 'view', $custodiansChild->child->id]) : '' ?></td>
        </tr>
    </table>
</div>
