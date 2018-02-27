<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
    queue_css_url('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    queue_css_file(array('iconfonts','style'));
    echo head_css();
    queue_css_url('//fonts.googleapis.com/css?family=Barlow+Condensed:400,600|Open+Sans+Condensed:300|Slabo+27px');
    ?>

    <!-- JavaScripts -->
    <?php
    queue_js_url('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
    queue_js_file(array('jquery-accessibleMegaMenu', 'minimalist', 'globals'));
    queue_js_file(array('readmore', 'minimalist', 'globals'));
    echo head_js();
    ?>
    <script type="text/javascript" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

    <header role="banner" class="sh-header">

        <div id="header-wrap">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>

            <?php echo theme_header_image(); ?>

            <div id="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>

            <nav id="top-nav" role="navigation">
                <?php echo public_nav_main(); ?>
            </nav>
        </div>

        <div class="counter"></div>

    </header>

    <div id="wrap">

        <article id="content" class="noborderclick" role="main" tabindex="-1">

            <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
