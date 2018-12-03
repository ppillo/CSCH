<head>
    <title>Programs</title>
 <?= $this->Html->css('actions')?>
</head>
<?php
$this->Breadcrumbs->add(
    'Programs',
    ['controller' => 'programs', 'action' => 'index']
);
?>
<div style="padding:10px;"></div>
<div class='material'>
<table class="table table-hover"  id="eventsTable" cellpadding="2" cellspacing="2" width="100%" id="data"border="0">
    <div class="material_programs_events">
        <h3 style="color:white; font-weight:400;">Programs</h3>
        <label class="material_hideprog" id="box1"> Hide inactive programs
            <input id="checkbox-inactive" type="checkbox">
        </label>
        <thead>
            <tr>
                <td scope="col">Name</td>
                <td scope="col">Date & Time</td>
                <td scope="col">Category</td>
                <td scope="col">Type</td>
                <td scope="col">id</td>
                <td scope="col" class="actions" style="text-align:left; width:80px;">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($programs as $program): ?>
            <tr>
                <td><?= h($program->name) ?></td>
                <td><?php $date = $program->date;
                    echo $date->format('d/M/Y H:i'); ?></td>
                <td><?= $program->has('category') ? $this->Html->link($program->category->name, ['controller' => 'Categories', 'action' => 'view', $program->category->id]) : '' ?></td>
                <td><?= h($program->type) ?></td>
                <td><?= h($program->id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $program->id],array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $program->id],array('title' => 'Edit', 'class' => 'edit_button')) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
</div>
    </table>
</div>





<script type="application/javascript">

//<!--DataTable start-->

if (window.innerWidth < 960) {
$(document).ready(function() {
    $('#eventsTable').DataTable( {
        order:[4, 'desc'],
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
    $('#eventsTable').DataTable({
        order:[4, 'desc'],
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


//for filtering inactive programs
//For filtering inactive members
$(document).ready(function () {
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData) {
        var checked = $('#checkbox-inactive').is(':checked');

        if (checked && aData[3] == 'Inactive') {
            return false;
        }
        return true;

    });
    var oTable = $('#eventsTable').dataTable();
    $('#checkbox-inactive').on("click", function (e) {
        oTable.fnDraw();
    });

});



<!-- DateTable End -->	
</script>	