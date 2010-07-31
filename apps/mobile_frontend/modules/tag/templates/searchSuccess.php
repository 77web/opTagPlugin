<?php op_mobile_page_title(__('Search tagged contents')); ?>
<?php foreach($types as $type): ?>
<?php $subtitle = __('Search Result for tag "%name%" in %type%', array("%name%"=>$tag, "%type%"=>__($type))); ?>
<table width="100%">
<tr><td bgcolor="<?php echo $op_color["core_color_5"] ?>">
<font color="<?php echo $op_color["core_color_25"] ?>"><?php echo $subtitle; ?></font><br>
</td></tr>
</table>
<?php $pager = $pagers[$type]; ?>

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
$options['border'] = false;

op_include_list("tagSearchResult", $list, $options);
?>

<?php op_include_pager_navigation($pager, "tag/search?tag=".mb_convert_encoding($tag, "SJIS", "UTF-8")."&page=%s"); ?>
<?php else: ?>
<?php op_include_box('searchTagResult', __('No contents matches.')); ?>
<?php endif; ?>


<hr color="<?php echo $op_color['core_color_11'] ?>" />
<?php endforeach; ?>