<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Emergency Contact'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emergencyContacts index large-9 medium-8 columns content">
    <h3><?= __('Emergency Contacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('givenName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('familyName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobilePhone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('homePhone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relationshipMember') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emergencyContacts as $emergencyContact): ?>
            <tr>
                <td><?= $this->Number->format($emergencyContact->id) ?></td>
                <td><?= h($emergencyContact->givenName) ?></td>
                <td><?= h($emergencyContact->familyName) ?></td>
                <td><?= h($emergencyContact->mobilePhone) ?></td>
                <td><?= h($emergencyContact->homePhone) ?></td>
                <td><?= h($emergencyContact->relationshipMember) ?></td>
                <td><?= $emergencyContact->has('member') ? $this->Html->link($emergencyContact->member->id, ['controller' => 'Members', 'action' => 'view', $emergencyContact->member->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $emergencyContact->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $emergencyContact->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $emergencyContact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emergencyContact->id)]) ?>
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
