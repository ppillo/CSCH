<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Childcontact'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Children'), ['controller' => 'Children', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Child'), ['controller' => 'Children', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="childcontacts index large-9 medium-8 columns content">
    <h3><?= __('Childcontacts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('givenName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('familyName') ?></th>
                <th scope="col"><?= $this->Paginator->sort('homeNumber') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobileNumber') ?></th>
                <th scope="col"><?= $this->Paginator->sort('relationshipToChild') ?></th>
                <th scope="col"><?= $this->Paginator->sort('children_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('streetAddress') ?></th>
                <th scope="col"><?= $this->Paginator->sort('suburb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postCode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($childcontacts as $childcontact): ?>
            <tr>
                <td><?= $this->Number->format($childcontact->id) ?></td>
                <td><?= h($childcontact->givenName) ?></td>
                <td><?= h($childcontact->familyName) ?></td>
                <td><?= h($childcontact->homeNumber) ?></td>
                <td><?= h($childcontact->mobileNumber) ?></td>
                <td><?= h($childcontact->relationshipToChild) ?></td>
                <td><?= $childcontact->has('child') ? $this->Html->link($childcontact->child->id, ['controller' => 'Children', 'action' => 'view', $childcontact->child->id]) : '' ?></td>
                <td><?= h($childcontact->streetAddress) ?></td>
                <td><?= h($childcontact->suburb) ?></td>
                <td><?= h($childcontact->postCode) ?></td>
                <td><?= h($childcontact->state) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $childcontact->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $childcontact->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $childcontact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childcontact->id)]) ?>
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
