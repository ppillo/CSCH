<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Childcares Child'), ['action' => 'edit', $childcaresChild->child_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Childcares Child'), ['action' => 'delete', $childcaresChild->child_id], ['confirm' => __('Are you sure you want to delete # {0}?', $childcaresChild->child_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Childcares Children'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Childcares Child'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Childcares'), ['controller' => 'Childcares', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Childcare'), ['controller' => 'Childcares', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="childcaresChildren view large-9 medium-8 columns content">
    <h3><?= h($childcaresChild->child_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Child') ?></th>
            <td><?= $childcaresChild->has('child') ? $this->Html->link($childcaresChild->child->id, ['controller' => 'Children', 'action' => 'view', $childcaresChild->child->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Childcare') ?></th>
            <td><?= $childcaresChild->has('childcare') ? $this->Html->link($childcaresChild->childcare->id, ['controller' => 'Childcares', 'action' => 'view', $childcaresChild->childcare->id]) : '' ?></td>
        </tr>
    </table>
</div>
