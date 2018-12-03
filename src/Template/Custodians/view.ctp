<?= $this->Html->css('actions')?>
<div style="padding:10px;"></div>
<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'Custodians',
    ['controller' => 'custodians', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Custodian'
);
?>
<script>
function goBack() {
    window.history.back();
}
<?php 
    use Cake\ORM\TableRegistry;
    $childcaresChildrenTable = TableRegistry::get('childcares_children');
    $childcaresTable = TableRegistry::get('childcares');
    ?>
</script>
<title>Custodian Details</title>
<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_children">
          <h3 style="color:white; font-weight:400;"><?php echo($custodian->member->givenName.' '. $custodian->member->familyName)?></h3>
    </div>

    <div class="related">
        <h3 style="color:black;"><?= __('Related Children') ?></h3>
        <?php if (!empty($custodian->children)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Given Name') ?></th>
                <th scope="col"><?= __('Family Name') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Date of Birth') ?></th>
                <th scope="col"><?= __('Childcare Classes')?></th>
                <th scope="col" class="actions" style="width:100px;"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($custodian->children as $children): ?>
            <?php  
                $childID = $children->id;
                $query = $childcaresChildrenTable->find('all')->where(['child_id' => $childID]);
                $result = $query->find('all');
                $resultArr = $result->toArray();       
            ?>
            <tr>
                <td><?= h($children->givenName) ?></td>
                <td><?= h($children->familyName) ?></td>
                <td><?php if (($children->gender) == 'M') {
                    echo 'Male';
                } else if (($children->gender) == 'F') {
                    echo 'Female';
                } else if (($children->gender) == 'N') {
                    echo 'Not Specified';
                }
                ?></td>
                <td><?php $dob = $children->dateOfBirth;
                echo $dob->format('d/M/Y');

                ?></td>
                <td>   
                    <?php
                        if(sizeof($resultArr)!=0){
                            foreach($resultArr as $classes){
                                $childCareName = $childcaresTable->get($classes['childcare_id']);
                                echo ($childCareName['type'].', '.$childCareName['day']).'.</br>';
                            }
                        }else{
                            echo "Not enrolled in any class, or not active.";
                        }
                        
                    ?>
                
                
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Children', 'action' => 'view', $children->id], array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Children', 'action' => 'edit', $children->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
     <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px; ">Previous Page</button>
</div>