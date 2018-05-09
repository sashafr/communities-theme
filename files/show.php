<?php
$fileTitle = metadata('file', 'display_title');

if ($fileTitle != '') {
    $fileTitle = ': &quot;' . $fileTitle . '&quot; ';
} else {
    $fileTitle = '';
}
$fileTitle = __('File #%s', metadata('file', 'id')) . $fileTitle;
?>
<?php echo head(array('title' => $fileTitle, 'bodyclass'=>'files show primary-secondary')); ?>

<div id="primary">
    <?php echo file_markup($file, array('imageSize'=>'fullsize')); ?>
    <?php echo all_element_texts('file'); ?>
</div>

<?php echo foot();?>
