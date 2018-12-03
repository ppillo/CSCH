<!DOCTYPE html>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Custodians',
    ['controller' => 'custodians', 'action' => 'index']
);

?>
<head>
    <meta charset="UTF-8">
    <title>Custodians Index</title>
    <?= $this->Html->css('actions')?>
    <!-- DateTable Start -->
    <script type="application/javascript">
        if ((window.innerWidth < 960) || (screen.width < 960)) {
            $(document).ready(function () {
                $('#cTable').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0,1]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation:'landscape',
                            exportOptions: {
                                columns: [ 0,1]
                            }
                        }

                    ],
                    responsive: true,
                    columnDefs: [
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 2, targets: 1},
                        {responsivePriority: 5, targets: 4},
                        {responsivePriority: 4, targets: 5},
                        {responsivePriority: 3, targets: 6},
                        {responsivePriority: 1, targets: 7},
                    ]
                });
            });
        }
        else {
            $(document).ready(function () {
                $('#cTable').DataTable( {
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0,1]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation:'landscape',
                            exportOptions: {
                                columns: [ 0,1]
                            }
                        }
                    ]
                } );
            });

        }
        <!-- DateTable End -->
    </script>
</head>
 <div style="padding:10px;">
    </div>
<div class='material'>
<table class="table table-hover" id="cTable" cellpadding="2" cellspacing="2" width="100%" id="data">
    <div class="material_children">
<h3 style="color:white; font-weight:400;"><?= __('Custodians') ?></h3>
        </div>
        <thead>
            <tr>
                <td class="heading">Member Name</td>
                <td class="heading">Member Date of Birth</td>
                <td class="heading">On Help Roster</td>
                <td class="heading" style="width:80px;">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($custodians as $custodian): ?>
            <tr>

                <td class="datatable"><?= $custodian->has('member') ? $this->Html->link($custodian->member->givenName.' '. $custodian->member->familyName, ['controller' => 'Members', 'action' => 'view', $custodian->member->id]) : '' ?></td>
                <td class="datatable">
                    <?php
                    echo date_format($custodian->member->dateOfBirth, 'd/M/Y');

                    ?>
                </td>
                <td class="datatable"><?= h($custodian->helpRoster) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $custodian->id],array('title' => 'View', 'class' => 'view_button')) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

