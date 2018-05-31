<?php echo head(array('bodyid'=>'home')); ?>

<div class="row">
    <div class="col-sm-6">
        <div class="portal portal1">
            <h2 class="portal-text"><a href="http://pennds.org/societyhill/items/browse?sort_field=Item+Type+Metadata%2CInterviewee">Oral Histories</a></h2>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="portal portal2">
            <h2 class="portal-text"><a href="http://pennds.org/societyhillmap/">Map & Photographs</a></h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php if (get_theme_option('Homepage Text')): ?>
            <hr />
            <p><?php echo get_theme_option('Homepage Text'); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
