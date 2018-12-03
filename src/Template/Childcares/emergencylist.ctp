<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($childcare->day) . ' ' . ($childcare->time) . ' (Type : ' . ($childcare->type) . ')' ?></title>
    <?= $this->Html->css('actions') ?>
</head>

<?php
     use Cake\ORM\TableRegistry;
    
    $members = TableRegistry::get('Members');
    $custodians = TableRegistry::get('Custodians');
    $childcontacts = TableRegistry::get('Childcontacts');
    $custodians_children = TableRegistry::get('Custodians_Children');
        

$this->Breadcrumbs->add(
    'Childcare Classes',
    ['controller' => 'childcares', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Childcare Class',['controller' => 'childcares', 'action' => 'view',$childcare->id]
);
        $this->Breadcrumbs->add(
    'View Childcare Class Emergency List'
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
                            columns: [0, 1, 2]
                        }
                    },

         

                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: { 
                            columns: [0, 1, 2]
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
    <div class='material_childcares'>
       
        <h3 style="color:white; font-weight:400; "><?php echo ($childcare->day) . ' ' . ($childcare->starttime). ' Contacts List' ?></h3>
        
         
        
       
        
        
    </div>
    <div>
       
        <h3><?php echo ' Class Type : ' . ($childcare->type)  ?></h3>
        <h6>Warning : This list only shows active children in this childcare class.</h6>
        <h4 style="font-weight:300;"><?= __('Children in this class') ?></h4>
      
        <?php if (!empty($childcare->children)): ?>
            <table class="table table-hover" id="classTable" cellpadding="2" cellspacing="2" width="100%" id="data"
                   border="0">
                <thead>
                <tr>
                    <td class="heading">Name</td> 
                    <td class="heading" style="width:450px">Emergency Contacts</td> 
                    <td class="heading">Custodians</td> 
                    
                    <td class="heading" style="display:none;">Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php  
                    foreach ($childcare->children as $children):
                   
                     if($children->active == true){
                    ?>
                    <tr class="list">

                        <td class="datatable"><?= h($children->givenName).' '.($children->familyName) ?></td>  
                        <td class="datatable"  style="width:450px">
                        <?php   $cc = $childcontacts->find('all')->where(['children_id'=>$children->id])->toArray();
                                if(sizeof($cc)!=0){
                                foreach($cc as $contact){
                                     if($contact['homeNumber'] == ""){
                                    echo $contact['givenName'].' '.$contact['familyName'].' (mobile : '.$contact['mobileNumber'].')';
                                    }
                                    else {
                                    echo $contact['givenName'].' '.$contact['familyName'].' (mobile :'.$contact['mobileNumber'].', home : '.$contact['homeNumber'].')';
                                    }
                                    echo '<br>';
                                }
                                    
                            }
                            else{
                                echo 'No Emergency Contacts';
                            } 
                            ?>
                        </td>
                        <td  class="datatable">
                        <?php   $custc = $custodians_children->find('all')->where(['child_id'=>$children->id])->toArray();
                                if(sizeof($custc)!=0){
                                foreach($custc as $custodian){
                                    
                                    $thisCustodian = $custodians->get($custodian['custodian_id']);
                                    $custId = $thisCustodian->member_id;
                                    $memberDetail = $members->find('all')->where(['id'=>$custId])->first();  
                                    
                                    if(sizeof($memberDetail)!=0){
                                    
                                        echo $memberDetail['givenName'].' '.$memberDetail['familyName'].' (mobile :'.$memberDetail['mobilePhone'].')<br>';
                                        } 
                                    }
                                }
                                else{
                                echo 'No Custodians';
                                } 
                            ?>
                        
                        
                        </td>
                        <td class="actions" style="display:none;">
                            <?= $this->Html->link(__('View'), ['controller' => 'Children', 'action' => 'view', $children->id], array('title' => 'View', 'class' => 'view_button')) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Children', 'action' => 'edit', $children->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                        </td>

                    </tr>
                <?php }
                                endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px; ">Previous Page</button>
    </div>

</div>
</body>