<!DOCTYPE html>
<html>
<?php
$this->Breadcrumbs->add(
    'Volunteers',
    ['controller' => 'volunteers', 'action' => 'index']
);
?>

<head>
    <meta charset="UTF-8">
    <title>Volunteers Index</title>
    <?= $this->Html->css('actions') ?>
    <!-- DateTable Start -->
    <script type="application/javascript">
        if ((window.innerWidth < 960) || (screen.width < 960)) {
            $(document).ready(function () {
                $('#vTable').DataTable({
                    order: [6, 'desc'],
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'portrait',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
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
                        {
                            "targets": [6],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });
        }
        else {
            $(document).ready(function () {
                $('#vTable').DataTable({
                    order: [6, 'desc'],
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'portrait',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        }

                    ],
                    columnDefs: [
                        {
                            "targets": [6],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });
        }
        <!-- DateTable End -->

        //For filtering inactive volunteers
        $(document).ready(function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData) {
                var checked = $('#checkbox-inactive').is(':checked');

                if (checked && aData[7] == 'No') {
                    return false;
                }
                return true;

            });
            var oTable = $('#vTable').dataTable();
            $('#checkbox-inactive').on("click", function (e) {
                //console.log('click');
                oTable.fnDraw();
            });

        });
    </script>
</head>
<?php
use Cake\ORM\TableRegistry;

?>

<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <table class="table table-hover" id="vTable" cellpadding="2" cellspacing="2" width="100%" id="data"
           border="0">
        <div class="material_volunteers">
            <h3 style="color:white; font-weight:400;"><?= __('Volunteers') ?></h3>
            <label class="material_hide_vol" id="box1"> Hide inactive volunteers
                <input id="checkbox-inactive" type="checkbox">
            </label>
        </div>
        <thead>
        <tr>
            <td class="heading">Name</td>
            <td class="heading">Contact No.</td>
            <td class="heading">Category</td>
            <td class="heading">Start Date</td>
            <td class="heading">Total hours</td>
            <td class="heading">Reference Check Complete?</td>
            <td class="heading" style="text-align:left; width:60px;">id</td>
            <td class="heading" style="text-align:left; width:60px;">Active</td>
            <td class="heading" style="text-align:left; width:80px;">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($volunteers as $volunteer): ?>
            <tr class="list">
                <td class="datatable"><?= $volunteer->has('member') ? $this->Html->link($volunteer->member->givenName . ' ' . $volunteer->member->familyName, ['controller' => 'Members', 'action' => 'view', $volunteer->member->id]) : '' ?></td>
                <td class="datatable"><?php echo $volunteer->member->mobilePhone ?></td>
                <td class="datatable"><?= $volunteer->has('category') ? $this->Html->link($volunteer->category->name, ['controller' => 'Categories', 'action' => 'view', $volunteer->category->id]) : '' ?></td>

                <td class="datatable">
                    <?php $startdate = $volunteer->volunteerStartDate;
                    echo date("d/M/Y", strtotime($startdate)); ?>
                </td>

                <td class="datatable"><?php
                    $hoursTable = TableRegistry::get('hours');
                    $query = $hoursTable->find()->where(['volunteer_id' => $volunteer->id]);
                    $hoursArray = $query->toArray();
                    $totalHours = 0;
                    foreach ($hoursArray as $hour) {
                        $totalHours += $hour->hours;
                    }
                    if ($totalHours != 0) {
                        echo $totalHours;
                    } else {
                        echo '0';
                    }

                    ?></td>

                <td class="datatable"><?php if ($volunteer->referenceCheckComplete == 1) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    } ?></td>
                <td class="datatable"><?php echo $volunteer->id ?></td>
                <td class="datatable" style="text-align:left;">
                    <?php if (($volunteer->active) == 1) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }
                    ?>
                </td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $volunteer->id], array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'members', 'action' => 'edit', $volunteer->member->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
