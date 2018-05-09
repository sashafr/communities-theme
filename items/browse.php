

<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
?>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>



<?php if ($total_results > 0): ?>

    <?php
    $sortLinks[__('Interviewee')] = 'Item Type Metadata,Interviewee';
    $sortLinks[__('Location')] = 'Item Type Metadata,Location';
    $sortLinks[__('Date of Interview')] = 'Item Type Metadata, Data of Interview';
    ?>
    <div id="sort-links">
        <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
    </div>

<?php endif; ?>

<div class="row">
    <div class="col-md-9">
        <div id="allItems">
            <?php foreach (loop('items') as $item): ?>

                <div class="item-meta">
                    <div class="item-img">
                        <?php echo item_image(); ?>
                        <div class="img-caption img-table">
                            <span class="img-table-cell">
                                <?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'img-btn btn-p btn-trans')); ?>
                            </span>
                        </div>
                    </div>

                    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>

                </div><!-- end class="item-meta" -->

            <?php endforeach; ?>
        </div>

        <?php echo pagination_links(); ?>
        <div id="outputs">
            <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
            <?php echo output_format_list(false); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div id="collections">
            <?php set_loop_records('collections', get_records('Collection')) ?>
            <?php foreach (loop('collections') as $collection): ?>
                <div class="collection">
                    <h3><?php echo link_to_items_browse(metadata($collection, array('Dublin Core', 'Title')), array('collection'=>metadata($collection, 'id'))); ?></h3>
                    <ul>
                        <?php set_loop_records('col_items', get_records('Item', array('collection'=>metadata($collection, 'id')), 100)) ?>
                        <?php foreach (loop('col_items') as $col_item): ?>
                            <li>
                                <?php echo link_to($col_item, 'show', metadata($col_item, array('Dublin Core', 'Title'))) ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>


<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>



<?php echo foot(); ?>
