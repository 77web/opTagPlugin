<?php $acl = opCommunityTopicAclBuilder::buildResource($communityTopic, array($sf_user->getMember())) ?>
<?php op_mobile_page_title($community->getName(), $communityTopic->getName()) ?>

<?php /* ** added for opNicePlugin ** */  include_customizes("topicDetailBox", "top"); ?>

<?php echo op_within_page_link() ?>
<?php echo op_format_date($communityTopic->getCreatedAt(), 'MM/dd HH:mm') ?>
<?php if ($communityTopic->getMemberId() === $sf_user->getMemberId()): ?>
<?php endif; ?><br>
<?php if ($communityTopic->getMember() && $communityTopic->getMember()->getName()): ?>
<?php echo link_to($communityTopic->getMember()->getName(), 'member/profile?id='.$communityTopic->getMember()->getId()) ?>
<?php endif; ?>
<?php if ($communityTopic->isEditable($sf_user->getMemberId())): ?>
&nbsp;[<?php echo link_to(__('Edit'), '@communityTopic_edit?id='.$communityTopic->getId()) ?>]
<?php endif ?>
<br>
<?php echo nl2br($communityTopic->getBody()) ?><br>

<?php /* ** added for opNicePlugin ** */  include_customizes("topicDetailBox", "bottom"); ?>

<?php include_component('communityTopicComment', 'list', array('communityTopic' => $communityTopic)) ?>

<?php echo op_within_page_link('') ?>
<?php if ($acl->isAllowed($sf_user->getMemberId(), null, 'addComment')): ?>
<hr color="<?php echo $op_color['core_color_11'] ?>">
<?php
$options['url'] = url_for('communityTopic_comment_create', $communityTopic);
$options['button'] = __('Post');
$options['isMultipart'] = true;
op_include_form('formTopicComment', $form, $options);
?>
<?php endif; ?>
<hr color="<?php echo $op_color['core_color_11'] ?>">

<?php echo link_to(__('Topic List'), '@communityTopic_list_community?id='.$community->getId()) ?><br>
<?php echo link_to(__('Community Top'), 'community/home?id='.$community->getId()) ?>
