<!DOCTYPE html>
<html>
<?php
$this->Breadcrumbs->add(
    'Members',
    ['controller' => 'members', 'action' => 'index']
);
?>
<head>
    <meta charset="UTF-8">
    <title>Members Index</title>
    <?= $this->Html->css('actions') ?>
    <!-- DateTable Start -->
    <script type="application/javascript">
        if ((window.innerWidth < 960) || (screen.width < 960)) {

            $(document).ready(function () {
                $('#mTable').DataTable({
                    order: [8, 'desc'],
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }

                        }

                    ],
                    responsive: true,
                    columnDefs: [
                        {responsivePriority: 1, targets: 0},
                        {responsivePriority: 2, targets: 1},
                        {responsivePriority: 3, targets: 7},
                        {
                            "targets": [8],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });

            document.getElementById("box1").style.visibility = "hidden";
            document.getElementById("box2").style.visibility = "hidden";
        }
        else {
            $(document).ready(function () {


                $('#mTable').DataTable({
                    order: [8, 'desc'],
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'pdf',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        }

                    ],
                    columnDefs: [
                        {
                            "targets": [8],
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });
            });
        }


        //For filtering inactive members
        $(document).ready(function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData) {
                var checked = $('#checkbox-inactive').is(':checked');

                if (checked && aData[7] == 'No') {
                    return false;
                }
                return true;

            });
            var oTable = $('#mTable').dataTable();
            $('#checkbox-inactive').on("click", function (e) {
                oTable.fnDraw();
            });

        });

        $(document).ready(function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData) {
                var checked = $('#checkbox-active').is(':checked');

                if (checked && aData[7] == 'Yes') {
                    return false;
                }
                return true;

            });
            var oTable = $('#mTable').dataTable();
            $('#checkbox-active').on("click", function (e) {
                oTable.fnDraw();
            });

        });

        <!-- DateTable End -->
    </script>
</head>

<body>
<div style="padding:10px;">
</div>
<div class='material'>
    <table class="table table-hover" id="mTable" cellpadding="2" cellspacing="2" width="100%" id="data"
           border="0">
        <div class="material_members">
            <h3 style="color:white; fontWeight:regular;"><?= __('Members') ?></h3>
            <label class="material_hide1" id="box1"> Hide inactive members
                <input id="checkbox-inactive" type="checkbox">
            </label>
            <label class="material_hide2" id="box2"> Hide active members
                <input id="checkbox-active" type="checkbox">
            </label>
        </div>
        <thead>
        <tr>
            <td class="heading">Given Name</td>
            <td class="heading">Family Name</td>
            <td class="heading">Email</td>
            <td class="heading">Suburb</td>
            <td class="heading" style="text-align:left; width:100px;">Mobile</td>
            <td class="heading">Sub. Type</td>
            <td class="heading">Join date</td>
            <td class="heading" style="text-align:left; width:60px;">Active</td>
            <td class="heading" style="text-align:left; width:60px;">id</td>
            <td class="heading" style="text-align:left; width:80px;">Actions</td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($members as $member): ?>
            <tr class="list">
                <td class="datatable"><?php echo h($member->givenName); ?></td>
                <td class="datatable"><?php echo h($member->familyName); ?></td>
                <!--Email Hover-over-->
                <td class="datatable" title="<?php echo h($member->email); ?>"><a
                        href="mailto:<?php echo($member->email); ?>"><?php echo h($member->email); ?></a></td>
                <td class="datatable">
                    <?php echo h($member->suburb) . "<br />"; ?>
                </td>
                <td class="datatable"><?php echo h($member->mobilePhone); ?></td>
                <td class="datatable">
                    <?php if (($member->tier) == 'F') {
                        echo 'Family';
                    } else if (($member->tier) == 'I') {
                        echo 'Individual';
                    } else if (($member->tier) == 'C') {
                        echo 'Concession';
                    } else if (($member->tier) == 'Y') {
                        echo 'Youth';
                    } else if (($member->tier) == 'G') {
                        echo 'Garden';
                    } else if (($member->tier) == 'V') {
                        echo 'Volunteer';
                    } else {
                        echo '';
                    }
                    ?>
                <td class="datatable">
                    <?php
                    //$signup = $member->signupDate;
                    echo date_format($member->signupDate, 'd/M/Y');
                    ?>

                </td>
                <td class="datatable" style="text-align:left;">
                    <?php if (($member->active) == 1) {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    }
                    ?>
                </td>
                <td class="datatable"><?php echo h($member->id); ?></td>
                <td class="actions" style="text-align: left;">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $member->id], array('title' => 'View', 'class' => 'view_button')) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $member->id], array('title' => 'Edit', 'class' => 'edit_button')) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div style="height:20px;">
</div>


<div>
    <?php
    if ($this->request->session()->read('Auth.User.role') == "admin") {
        //make the button invisible if it's NOT the admin.

        $id = null;
        ?>

        <form method="post" accept-charset="utf-8" onsubmit="return confirm_reset()"
              action="<?php echo 'members/deactiveMembers' ?>">
            <div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
            <button name="deactiveButton" type="submit">Deactivate Members</button>
        </form>

        <?php
    }
    ?>
    <!----><?php //$link = ($this->Url->build(["controller" => "members", "action" => "deactive_members"])); ?>
</div>

<?php
if ($this->request->session()->read('Auth.User.role') == "admin") {
    //make the button invisible if it's NOT the admin.
    //echo '<li><a onClick="confirm_reset()" id="deactiveMembers">Deactive All Members</a></li>';
}
?>
<?php //$link = ($this->Url->build(["controller" => "members", "action" => "deactiveMembers"]));
//debug(__DIR__);
?>
</body>


<script>
    function confirm_reset() {
        var today = new Date();
        var endYear = new Date(new Date().getFullYear(), 11, 31);

        if (today.setHours(0, 0, 0, 0) != endYear.setHours(0, 0, 0, 0)) {
            if (confirm("Are you sure you want to deactivate all Members except for Volunteers? THIS CANNOT BE REVERSED!") == true) {
                if (confirm("Are you really sure? THIS CANNOT BE REVERSED!") == true) {
                    window.location = "\deactiveMembers";
                }
                else {
                    alert("Cancelled");
                    return false;
                }
            } else {
                alert("Cancelled");
                return false;
            }
        }
        else {
            if (confirm("Are you sure you want to deactivate all Members except for Volunteers? THIS CANNOT BE REVERSED!") == true) {
                if (confirm("Are you really sure? THIS CANNOT BE REVERSED!") == true) {
                    window.location = "\deactiveMembers";
                }
                else {
                    alert("Cancelled");
                    return false;
                }
            } else {
                alert("Cancelled");
                return false;
            }
        }
    }
</script>
