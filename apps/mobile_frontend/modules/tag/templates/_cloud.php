
<hr />
  <?php foreach($tag_list as $row): ?>
    <font size="<?php echo (6-$row['level']); ?>"><?php echo link_to($row['tag'], "tag/search?tag=".urlencode(mb_convert_encoding($row['tag'], "SJIS", "UTF-8"))); ?></font>
  <?php endforeach; ?>
<hr />