<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show')); ?>

<div class="row sh-metadata">
    <div class="col-sm-7">
        <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
        <?php if (count($item->getItemTypeElements()) > 0): ?>
            <table>
                <?php foreach (item_type_elements() as $element => $elementtext): ?>
                    <?php if ($elementtext != "" && $element != "Interviewee" && $element != "Transcription" && $element != "Interview Summary"): ?>
                        <tr class="element" >
                            <td style="vertical-align: top;"><?php echo $element ?>:</td>
                            <td style="vertical-align: top;"><?php echo $elementtext ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        <?php endif ?>
    </div>
    <?php if (metadata('item', 'has files')): ?>
        <div class="col-sm-5 sh-show-thumbs">
            <?php if( $item->getFile(0)->has_derivative_image):
                $file0 = $item->getFile(0);
                $url0 = record_url($file0); ?>
                <a href="<?php echo $url0?>" style = "height:200px">
                    <?php echo file_image('fullsize', array('class' => 'thumbnail'), $file0); ?>
                </a>


                <?php
                endif
                ?>
                <?php if (count($item->getFiles()) > 1 && $item->getFile(1)->has_derivative_image): ?>

                    <?php $file1 = $item->getFile(1); ?>
                    <?php $url = record_url($file1); ?>
                    <a href="<?php echo $url?>">
                        <?php echo file_image('square_thumbnail', array('class' => 'thumbnail'), $file1); ?>
                    </a>


                <?php endif ?>
            </div>
        <?php endif ?>
    </div>

    <div class="row sh-transcription">

        <div class="col-sm-8" style="padding: 0;">
            <?php if (metadata('item', array('Item Type Metadata', 'Interview Summary')) != ""): ?>
                <div>
                    <p><?php echo metadata('item', array('Item Type Metadata', 'Interview Summary')); ?></p>
                </div>
            <?php endif; ?>

            <div class="read-more-wrap">
                <?php if (metadata('item', array('Item Type Metadata', 'Transcription')) != ""): ?>
                    <div class="read-more-content">
                        <p><?php echo metadata('item', array('Item Type Metadata', 'Transcription')); ?></p>
                    </div>
                <?php else: ?>
                    <p>This item does not have a transcription yet.</p>
                <?php endif; ?>
            </div>
            <?php if (metadata('item', array('Dublin Core', 'Rights')) != ""): ?>
                <div>
                    <p><?php echo metadata('item', array('Dublin Core', 'Rights')); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Get all media files except the first two -->
        <div class="col-sm-4">
            <?php if (count($item->getFiles()) > 2): ?>
                <div class="row sh-transcription">
                    <h3>Media</h3>
                    <p>Click images to learn more</p>
                    <?php for ($x = 2; $x < count($item->getFiles()); $x++) { ?>
                        <?php $file = $item->getFiles()[$x]; ?>
                        <?php $url = record_url($file); ?>
                        <div class="item-collapsed" >
                            <a href="<?php echo $url?>">
                                <?php echo file_image('square_thumbnail', array('class' => 'thumbnail-sm'), $file); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
        <div id="collection" class="element">
            <h3><?php echo __('Collection'); ?></h3>
            <div class="element-text"><p><?php echo link_to_items_browse(metadata('item', 'Collection Name'), array('collection'  => get_collection_for_item()->id)); ?></p></div>
        </div>
    <?php endif; ?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

    <div id="item-output-formats" class="element">
        <h3><?php echo __('Output Formats'); ?></h3>
        <div class="element-text"><?php echo output_format_list(); ?></div>
    </div>

    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

    <nav>
        <ul class="item-pagination navigation">
            <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
            <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
        </ul>
    </nav>

    <?php echo foot(); ?>
