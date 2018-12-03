<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Referee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Volunteers'), ['controller' => 'Volunteers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Volunteer'), ['controller' => 'Volunteers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="referees index large-9 medium-8 columns content">
    <h3><?= __('Referees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('volunteer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($referees as $referee): ?>
            <tr>
                <td><?= $this->Number->format($referee->id) ?></td>
                <td><?= $referee->has('volunteer') ? $this->Html->link($referee->volunteer->id, ['controller' => 'Volunteers', 'action' => 'view', $referee->volunteer->id]) : '' ?></td>
                <td><?= h($referee->name) ?></td>
                <td><?= h($referee->phone) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $referee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $referee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $referee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referee->id)]) ?>
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
