<?php echo __("Tags"); ?> : 
<?php foreach($tags as $i => $tag): ?>
<?php if($i!=0): ?>,<?php endif; ?>
<?php echo link_to($tag->getName(), "tag/search?tag=".urlencode(mb_convert_encoding($tag->getName(), "SJIS", "UTF-8"))); ?>
<?php endforeach; ?>