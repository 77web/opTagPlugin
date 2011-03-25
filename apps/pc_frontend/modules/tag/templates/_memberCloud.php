<div class="parts tagCloud" id="tagCloud_<?php echo isset($gadget)?$gadget->id:'' ?>">
  <ul>
  <?php foreach($tag_list as $row): ?>
    <li class="tag_<?php echo $row['level']; ?>"><?php echo link_to($row['tag'], "tag/search?tag=".urlencode($row['tag'])); ?></li>
  <?php endforeach; ?>
  </ul>
</div>