<html>
<head>
    <meta charset="UTF-8">
    <title>Emergency Call list</title>
    <?php
    $this->Breadcrumbs->add(
        'Emergency Call list'
    );
    ?>
    <?= $this->Html->css('actions') ?>
    <script type="application/javascript">

        //
        <!--DataTable start-->
     $(document).ready(function () {
                $('#childTable').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'pdf'

                        }

                    ],
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
        <h3 style="color:white; font-weight:400;"><?= __('Emergency Call list') ?></h3>
    </div>
    <?php
     use Cake\ORM\TableRegistry;
    use Cake\Datasource\ConnectionManager;
    
    
        $conn = ConnectionManager::get('default');
        
        $members = TableRegistry::get('Members');
        $children = TableRegistry::get('Children');
        $custodians = TableRegistry::get('Custodians');
        $childcontacts = TableRegistry::get('Childcontacts');
        $custodianschildren = TableRegistry::get('custodians_children');
    
        $result = $conn->execute('select distinct c.givenName,
 c.familyName, 
 m.givenName as Cust_firstname, 
 m.familyName as Cust_familyName, 
 m.mobilePhone, 
 e.givenName as "emergency contact givenname", 
 e.familyName as "emergency contact familyname", 
 e.mobileNumber as "emergency contact no." 
 from children c, members m, custodians cu, custodians_children cc, childcontacts e 
 where cc.custodian_id = cu.id and cc.child_id = c.id and cu.member_id = m.id and e.children_id = c.id ;')->fetchAll('assoc');
    
       //debug($result);
        // Start a new query.
        //$query = $children->query; 
         /*
        $query = $children->find('all')
        ->order(['id' => 'ASC'])
        ->contain([
            'Custodians'=> function($q){
                return $q->select(['id']);
            }
        ]);
        $result = ($query->toArray());
        debug($result);
    
    
          
                            //SQL query
                                 select c.givenName, c.familyName, m.givenName as Cust_firstname, m.familyName as Cust_familyName, m.mobilePhone, e.givenName as "emergency contact no.", e.mobileNumber as "emergency contact no." from children c, members m, custodians cu, custodians_children cc, childcontacts e where cc.custodian_id = cu.id and cc.child_id = c.id and cu.member_id = m.id and e.children_id = c.id;
                    
                    */
    
    
    ?>
    <p style="font-size: small">Note: This list only shows Children with both Custodian and Emergency contact info filled in! </p>
    <table class="table table-hover" id="childTable" cellpadding="2" cellspacing="2" width="100%" id="data" border="0">
        <thead>
        <tr>
            <td class="heading">Child Name</td>
            <td class="heading">Custodian Name</td>
            <td class="heading">Custodian Phone</td>
            <td class="heading">Emergency Contact Name</td>
            <td class="heading">Emergency Contact No.</td>
        </tr>
        </thead>

        <tbody>
        <?php
       
    
        //SQL query
//  select c.givenName, c.familyName, m.givenName as Cust_firstname, m.familyName as Cust_familyName, m.mobilePhone, e.givenName as "emergency contact no.", e.mobileNumber as "emergency contact no."
//  from children c, members m, custodians cu, custodians_children cc, childcontacts e
//  where cc.custodian_id = cu.id
//        and cc.child_id = c.id
//        and cu.member_id = m.id
//        and e.children_id = c.id;
        //debug($result);
        //debug($result[0]->custodians[0]->id);
        foreach($result as $row){ 
        ?>
        <tr class="list">
            <td class="datatables"><?php echo $row['givenName'].' '.$row['familyName']; ?></td> 
            <td class="datatables"><?php echo $row['Cust_firstname'].' '.$row['Cust_familyName']; ?></td>
            <td class="datatables"><?php echo $row['mobilePhone']; ?></td>
            <td class="datatables"><?php echo $row['emergency contact givenname'].' '.$row['emergency contact familyname']; ?></td>
            <td class="datatables"><?php echo $row['emergency contact no.']; ?></td> 
        </tr>
        <?php
            }
        ?>

         
        </tbody>
    </table>
</div>
</body>
</html>