

<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
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

<script>
var sort = document.getElementById("sort-links-list");
var sortByTitle = sort.childNodes[0];
  if (window.location.href == "http://165.227.177.44/items/browse") {
  //sortByTitle.childNodes[0].click();

}

</script>

<div class="row">
    <div class="col-md-9">
        <div id="allItems">
            <?php foreach (loop('items') as $item): ?>

                <div class="item-meta">
                    <div class="item-img">
                        <?php if (metadata('item', 'has files')): ?>
                            <?php echo link_to_item(item_image()); ?>
                        <?php else:?>
                            <img src = "../../../application/views/scripts/images/fallback-file.png" height = "200px" width = "200px">
                        <?php endif; ?>
                        <div class="img-caption img-table">
                            <span class="img-table-cell">
                                <button class="img-btn btn-p btn-trans" role="button">
                                    <?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class' => 'permalink')); ?>
                                </button>
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
        <div id = "collections">
            <?php $collections = get_records('Collection');
            for ($x = 0; $x < count($collections); $x++) {
                ?>
                <div class = "collection">
                    <a href = "#">
                        <div class = "collectionTitle">
                            <?php
                            $collection = $collections[$x];
                            echo metadata($collection, array('Dublin Core', 'Title'));
                            $innerCollectionId = "innerCollection" . $x;
                            ?>
                            <i class="fas fa-caret-down"></i
                        </div>
                    </a>
                    <div class = "innerCollection" id = "<?php echo $innerCollectionId?>" style = "display:none; margin-left:-20px">
                        <ul style="list-style-type:circle">
                            <?php
                            $id = $collection->id;
                            $items = get_records('Item', array('collection'=>$collection), 50);
                            for ($y = 0; $y < count($items); $y++) {

                                $item = $items[$y];
                                $url = record_url($item);
                                ?>
                                <a href = "<?php echo $url ?>"> </li>
                                    &#x2022;
                                    <?php
                                    echo metadata($item, array('Dublin Core', 'Title'));
                                    echo nl2br( "\n");
                                    ?>
                                </li>
                            </a>
                            <?php
                        }

                        ?>
                    </ul>
                </div>
            </div>

            <?php
        }
        ?>

        <script>
        var collection = <?php echo json_encode($collection) ?>;


        console.log(Object.keys(collection));
        var collectionsTitle = document.getElementsByClassName("collectionTitle");
        var innerCollections = document.getElementsByClassName("innerCollection");
        for (i = 0; i < collectionsTitle.length; i++) {

            collectionsTitle[i].addEventListener("click", displayItemsInCollection(i));
        }



        function displayItemsInCollection(i) {
            //alert("click");
            function innerCallback(e) {
                for (var j = 0; j < innerCollections.length; j++) {
                    var idNo = innerCollections[j].id.slice(15);
                    //alert(idNo);
                    if (idNo == i && innerCollections[j].style.display == "none") {
                        innerCollections[j].style.display = "block";
                        return;
                    }

                    if (idNo ==i && innerCollections[j].style.display == "block") {
                        innerCollections[j].style.display = "none";
                        return;
                    }


                }
            }
            return innerCallback;
        }

        </script>
        </div>
    </div>

</div>


<?php fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); ?>



<?php echo foot(); ?>
