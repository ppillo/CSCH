<title>Error</title>
<nav class="large-3 medium-4 columns" id="actions-sidebar">


</nav>
<div class="large-12 columns content" >
    <div class="col-md-4 no-padding"></div>
    <div class="col-md-4 no-padding" id="material">
        <div class="material_errorpage">
            <h3 style="color:white; font-weight:400;"><?= __('Oops!') ?></h3>

        </div>

        <fieldset>

            <div style="margin-bottom:-50px;">
                <p>It seems that this page does not exist.</p>

                <?php echo $this->Html->link('Back to home','/pages/home')?>
            </div>
        </fieldset>


    </div>
</div>
