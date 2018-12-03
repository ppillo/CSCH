<html>
<?php
$this->Breadcrumbs->add(
    'Members',
    ['controller' => 'members', 'action' => 'index']
);
$this->Breadcrumbs->add(
    'View member'

);

$this->Breadcrumbs->add(
    'View emergency contact'

);
?>
<head>
    
<title>Emergency Contact</title>    
</head>
    
<body>
    <div style="padding:10px;">
    </div>
   
<script>
function goBack() {
    window.history.back();
}
</script>
<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_members">
    <h3 style="color:white; font-weight:400;"><?= h('Emergency Contact of: '.$emergencyContact->member->givenName.' '.$emergencyContact->member->familyName) ?></h3>
    </div>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name ') ?></th>
            <td><?= h($emergencyContact->givenName).' '.($emergencyContact->familyName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile Phone') ?></th>
            <td><?= h($emergencyContact->mobilePhone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Home Phone') ?></th>
            <td><?= h($emergencyContact->homePhone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Relationship To Member') ?></th>
            <td><?= h($emergencyContact->relationshipToMember) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $emergencyContact->has('member') ? $this->Html->link($emergencyContact->member->givenName.' '.$emergencyContact->member->familyName, ['controller' => 'Members', 'action' => 'view', $emergencyContact->member->id]) : '' ?></td>
        </tr>

    </table>
 <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px;">Previous Page</button>
</div>
</body>

</html>