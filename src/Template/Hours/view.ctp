<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hour'), ['action' => 'edit', $hour->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hour'), ['action' => 'delete', $hour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hour->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hours'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hour'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Volunteers'), ['controller' => 'Volunteers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Volunteer'), ['controller' => 'Volunteers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Programs'), ['controller' => 'Programs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Program'), ['controller' => 'Programs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hours view large-9 medium-8 columns content">
    <h3><?= h($hour->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Volunteer') ?></th>
            <td><?= $hour->has('volunteer') ? $this->Html->link($hour->volunteer->id, ['controller' => 'Volunteers', 'action' => 'view', $hour->volunteer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Program') ?></th>
            <td><?= $hour->has('program') ? $this->Html->link($hour->program->name, ['controller' => 'Programs', 'action' => 'view', $hour->program->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($hour->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hours') ?></th>
            <td><?= $this->Number->format($hour->hours) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($hour->date) ?></td>
        </tr>
    </table>
</div>
