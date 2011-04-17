<?php op_mobile_page_title($community->getName(), $communityEvent->getName()) ?>

<?php echo op_within_page_link() ?>
<?php
$list = array(
  'Writer'               => link_to($communityEvent->getMember()->getName(), 'member/profile?id='.$communityEvent->getMember()->getId()),
  'Open date'            => op_format_date($communityEvent->getOpenDate(), 'D').($communityEvent->getOpenDate() ? ' '.$communityEvent->getOpenDateComment() : ''),
  'Area'                 => $communityEvent->getArea(),
  'Capacity'             => $communityEvent->getCapacity() ? $communityEvent->getCapacity() : __('Limitless'),
  'Count of Member'      => __('%1% persons', array('%1%' => $communityEvent->countCommunityEventMembers())),
);

if (!$communityEvent->getMember() || !$communityEvent->getMember()->getName())
{
  $list['Writer'] = '';
}

if ($communityEvent->countCommunityEventMembers())
{
  $list['Count of Member'] .= '<br>'.link_to(__('See Member List'), '@communityEvent_memberList?id='.$communityEvent->getId());
}

if ($communityEvent->getApplicationDeadline())
{
  $list['Application deadline'] = op_format_date($communityEvent->getApplicationDeadline(), 'D');
}

$list['Body'] = nl2br($communityEvent->getBody()).'<br>'.op_format_date($communityEvent->getCreatedAt(), 'MM/dd HH:mm');

if ($communityEvent->isEditable($sf_user->getMemberId()))
{
  $list[__('Edit this event')] = link_to(__('See event edit form'), '@communityEvent_edit?id='.$communityEvent->getId());
}

include_customizes("communityEvent", "firstRow");
foreach ($list as $key => $value)
{
  echo '<br>'.__($key, array(), 'community_event_form').':<br>'.$value.'<br>';
}
include_customizes("communityEvent", "lastRow");
?>

<?php include_component('communityEventComment', 'list', array('communityEvent' => $communityEvent)) ?>

<?php echo op_within_page_link('') ?>
<?php if ($communityEvent->isCreatableCommunityEventComment($sf_user->getMemberId())): ?>
<hr color="<?php echo $op_color['core_color_11'] ?>">
<div id="formEventComment">
<table>
<form action="<?php echo url_for('communityEvent_comment_create', $communityEvent) ?>" method="post">
<?php echo $form ?>
<?php if (!$communityEvent->isClosed() && !$communityEvent->isExpired()): ?>
<?php if ($communityEvent->isEventMember($sf_user->getMemberId())): ?>
<input name="cancel" class="input_submit" type="submit" value="<?php echo __('Cancel') ?>" />
<?php elseif (!$communityEvent->isAtCapacity()): ?>
<input name="participate" class="input_submit" type="submit" value="<?php echo __('Participate in this event') ?>" />
<?php endif; ?>
<br>
<?php endif; ?>
<input name="comment" class="input_submit" type="submit" value="<?php echo __('Add a comment only') ?>" />
</form>
</table>
</div>
<?php endif; ?>
<hr color="<?php echo $op_color['core_color_11'] ?>">

<?php echo link_to(__('List of events'), '@communityEvent_list_community?id='.$community->getId()) ?><br>
<?php echo link_to(__('Community Top'), 'community/home?id='.$community->getId()) ?>
