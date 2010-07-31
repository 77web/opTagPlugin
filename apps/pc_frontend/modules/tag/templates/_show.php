<?php if(isset($tags) && count($tags)): ?>

<?php slot('opTagPluginTagLabel'); ?>
<?php echo __("Tags"); ?>
<?php end_slot(); ?>

<?php slot('opTagPluginTagView'); ?>
<?php foreach($tags as $i => $tag): ?>
<?php if($i!=0): ?>,<?php endif; ?>
<?php echo link_to($tag->getName(), "tag/search?tag=".urlencode($tag->getName())); ?>
<?php endforeach; ?>
<?php end_slot(); ?>

<?php if($isTable): ?>
<tr>
<th>
<?php include_slot('opTagPluginTagLabel'); ?>
</th>
<td>
<?php include_slot('opTagPluginTagView'); ?>
</td>
</tr>
<?php else: ?>
<?php include_slot('opTagPluginTagLabel'); ?> : <?php include_slot('opTagPluginTagView'); ?>
<?php endif; ?>

<?php endif; ?>