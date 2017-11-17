<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));

function getRandomSize($min, $max) {
    return round(rand() * ($max - $min) + $min);
}
?>


<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>

<div id="sh-photos">
    <?php foreach (loop('items') as $item): ?>
        <?php if (metadata('item', 'has files')):
        $width = rand(200, 400);
        $height = rand(200, 400); ?>  
            <?php echo link_to_item(item_image('fullsize', array('style' => 'width:' . $width . 'px;height:' . $height . 'px;'))); ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot();