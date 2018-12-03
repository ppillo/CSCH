 
<title>Child Contacts</title>

<?php
$this->Breadcrumbs->add(
    'Children',
    ['controller' => 'children', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View Child'
    //['controller' => 'children','action' => 'view']
);
$this->Breadcrumbs->add(
    'View Emergency Contact'
);
?>
<div style="padding:10px;"></div>
 <button onclick="goBack()" id="previous_button">Previous Page</button>
<script>
function goBack() {
    window.history.back();
}
</script>
<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_children">
        <h3 style="color:white; font-weight:400;"><?php echo ($childcontact->givenname).' '.($childcontact->familyName).' (ID : '.($childcontact->id).')'  ?></h3>
    </div>
    
   
    
    <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
       border="0">
     <h3 style="color:black; font-weight:400;">Personal Details</h3>
    <thead>
    <tr>
        <td class="heading">Given Name</td>
        <td class="heading">Family Name</td>
        <td class="heading">Phone Number</td>
        <td class="heading">Mobile Number</td>
        <td class="heading">Address</td>
        <td class="heading">Child</td>
        <td class="heading">Relationship to Child</td>
    </tr>
    </thead>
    <tbody>
        <tr class="list">
            <td class="datatable"><?= h($childcontact->givenName) ?></td>
            <td class="datatable"><?= h($childcontact->familyName) ?></td>
            <td class="datatable"><?php if($childcontact->phoneNumber==""){echo 'Not Given';}else{echo $childcontact->phonenumber;}?></td>
            <td class="datatable"><?= h($childcontact->mobileNumber) ?></td>
            <td class="datatable"><?= h($childcontact->streetAddress) ?></td>
            <td class="datatable"><a href="../../Children/view/<?php echo $childcontact->child['id'];?>"><?php echo $childcontact->child['givenName'].' '.$childcontact->child['familyName'].' (ID :'.$childcontact->child['id'].')'; ?></a></td>
            <td class="datatable"><?= h($childcontact->relationshiptochild) ?></td>
        </tr>
    </tbody>
</table>
    
</div>
