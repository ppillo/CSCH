<head>
    <meta charset="UTF-8">
    <title>All Notes</title>
    <?= $this->Html->css('actions')?>
</head>
<script type="application/javascript">

    //<!--DataTable start-->
    if (window.innerWidth < 960) {
        $(document).ready(function() {
            $('#notesTable').DataTable( {
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 3, targets: 1 },
                    { responsivePriority: 3, targets: 2 },
                    { responsivePriority: 2, targets: 3 },
                    { responsivePriority: 1, targets: 4 },
                ]
            } );
        } );
    }
    else {
        $(document).ready(function(){
            $('#notesTable').DataTable( {
            } );
        });

    }


    //For filtering inactive children
    $(document).ready(function() {
        $.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
            var checked = $('#checkbox').is(':checked');

            if (checked && aData[3] == 'No') {
                return false;
            }
            return true;

        });
        var oTable = $('#childTable').dataTable();
        $('#checkbox').on("click", function(e) {
            //console.log('click');
            oTable.fnDraw();
        });

    });


    <!-- DataTable End -->
</script>

<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <div class='material_children'>
        
        <h3 style="color:white; font-weight:400;"><?= __('Children Notes') ?></h3>
         
    </div>
    <table class="table table-hover"  id="notesTable" cellpadding="2" cellspacing="2" width="100%" id="data"border="0">
        <thead>
        <tr>
            <td class="heading">Given Name</td>
            <td class="heading">Family Name</td>
            <td class="heading">Date</td>
            <td class="heading">Description</td>
            <td class="heading">Actions</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note): ?>
                <tr class="list">
                    <td class="datatable"><?= $note->has('child') ? $this->Html->link($note->child->givenName, ['controller' => 'Children', 'action' => 'view', $note->child->id]) : '' ?></td>
                    <td class="datatable"><?= $note->has('child') ? $this->Html->link($note->child->familyName, ['controller' => 'Children', 'action' => 'view', $note->child->id]) : '' ?></td>
                <td class="datatable"><?= h($note->date) ?></td>
                    <td class="datatable"><?= h($note->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $note->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $note->id]) ?>
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
</body>

</div>
