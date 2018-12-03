<?php
$this->Breadcrumbs->add(
    'Programs',
    ['controller' => 'programs', 'action' => 'index']
);

$this->Breadcrumbs->add(
        'View Program'
);
?>
<head>
    <meta charset="UTF-8">
    <title>Program Details</title>
    <?= $this->Html->css('actions')?>
    <!-- DateTable Start -->
    <script type="application/javascript">
        if ((window.innerWidth < 960) || (screen.width < 960)) {
            $(document).ready(function () {
                $('#membersTable').DataTable({
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
                $('#membersTable').DataTable( {
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [ 0,1,2,3,4,5,6]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation:'landscape',
                            exportOptions: {
                                columns: [ 0,1,2,3,4,5,6]
                            }
                        }
                    ]
                } );
            });
        }

        //For filtering inactive members
        $(document).ready(function() {
            $.fn.dataTableExt.afnFiltering.push(function(oSettings, aData, iDataIndex) {
                var checked = $('#checkbox').is(':checked');

                if (checked && aData[6] == 'No') {
                    return false;
                }
                return true;

            });
            var oTable = $('#membersTable').dataTable();
            $('#checkbox').on("click", function(e) {
                //console.log('click');
                oTable.fnDraw();
            });

        });
        <!-- DateTable End -->
    </script>


</head><div style="padding:10px;">
    </div>
<script>
function goBack() {
    window.history.back();
}
</script>
<div class="material">
    <div class="material_programs_events">
        
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $program->id], array('class' => 'editbtn')) ?>
        
    <h3 style="color:white; font-weight:400;"><?= h($program->name) ?></h3>
    </div>
    <table class="vertical-table">
        <tr>
            <th scope="row" style="color:black"><?= __('Name') ?></th>
            <td><?= h($program->name) ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black"><?= __('Category') ?></th>
            <td><?= $program->has('category') ? $this->Html->link($program->category->name, ['controller' => 'Categories', 'action' => 'view', $program->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black"><?= __('Start Date & Time') ?></th>
            <td>
            <?php $date = $program->date;
            echo $date->format('d/M/Y h:i'); ?>
            </td>
        </tr>
        <tr>
            <th scope="row" style="color:black"><?= __('Class Size') ?></th>
            <td><?= h($program->classsize) ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black"><?= __('Type') ?></th>
            <td><?= h($program->type) ?></td>
        </tr>
        <tr>
            <th scope="row" style="color:black"><?= __('Description') ?></th>
            <td><?= h($program->description) ?></td>
        </tr>
    </table>
     <div>
       
        <h4><?= __('Related Members') ?></h4>
         <label> Only show newsletter subscribers
             <input id="checkbox" type="checkbox">
         </label>

        <table class="table table-hover" id="membersTable" cellpadding="2" cellspacing="2" width="100%" id="data"
       border="0">
            <thead>
            <tr>
                <td class="heading"><?= __('Given Name') ?></td>
                <td class="heading"><?= __('Family Name') ?></td>
                <td class="heading"><?= __('Date of Birth') ?></td>
                <td class="heading"><?= __('Email') ?></td>
                <td class="heading"><?= __('Mobile Phone') ?></td>
                <td class="heading"><?= __('Sub. Type') ?></td>
                <td class="heading"><?= __('Newsletter') ?></td>
                <td scope="col" class="actions"><?= __('Actions') ?></td>
            </tr>
            </thead>
            
            <tbody>
            <?php foreach ($program->members as $members): ?>
            <tr class="list">
                <td class="datatable"><?= h($members->givenName) ?></td>
                <td class="datatable"><?= h($members->familyName) ?></td>
                <td class="datatable"><?php $dob = $members->dateOfBirth;
                                        echo $dob->format('d/M/Y'); ?></td>
                <td class="datatable"><?= h($members->email) ?></td>
                <td class="datatable"><?= h($members->mobilePhone) ?></td>
                <td class="datatable">
                    <?php if (($members->tier) == 'F') {
                        echo 'Family';
                    } else if (($members->tier) == 'I') {
                        echo 'Individual';
                    } else if (($members->tier) == 'C') {
                        echo 'Concession';
                    } else if (($members->tier) == 'Y') {
                        echo 'Youth';
                    } else if (($members->tier) == 'G') {
                        echo 'Garden';
                    } else if (($members->tier) == 'V') {
                        echo 'Volunteer';
                    } else {
                        echo '';
                    }
                    ?>
                </td>
                <td class="datatable"><?php if($members->newsletter=="Y"){echo "Yes";}else{echo "No";}  ?></td>
               <td class="actions" style="text-align: left;">
                    <?= $this->Html->link(__('View'), ['controller' => 'Members', 'action' => 'view', $members->id], array('title' => 'View', 'class' => 'view_button')) ?>&nbsp;&nbsp;
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Members', 'action' => 'edit', $members->id],array('title' => 'Edit', 'class' => 'edit_button')) ?>&nbsp;&nbsp;
                </td>
          
            </tr>
            <?php endforeach; ?>
            </tbody>
            
        </table>

         
    </div>
    <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px; ">Previous Page</button>

</div>
