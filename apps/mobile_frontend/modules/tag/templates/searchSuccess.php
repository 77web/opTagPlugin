<?php op_mobile_page_title(__('Search tagged contents')) ?>

<?php $title = __('Search Result for tag "%name%"', array("%name%"=>$tag)); ?>


<?php if($pager->getNbResults()>0): ?>
<center>
<?php echo pager_total($pager) ?>
</center>
<?php
$list = array();
foreach($pager->getResults() as $obj)
{
  if($obj->getForeignObject())
  {
    $list[] = op_format_date($obj->getForeignDate()).link_to($obj->getForeignTitle(), $obj->getForeignUrl()).$obj->getForeignObject()->getMember()->getName();
  }
}
$options = array();
$options['title'] = $title;
$options['border'] = false;

op_include_list("tagSearchResult", $list, $options);
?>

<?php op_include_pager_navigation($pager, "tag/search?tag=".mb_convert_encoding($tag, "SJIS", "UTF-8")."&page=%s"); ?>
<?php else: ?>
 <p><?php echo __('No contents matches.'); ?></p>
<?php endif; ?>


<hr color="<?php echo $op_color['core_color_11'] ?>" />