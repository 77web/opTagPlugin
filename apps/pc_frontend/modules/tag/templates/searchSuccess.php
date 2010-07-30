<div class="parts">
<div class="partsHeading">
<h3><?php echo __('Search Result for tag "%name%"', array("%name%"=>$tag)); ?></h3>
</div>

<div class="block">
<?php if($pager->getNbResults()>0): ?>
<?php op_include_pager_navigation($pager, "tag/search?tag=".$tag."&page=%s"); ?>
<ul>
<?php foreach($pager->getResults() as $obj): ?>
<?php if($obj->getForeignObject()): ?>
<li><?php echo op_format_date($obj->getForeignDate(), "D"); ?> : <?php echo link_to($obj->getForeignTitle(), $obj->getForeignUrl()); ?>(<?php echo $obj->getCommunityId()?$obj->getCommunity()->getName():$obj->getMember()->getName(); ?>)</li>
<?php endif; ?>
<?php endforeach; ?>

</ul>
<?php else: ?>
 <p><?php echo __('No contents matches.'); ?></p>
<?php endif; ?>

</div>
</div>