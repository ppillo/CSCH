
<head>
<meta charset="UTF-8">
<title>View Volunteer</title>
    <?php
    $this->Breadcrumbs->add(
        'Volunteers',
        ['controller' => 'volunteers', 'action' => 'index']
    );
    $this->Breadcrumbs->add(
        'View volunteer'

    );

    ?>
 <?= $this->Html->css('actions')?>
<script type="application/javascript">
//    //<!--DataTable start-->
//    $(document).ready(function() {
//        $('#mTable').DataTable({
//                dom: 'B',
//                buttons: [
//                    {
//                        extend: 'pdf',
//                        text: 'Generate PDF',
//                        header: 'Member Details',
//                        filename: 'Member-details',
//                        exportOptions: {
//                            columns: [0, 1, 2, 3, 4, 5, 6]
//                        }
//                    }
//                ]
//            }
//        )
//    });
//
//    <!-- DataTable End -->
</script>
     <?php 
            use Cake\ORM\TableRegistry; ?>
</head>
<div style="padding:10px;"></div>

<div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_volunteers">
        <?= $this->Html->link(__('Edit'), ['controller' => 'members', 'action' => 'edit', $volunteer->member->id], array('class' => 'editbtn')) ?>
    <h3 style="color:white"><?= $volunteer->member->givenName.' '.$volunteer->member->familyName ?></h3>
        </div>
        <table class="table" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
           border="0">
            <h3 style="color:black; font-weight:400;">Volunteer Details</h3>
        <thead>
            <tr>
                <td class="heading">Name</td>
                <td class="heading">Category</td>
                <td class="heading">Start Date</td>
                <td class="heading">Medicare Number</td>
                <td class="heading">Private Health Fund</td>
                <td class="heading">Private Health Fund Number</td>
                <td class="heading">Police Check Date</td>
                <td class="heading">Working With Children Permit No.</td>
                <td class="heading">Working With Children Exp Date</td>
                <td class="heading">Reference Check Complete?</td>
                <td class="heading">Active</td>

            </tr>
        </thead>
        <tbody>
            <tr class="list">
                <td class="datatable"><?= $volunteer->has('member') ? $this->Html->link($volunteer->member->givenName.' '.$volunteer->member->familyName, ['controller' => 'Members', 'action' => 'view', $volunteer->member->id]) : '' ?></td>
                <td class="datatable"><?= $volunteer->has('category') ? $this->Html->link($volunteer->category->name, ['controller' => 'Categories', 'action' => 'view', $volunteer->category->id]) : '' ?></td>
                <td class="datatable">
                    <?php $dob = $volunteer->volunteerStartDate;
                    echo $dob->format('d/M/Y'); ?>
                </td>
                <td class="datatable"><?= h($volunteer->medicareNumber) ?></td>
                <td class="datatable"><?= h($volunteer->privateHealthFundName) ?></td>
                <td class="datatable"><?= h($volunteer->privateHealthFundNumber) ?></td>
                <td class="datatable"><?php
                    $policedate = $volunteer->policeCheckExpiryDate;
                    if(!empty($volunteer->policeCheckExpiryDate)){
                        echo $policedate->format('d/M/Y');


                    }
                    else {
                        echo $volunteer->policeCheckExpiryDate;
                    }
                ?></td>
                <td class="datatable"><?= h($volunteer->workingWithChildrenNumber) ?></td>
                <td class="datatable"><?php
                    $date = $volunteer->workingWithChildrenExpirydate;
                    if (!empty($volunteer->workingWithChildrenExpirydate)){
                        echo $date->format('d/M/Y');

                    }else{
                        echo $volunteer->workingWithChildrenExpirydate;

                    }

                    ?></td>
                <td class="datatable"><?php if($volunteer->reference_check_complete==1){
                                            echo 'Yes';
                                        }
                                        else{
                                            echo 'No';
                                        }
                    
                    ?></td>
                <td class="datatable"><?php if($volunteer->active==1){
                        echo 'Yes';
                    }
                    else{
                        echo 'No';
                    }

                    ?></td>
            </tr>
        </tbody>
        </table>
    
    
    
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Referees</a></li>
            <li><a href="#tab2" data-toggle="tab">Hours</a></li>
        </ul>
    
    
        <div class="tab-content">
        <!-- Tab 1 -->
            
        <div class="tab-pane active" id="tab1">
        <div class="related">
            <div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_volunteers_tab">
    <h3 style="color:white"><?= __('Related Referees') ?></h3>
        </div>
        <?php if (!empty($volunteer->referees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
            </tr>
            <?php foreach ($volunteer->referees as $referees): ?>
            <tr>
                <td><?= h($referees->name) ?></td>
                <td><?= h($referees->phone) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        </div>
            </div>
    </div>
             <!-- Tab 2 -->
        <div class="tab-pane" id="tab2">
        <div class="related">
           <div id="layout" class="members view large-12 medium-8 columns content material">
    <div class="material_volunteers_tab">
        <div class='new_hours' style="margin-top:-5px">
            <a href="#openModal" style="float:right;" class='new_hours_button'></a>
        </div>
    <h3 style="color:white"><?= __('Hours') ?></h3>
        </div> 
        <?php 
        $totalHours = 0;
        $categoriesTable = TableRegistry::get('categories'); //get the categories table   
        if (!empty($volunteer->hours)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Category') ?></th>
                <th scope="col"><?= __('Hours') ?></th>
            </tr>
            <?php foreach ($volunteer->hours as $hour): ?>
            <tr>
                <td><?php 
                    $date = $hour->date;
                    echo $date->format('d/M/Y');

                    ?></td>
                <td><?php
                    $program = $categoriesTable->get($hour->category_id);
                    echo $program->name;
                    ?>
                </td>
                
                <td><?php
                        $hours = floor($hour->hours);
                        $minutes = ($hour->hours - $hours)*60;
                        if($minutes != 0){
                        echo $hours.' Hours and '.$minutes.' Minutes';
                        }
                        else if($hours > 1){
                            echo $hours.' Hours';
                        }

                        else if($hours == 1){
                            echo $hours.' Hour';
                        }
                        $totalHours = $totalHours + ($hour->hours);
                    ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        <label>Total Hours = <?php
                $totalHoursHour =floor($totalHours);
                $totalHoursMinutes = ($totalHours - $totalHoursHour)*60;
                if($totalHoursMinutes != 0){
                    echo $totalHoursHour.' Hours and '.$totalHoursMinutes.' Minutes';
                }
                else{
                    echo $totalHoursHour.' Hours';
                }
            ?> </label>
        </div>
            <!--MODAL-->
                
        <div id="openModal" class="modalDialog">
	       <div>
          <?= $this->Form->create($volunteer, [
        'url' => ['controller' => 'Hours', 'action' => 'addbymodal'],   'type' => 'post'
        ]) ?>
		<a  href="#close" title="Close" class="close">X</a>
            <div class="new_hours_heading">
                 <h3 style="color:White; font-weight:400; width: 200px;"><?= __('Add Hours') ?></h3>
        </div>  
        <fieldset>
        <div class="col-md-12">
        <?php  
            echo $this->Form->input('category_id', ['style' => 'width: 100%','options' => $categories]);
            echo $this->Form->input('date', array('style' => 'width: 100%', 'class' => 'form-control', 'id' => 'hoursdatepicker', 'type' => 'text', 'readonly' => 'readonly',));?>
        </div>
            <div class="col-md-6">
          <label for="single_hours" >Hours</label>
        <select id="single_hours" name="single_hours" style="width:100px">
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
        </select>
            </div>
            <div class="col-md-6">
        <label for="minutes" >Minutes</label>
        <select id="minutes" name="minutes"  style="width:100px">
            <option value=0>00</option>
            <option value=0.25>15</option>
            <option value=0.5>30</option>
            <option value=0.75>45</option>
        </select>
            </div>
        </fieldset>
        
         <div class="row " style="padding-left:30px;">
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
	</div>
</div>    
            
            
        </div>
    </div>
    </div>
    
    <!--Back button-->
    <button onclick="goBack()" id="previous_button" style="margin-bottom:-4px;">Previous Page</button>
<script>
function goBack() {
    window.history.back();
}
</script>
    
    </div>
 
<script  type="text/javascript">
    <!-- Datepicker notes start -->
    $(function () {
        var currentDate = new Date();
        $("#hoursdatepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            defaultdate: currentDate,
            maxDate: currentDate
        });

        $("#hoursdatepicker").datepicker("setDate", new Date());
    });
</script>