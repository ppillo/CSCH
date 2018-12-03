<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Referee'), ['action' => 'edit', $referee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Referee'), ['action' => 'delete', $referee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Referees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Referee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Volunteers'), ['controller' => 'Volunteers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Volunteer'), ['controller' => 'Volunteers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="referees view large-9 medium-8 columns content">
    <h3><?= h($referee->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Volunteer') ?></th>
            <td><?= $referee->has('volunteer') ? $this->Html->link($referee->volunteer->id, ['controller' => 'Volunteers', 'action' => 'view', $referee->volunteer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($referee->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($referee->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($referee->id) ?></td>
        </tr>
    </table>
</div>
