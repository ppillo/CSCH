<?php
$this->Breadcrumbs->add(
    'Users',
    ['controller' => 'users', 'action' => 'index']
);
?>
<head>
    <meta charset="UTF-8">
    <title>Users Index</title>
    <?= $this->Html->css('actions') ?>
    <!-- DateTable start -->
    <script type="application/javascript">

        if (window.innerWidth < 960) {
            $(document).ready(function () {
                $('#uTable').DataTable({
                    responsive: true,
                    columnDefs: [
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 3, targets: 1},
                        {responsivePriority: 3, targets: 2},
                        {responsivePriority: 2, targets: 3},
                        {responsivePriority: 1, targets: 4}
                    ]
                });
            });
        }
        else {
            $(document).ready(function () {
                $('#uTable').DataTable();
            });
        }
        <!-- DateTable End -->
    </script>
</head>
<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <div class="material_users">
        <h3 style="color:white; font-weight:400;"><?= __('Users') ?></h3>
    </div>
    <table class="table table-hover data" id="uTable" cellpadding="2" cellspacing="2" width="100%"
           border="0">
        <thead>
        <tr>
            <td class="heading">User Name</td>
            <td class="heading">Created</td>
            <td class="heading">Modified</td>
            <td class="heading">Role</td>
            <td class="heading" style="text-align:left; width:110px;">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?php
                    $date = date_format($user->created, 'd/M/Y');
                    echo $date;
                    ?></td>
                <td><?php
                    $moddate = date_format($user->modified, 'd/M/Y');
                    echo $moddate;
                    ?></td>
                <td><?= h($user->role) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                    <?php 
                    if ($user->username != 'superuser' && $user->username != $this->request->session()->read('Auth.User.username')) {
                        echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], array('title' => 'Delete', 'class' => 'delete_button', 'confirm' => __('Are you sure you want to delete ' . $user->username . '? THIS CAN NOT BE REVERTED.')));
                    } 
                    else {
                        echo '';

                    } 
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
