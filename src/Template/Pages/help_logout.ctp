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
                        <iframe width="640" height="360" src="https://www.youtube.com/embed/e1LkNy0Fhws" frameborder="0"
                                allowfullscreen></iframe>
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
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/Sk-mj0v7PQw" frameborder="0"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <!-- Collapsible list end -->
    </table>
</div>

</body>
</html>