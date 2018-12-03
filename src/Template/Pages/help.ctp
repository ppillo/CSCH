<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Caulfield South Community House</title>
</head>
<body>

<div style="padding:10px;"></div>
<div class='material'>
    <table class="table table-hover data" id="mTable" cellpadding="2" cellspacing="2" width="100%"
           border="0">
        <div class="material_help">
            <h3 style="color:white; font-weight:400;"><?= __('Help') ?></h3>
        </div>

        <!-- Collapsible list start -->
        <div class="panel-group" id="accordion">
            <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
                <div class="panel-heading material_tabs_help_heading ">
                    <h4 class="panel-title" style="margin-bottom: 0px;">
                        <a data-toggle="collapse" data-parent="#accordion" href="#loggingOn">How do I log into my
                            account?</a>
                    </h4>
                </div>
                <div id="loggingOn" class="card_tabs_help panel-collapse collapse in ">
                    <div class="panel-body">
                        <ol>
                            <li>Go to the login page</li>
                            <li>Type in your username and password, then hit the ‘Login’ button.</li>
                        </ol>
                        <iframe width="640" height="360" src="https://www.youtube.com/embed/geUILQJ87Yo" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#forgotPassword">What if I forgot my
                        password?</a>
                </h4>
            </div>
            <div id="forgotPassword" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>Go to the login page and click the 'Forgot Password' link</li>
                        <li>
                            Type in your name, then hit the ‘Submit’ button.<br/>
                            The admin will be notified via email to reset your password.
                        </li>
                    </ol>
                
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/zqDkZY1hNt0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        
        
        <?php //check this person's authentication. if they're not logged in, then don't show these steps.
        if (is_null($this->request->session()->read('Auth.User.username'))) {
                echo "";
            } else { ?>
        <div class="panel panel-default panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0px;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#membership">How do I register a new
                        member?</a>
                </h4>
            </div>
            <div id="membership" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>Go to ‘Members’ > ‘New Member’ from the navigation bar</li>
                        <li>Click ‘Choose File’ to upload an image (optional)</li>
                        <li>Fill in all the fields, including those in the ‘Member Details’, ‘Emergency Contact’, and
                            ‘Member Programs’ sections
                        </li>
                        <li>Click ‘Submit’ to save.</li>
                    </ol>
                    
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/cxI7bhAFsOY" frameborder="0" allowfullscreen></iframe>
                    
                </div>
            </div>
        </div>
        
        
        
        <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#newChild">How do I enrol a new child?</a>
                </h4>
            </div>
            <div id="newChild" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>Go to ‘Children’ > ‘New Child’ from the navigation bar</li>
                        <li>Click ‘Choose File’ to upload an image (optional)</li>
                        <li>Fill in all the fields, including those in the ‘Child Details’, ‘Emergency Contacts’,
                            ‘Custodians’, ‘Childcare Classes’, and ‘Notes’ sections (if applicable)
                        </li>
                        <ul>
                            <li>in the 'Custodians' section, select from the list Members which are custodians
                                (parent/guardian) of the child
                            </li>
                            <li>in the 'Childcare Classes' section, select which classes that the child will be
                                enrolling to
                            </li>
                        </ul>
                        <li>Click ‘Submit’ to save.</li>
                    </ol>
                   
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/3Add2VHufEg" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#newVolunteer">How do I register a new
                        volunteer?</a>
                </h4>
            </div>
            <div id="newVolunteer" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>Go to ‘Members’ > ‘New Member’ from the navigation bar</li>
                        <li>Click ‘Choose File’ to upload an image (optional)</li>
                        <li>In the 'Member Details' section, select ‘Volunteer’ as the Subscription Type</li>
                        <li>Fill in the Volunteer details, including the Referees (if any)</li>
                        <li>Complete all the fields, including the ‘Emergency Contact’ and ‘Member Programs’ sections
                        </li>
                        <li>Click ‘Submit’ to save.</li>
                    </ol>
                     <iframe width="640" height="360" src="https://www.youtube.com/embed/eL2ZGdjFruI" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#class">How do I add another childcare
                        class?</a>
                </h4>
            </div>
            <div id="class" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>From the homepage quicklinks, click 'New Class'</li>
                        <li>Fill in the details and click submit</li>
                    </ol>
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/sZZQ0MRjTIM" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#program">How do I add another member
                        program?</a>
                </h4>
            </div>
            <div id="program" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <ol>
                        <li>From the homepage quicklinks, click 'New Program'</li>
                        <li>Fill in the details and click submit</li>
                    </ol>
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/QG2IciQwE2U" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="panel panel-default material_tabs_help" style="padding: 0px; margin-bottom: 10px;">
            <div class="panel-heading material_tabs_help_heading">
                <h4 class="panel-title" style="margin-bottom: 0;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#backup">How do I batch upload
                        members/children?</a>
                </h4>
            </div>
            <div id="backup" class="panel-collapse collapse card_tabs_help">
                <div class="panel-body">
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/KfAAVMAR56c" frameborder="0" allowfullscreen></iframe>
                    <ol>
                        <li>Download the template files below.</li>
                            <a href="files/BatchUpload_MembersWithContacts_Template.xlsx">Excel Template for members, with emergency contacts</a> <br>
                            <a href="files/BatchUpload_Children_EmergencyContacts_Template.xlsx">Excel Template for children, with emergency contacts</a> <br>
                        <li>Fill in the excel file (Note: the value 0 represents 'No', and a 1 represents 'Yes') <img src="webroot/img/images/help/csv_step2.png" class="img-responsive" alt="Fill in the excel file"></li>
                        <li>Save the file as .CSV(Comma Delimited)<img src="webroot/img/images/help/csv_step3.png" style="max-width:75%" class="img-responsive" alt="Save as Comma Delimitted"></li>
                        <li>If a warning box appears, click 'yes'<img src="webroot/img/images/help/csv_step4.png" style="max-width:75%" class="img-responsive" alt="Save as Comma Delimitted"></li>
                        <li>For Members : Click 'Members' on the Navigation Bar, and click 'Batch Upload Members'</li>
                        <li>Click 'choose file', then click 'submit'</li>
                    </ol>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <!-- Collapsible list end -->
    </table>
</div>

</body>
</html>