<title>User Details</title>
<?php
$this->Breadcrumbs->add(
    'Users',
    ['controller' => 'users', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View user'
);
?>

<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_users">
<h3 style="color:white; font-weight:400;"><?= h($user->username) ?></h3>
        </div>
    <table class="vertical-table">
        <tr>
            <th scope="row" style="color:black;"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black;"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black;"><?= __('Date Created') ?></th>
            <td><?php $created = $user->created;
            echo $created->format('d/M/Y');
            ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black;"><?= __('Last Modified') ?></th>
            <td><?php $mod = $user->modified;
            echo $mod->format('d/M/Y');
            ?></td>
        </tr>
    </table>
    <a class="previousbtn" onclick="goBack()" class="previous_button">Previous Page</a>
</div>
</div>
