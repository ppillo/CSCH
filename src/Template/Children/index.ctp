<html>
<head>
    <meta charset="UTF-8">
    <title>Children Index</title>
    <?php
    $this->Breadcrumbs->add(
        'Children',
        ['controller' => 'children', 'action' => 'index']
    );
    ?>
    <?= $this->Html->css('actions') ?>
    <script type="application/javascript">

        //
        <!--DataTable start-->
        if (window.innerWidth < 960) {
            $(document).ready(function () {
                $('#childTable').DataTable({
                    order:[4, 'desc'],
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
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        }
                    ],
                    responsive: true,
                    columnDefs: [
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 3, targets: 1},
                        {responsivePriority: 3, targets: 2},
                        {responsivePriority: 2, targets: 3},
                        {responsivePriority: 1, targets: 4},
                        {
                            "targets": [ 4 ],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });
        }
        else {
            $(document).ready(function () {
                $('#childTable').DataTable({
                    dom: 'Blfrtip',
                    order:[4, 'desc'],
                    buttons: [
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3]
                            }
                        }

                    ],
                    columnDefs: [
                        {
                            "targets": [ 4 ],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });

        }


        //For filtering inactive children
        $(document).ready(function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var checked = $('#checkbox1').is(':checked');

                if (checked && aData[3] == 'No') {
                    return false;
                }
                return true;

            });
            var oTable = $('#childTable').dataTable();
            $('#checkbox1').on("click", function (e) {
                oTable.fnDraw();
            });

        });

        $(document).ready(function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var checked = $('#checkbox2').is(':checked');

                if (checked && aData[3] == 'Yes') {
                    return false;
                }
                return true;

            });
            var oTable = $('#childTable').dataTable();
            $('#checkbox2').on("click", function (e) {
                //console.log('click');
                oTable.fnDraw();
            });

        });


        <!-- DataTable End -->
    </script>
</head>
<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <div class='material_children'>
        <h3 style="color:white; font-weight:400;"><?= __('Children') ?></h3>
        <label class="material_hide_children1"> Hide inactive children
            <input id="checkbox1" type="checkbox">
        </label>
        <label class="material_hide_children2"> Hide active children
            <input id="checkbox2" type="checkbox">
        </label>
    </div>
    <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data" border="0">
        <thead>
        <tr>
            <td class="heading">Given Name</td>
            <td class="heading">Family Name</td>
            <td class="heading">Age</td>
            <td class="heading">Active?</td>
            <td class="heading">id</td>
            <td class="heading" style="text-align:left; width:80px;">Actions</td>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($children as $child):
            ?>
            <tr class="list">
                <td class="datatable"><?= h($child->givenName) ?></td>
                <td class="datatable"><?= h($child->familyName) ?></td>
                <td class="datatable">
                    <?php
                    //changes the DOB to x year old.
                    $dateOfBirth = new DateTime($child->dateOfBirth);
                    $today = new DateTime();
                    $interval = $today->diff($dateOfBirth);
                    $year = $interval->format('%y');
                    $month = $interval->format('%m');
                    if ($year == 1 && $month > 1) {
                        echo $year . ' year ' . $month . ' months';
                    } else if ($month < 2) {
                        echo $year . ' years ' . $month . ' month';
                    } else {
                        echo $year . ' years ' . $month . ' months';
                    }
                    ?>
                </td>
                <td class="datatable">
                    <?php
                    if (h($child->active) == 1) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }
                    ?>
                </td>
                <td class="datatable"><?= h($child->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $child->id], array('title' => 'View', 'class' => 'view_button')) ?>
                   
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $child->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
              
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div>

    </div>
</div>
</body>
</html>