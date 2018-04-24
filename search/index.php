<?php
$pageTitle = __('Search') . ' ' . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
?>
<h1><?php echo $pageTitle; ?><small> - <?php echo link_to_items_browse("View All", array('sort_field'=>'Dublin Core, Title')); ?></small></h1>
<?php if ($total_results): ?>
<?php echo pagination_links(); ?>

<div class="row">
    <div class="col-md-9">
        <div id="allItems">

            <?php foreach (loop('search_texts') as $searchText): ?>
            <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
            <?php $recordType = $searchText['record_type']; ?>
            <?php set_current_record($recordType, $record); ?>

                <div class="item-meta">
                    <div class="item-img">

                        <?php if ($recordImage = record_image($recordType)): ?>
                            <?php echo link_to($record, 'show', $recordImage); ?>
                        <?php else:?>
                            <img src = "../../../application/views/scripts/images/fallback-file.png" height = "200px" width = "200px">
                        <?php endif; ?>
                        <div class="img-caption img-table">
                            <span class="img-table-cell">
                                <button class="img-btn btn-p btn-trans" role="button">
                                    <a href="<?php echo record_url($record, 'show'); ?>"><?php echo $searchText['title'] ? $searchText['title'] : '[Unknown]'; ?></a>                                </button>
                            </span>
                        </div>
                    </div>

                </div><!-- end class="item-meta" -->

            <?php endforeach; ?>
        </div>

</div>
<?php echo pagination_links(); ?>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results.');?></p>
</div>
<?php endif; ?>
<?php echo foot(); ?>
