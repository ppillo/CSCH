<html>
<head>
    <meta charset="UTF-8">
    <title>Emergency Contacts List</title>
    <?php
    
    use Cake\ORM\TableRegistry;
    
    $members = TableRegistry::get('Members');
    
    
    $this->Breadcrumbs->add(
        'Children',
        ['controller' => 'children', 'action' => 'index']
    );
     $this->Breadcrumbs->add(
        'Emergency Call List'
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

 


        <!-- DataTable End -->
    </script>
</head>
<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <div class='material_children'>
        <h3 style="color:white; font-weight:400;"><?= __('Emergency Call List') ?></h3>
      
    </div>
    <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data" border="0">
        <thead>
        <tr>
            <td class="heading">Child Name</td> 
            <td class="heading">Emergency Contacts</td>
            <td class="heading">Custodians</td>
            <td class="heading">Classes</td>
            <td class="heading" style="display:none;">id</td>
            <td class="heading" style="display:none; text-align:left; width:80px;">Actions</td>
        </tr>
        </thead>
        
        <tbody>
        <?php 
            foreach ($children as $child):
             if(sizeof($child->custodians)!=0 && sizeof($child->childcontacts)!=0){
            ?>
            <tr class="list">
                <td class="datatable"><?= h($child->givenName).' '.($child->familyName) ?></td>
                <td class="datatable"><?php
                        if(sizeof($child->childcontacts)!=0){
                            foreach($child->childcontacts as $contact){
                                
                                if($contact['homeNumber'] == ""){
                                echo $contact['givenName'].' '.$contact['familyName'].' (mobile : '.$contact['mobileNumber'].')';
                                }
                                else {
                                echo $contact['givenName'].' '.$contact['familyName'].' (mobile :'.$contact['mobileNumber'].', home : '.$contact['homeNumber'].')';
                                }
                                
                                echo '<br>';    
                            }
                            }else{
                            echo 'no child contacts';
                        }
                    ?></td>
                   
                <td class="datatable">
                    <?php
                    if(sizeof($child->custodians)!=0){
                            foreach($child->custodians as $custodian){
                               $member = $members->get($custodian['member_id']);
                                echo $member['givenName'].' '.$member['familyName'].' ('.$member['mobilePhone'].')';   
                                echo '<br>';
                            }
                            }else{
                            echo 'no custodian';
                        }
                    ?>
                </td>
                <td class="datatable">
                    <?php
                    if(sizeof($child->childcares)!=0){
                        foreach($child->childcares as $enrolled){
                         
                            echo $enrolled['type'].'-'.$enrolled['day'].', '.$enrolled['starttime'].'-'.$enrolled['endtime'];
                            echo '<br>';
                        }
                    }
                    ?>
                </td>
                <td class="datatable" style="display:none;"><?= h($child->id) ?></td>
                <td class="actions" style="display:none;">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $child->id], array('title' => 'View', 'class' => 'view_button')) ?>
                   
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $child->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
              
                </td>
            </tr>
        <?php }
                        endforeach;
            ?>
        </tbody>
    </table>
    <div>

    </div>
</div>
</body>
</html>