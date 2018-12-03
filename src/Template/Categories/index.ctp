<head>
    <title>Categories</title>
 <?= $this->Html->css('actions')?>
</head>
<?php
$this->Breadcrumbs->add(
    'Categories',
    ['controller' => 'categories', 'action' => 'index']
);
?>
<div style="padding:10px;"></div>
<div class='material'>
<table class="table table-hover data"  id="eventsTable" cellpadding="2" cellspacing="2" width="100%" border="0">
    <div class="material_programs_events">
        <h3 style="color:white; font-weight:400;">Categories</h3>
        <thead>
            <tr>
                <!--<td scope="col" style="text-align:left; width:100px;">ID</td>-->
                <td scope="col">Name</td>
                <td scope="col">Description</td>
                <td scope="col" class="actions" style="text-align:left; width:80px;">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <!--<td><?= $this->Number->format($category->id); ?></td>-->
                <td><?= h($category->name); ?></td>
                <td><?= h($category->description); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), [ 'action' => 'view', $category->id],array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), [ 'action' => 'edit', $category->id],array('title' => 'Edit', 'class' => 'edit_button')) ?>
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
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
			{ responsivePriority: 3, targets: 1 },
			{ responsivePriority: 3, targets: 2 },
			{ responsivePriority: 2, targets: 3 },
			{ responsivePriority: 1, targets: 4 }
        ]
    } );
} );
}
else {
   $(document).ready(function(){
    $('#eventsTable').DataTable();
});
}



<!-- DateTable End -->	
</script>	