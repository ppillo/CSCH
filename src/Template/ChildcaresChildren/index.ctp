<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Childcares Child'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Childcares'), ['controller' => 'Childcares', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Childcare'), ['controller' => 'Childcares', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="childcaresChildren index large-9 medium-8 columns content">
    <h3><?= __('Childcares Children') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('child_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('childcare_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($childcaresChildren as $childcaresChild): ?>
            <tr>
                <td><?= $childcaresChild->has('child') ? $this->Html->link($childcaresChild->child->id, ['controller' => 'Children', 'action' => 'view', $childcaresChild->child->id]) : '' ?></td>
                <td><?= $childcaresChild->has('childcare') ? $this->Html->link($childcaresChild->childcare->id, ['controller' => 'Childcares', 'action' => 'view', $childcaresChild->childcare->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $childcaresChild->child_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $childcaresChild->child_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $childcaresChild->child_id], ['confirm' => __('Are you sure you want to delete # {0}?', $childcaresChild->child_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
