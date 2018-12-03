<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($childcare->day) . ' ' . ($childcare->time) . ' (Type : ' . ($childcare->type) . ')' ?></title>
    <?= $this->Html->css('actions') ?>
</head>

<?php
$this->Breadcrumbs->add(
    'Childcare Classes',
    ['controller' => 'childcares', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Childcare Class'
);
?>
<script type="application/javascript">
    //
    <!--DataTable start-->
    $(document).ready(function () {
        $('#classTable').DataTable({
                dom: 'Blfrtip',
                buttons: [

                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                    {
                        extend: 'excel',
                        className: 'classlist',
//                        text: 'Sign in/out list',
                        filename: 'Class-list',
                        sheetname: 'sheet1',
                        exportOptions: {
                            columns: [0, 1, 3]
                        },

                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('c[r=D1] t', sheet).text('Time in');
                            $('c[r=E1] t', sheet).text('Sign in');
                            $('c[r=F1] t', sheet).text('Time out');
                            $('c[r=G1] t', sheet).text('Sign out');
                        }
                    },


                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ]
            }
        )
    });

    //For filtering inactive children

    $(document).ready(function () {
        $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
            var checked = $('#checkbox').is(':checked');

            if (checked && aData[4] == 'No') {
                return false;
            }
            return true;

        });

        var oTable = $('#classTable').dataTable();
        $('#checkbox').on("click", function (e) {
            //console.log('click');
            oTable.fnDraw();
        });


    });

    <!-- DataTable End -->
</script>
<body>
<div style="padding:10px;">
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<div class='material'>
    <div style="float:left;">
     <?= $this->Html->link(__('Edit'), ['action' => 'edit', $childcare->id], array('class' => 'editbtn')) ?>
    </div>
    <div class='material_childcares'>
       
        <h3 style="color:white; font-weight:400; padding-left:60px;"><?php echo ($childcare->day) . ' ' . ($childcare->starttime)  ?></h3>
        
        
        <label class="material_hide_class"> Hide inactive children
            <input id="checkbox" type="checkbox">
        </label>
        
       
        
        
    </div>
    <div>
       <div class="emergency" style="float:right;">
     <?= $this->Html->link(__('List'), ['action' => 'emergencylist', $childcare->id] ) ?>
    </div>
        <h3><?php echo ' Class Type : ' . ($childcare->type)  ?></h3>
        <h4 style="font-weight:300;"><?= __('Children in this class') ?></h4>
      
        <?php if (!empty($childcare->children)): ?>
            <table class="table table-hover" id="classTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <thead>
                <tr>
                    <td class="heading">Given Name</td>
                    <td class="heading">Family Name</td>
                    <td class="heading">Age</td>
                    <td class="heading">Gender</td>
                    <td class="heading">Active?</td>
                    <td class="heading" style="width:80px;">Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($childcare->children as $children): ?>
                    <tr class="list">

                        <td class="datatable"><?= h($children->givenName) ?></td>
                        <td class="datatable"><?= h($children->familyName) ?></td>
                        <td class="datatable"><?php
                            $dob = new DateTime($children->dateOfBirth);
                            $today = new DateTime();
                            $interval = $today->diff($dob);
                            $year = $interval->format('%y');
                            $month = $interval->format('%m');
                            if ($year == 1 && $month > 1) {
                                echo $year . ' year ' . $month . ' months';
                            } else if ($month < 2) {
                                echo $year . ' years ' . $month . ' month';
                            } else {
                                echo $year . ' years ' . $month . ' months';
                            }
                            ?></td>
                        <td class="datatable">
                            <?php if (($children->gender) == 'M') {
                                echo 'Male';
                            } else if (($children->gender) == 'F') {
                                echo 'Female';
                            } else if (($children->gender) == 'N') {
                                echo 'Not Specified';
                            }
                            ?>
                        </td>
                        <td class="datatable" style="text-align:left;">
                            <?php if (($children->active) == 1) {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                            ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Children', 'action' => 'view', $children->id], array('title' => 'View', 'class' => 'view_button')) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Children', 'action' => 'edit', $children->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px; ">Previous Page</button>
    </div>

</div>
</body>