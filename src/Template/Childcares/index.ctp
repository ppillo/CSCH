<head>
    <title>Childcare Classes</title>
    <?= $this->Html->css('actions')?>

</head>
<?php
$this->Breadcrumbs->add(
    'Childcare Classes',
    ['controller' => 'childcares', 'action' => 'index']
);
?>

<script type="application/javascript">

    //<!--DataTable start-->

    if (window.innerWidth < 960) {
        $(document).ready(function() {
            $('#childTable').DataTable( {
                order:[4, 'asc'],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 3, targets: 1 },
                    { responsivePriority: 3, targets: 2 },
                    { responsivePriority: 2, targets: 3 },
                    { responsivePriority: 1, targets: 4 },
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
            } );
        } );
    }
    else {
        $(document).ready(function(){
            $('#childTable').DataTable({
                    order:[4, 'asc'],
                    columnDefs: [
                        {
                            "targets": [ 4 ],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                }

            );
        });
    }



    <!-- DateTable End -->
</script>
<div style="padding:10px;">
</div>
<div class='material'>
    <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data"
           border="0">
        <div class="material_childcares">
            <h3 style="color:white; font-weight:400;"><?= __('Childcare Classes') ?></h3>
        </div>
        <thead>
        <tr>
            <td scope="col">Day</td>
            <td scope="col">Time</td>
            <td scope="col">Type</td>
            <td scope="col" style="width:80px;">Actions</td>
            <td scope="col">day</td>

        </tr>
        </thead>
        <tbody>
            <?php foreach ($childcares as $childcare): ?>
            <tr>
                <td><?= h($childcare->day) ?></td>
                <td><?= h(($childcare->starttime).'-'.($childcare->endtime)) ?></td>
                <td><?= h($childcare->type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $childcare->id], array('title' => 'View', 'class' => 'view_button')) ?> 
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $childcare->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                </td>
                <td><?php
                    $daynum = 0;
                    if ($childcare->day == 'Mon'){
                        $daynum = 1;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Tue'){
                        $daynum = 2;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Wed'){
                        $daynum = 3;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Thu'){
                        $daynum = 4;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Fri'){
                        $daynum = 5;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Sat'){
                        $daynum = 6;
                        echo $daynum;
                    }
                    elseif ($childcare->day == 'Sun'){
                        $daynum = 7;
                        echo $daynum;
                    }

                    ?></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
