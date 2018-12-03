<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Hour'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Volunteers'), ['controller' => 'Volunteers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Volunteer'), ['controller' => 'Volunteers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="hours index large-9 medium-8 columns content">
    <h3><?= __('Hours') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volunteer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hours') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hours as $hour): ?>
            <tr>
                <td><?= $this->Number->format($hour->id) ?></td>
                <td><?= $hour->has('volunteer') ? $this->Html->link($hour->volunteer->id, ['controller' => 'Volunteers', 'action' => 'view', $hour->volunteer->id]) : '' ?></td>
                <td><?= h($hour->date) ?></td>
                <td><?= $this->Number->format($hour->hours) ?></td>
                <td><?= $this->Number->format($hour->category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $hour->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $hour->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $hour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hour->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
