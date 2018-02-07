<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show')); ?>

<div class="row sh-metadata">
  <div class="col-sm-7">
    <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
    <?php if (count($item->getItemTypeElements()) > 0): ?>
      <table>
        <?php foreach (item_type_elements() as $element => $elementtext): ?>
          <?php if ($elementtext != "" && $element != "Interviewee" && $element != "Transcription" && $element != "Interview Summary"): ?>
            <tr class="element">
              <td><?php echo $element ?>:</td>
              <td><?php echo $elementtext ?></td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </table>
    <?php endif ?>
  </div>
  <?php if (metadata('item', 'has files')): ?>
    <div class="col-sm-5 sh-show-thumbs">
      <?php echo link_to_item(item_image('square_thumbnail')); ?>
      <?php if (count($item->getFiles()) > 1 && $item->getFile(1)->has_derivative_image): ?>
        <?php echo link_to_item(item_image('square_thumbnail', null, 1)); ?>

      <?php endif ?>
    </div>
  <?php endif ?>
</div>

<div class="row">
  <div class="col-sm-8">
    <div class="row">
      <?php if (metadata('item', array('Item Type Metadata', 'Interview Summary')) != ""): ?>
        <p><?php echo metadata('item', array('Item Type Metadata', 'Interview Summary')); ?></p>
      <?php endif; ?>
    </div>
    <div class="row read-more-wrap">
      <?php if (metadata('item', array('Item Type Metadata', 'Transcription')) != ""): ?>
        <div class="read-more-content">
          <p><?php echo metadata('item', array('Item Type Metadata', 'Transcription')); ?></p>
        </div>
      <?php else: ?>
        <p>This item does not have a transcription yet.</p>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-sm-4 sticky">
    <?php if (metadata('item', 'has files')): ?>
      <?php for ($x = 2; $x < count($item->getFiles()); $x++): ?>
        <?php $file = $item->getFiles()[$x]; ?>
        <?php $url = file_display_url($file, $format = 'original'); ?>
        <div class="item-collapsed">
          <a href="<?php echo $url?>">
            <?php echo file_image('square_thumbnail', array('class' => 'thumbnail'), $file); ?>
          </a>
          <?php echo file_markup($file);?>
        </div>
      <?php endfor; ?>
      <script>
      var items = <?php echo json_encode($item->getFiles()) ?>;

      </script>

    <?php endif; ?>
  </div>
</div>


<!-- If the item belongs to a collection, the following creates a link to that collection. -->
<?php if (metadata('item', 'Collection Name')): ?>
  <div id="collection" class="element">
    <h3><?php echo __('Collection'); ?></h3>
    <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
  </div>
<?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
<?php if (metadata('item', 'has tags')): ?>
  <div id="item-tags" class="element">
    <h3><?php echo __('Tags'); ?></h3>
    <div class="element-text"><?php echo tag_string('item'); ?></div>
  </div>
<?php endif;?>

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
