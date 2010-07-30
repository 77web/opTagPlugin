<?php


//register
$this->dispatcher->connect('op_action.post_execute_diary_create', array("opTagRegister", "listenToDiaryCreate"));
$this->dispatcher->connect('op_action.post_execute_diary_update', array("opTagRegister", "listenToDiaryUpdate"));
//remover
$this->dispatcher->connect('op_action.post_execute_diary_delete', array("opTagRemover", "listenToDiaryDelete"));

//register
$this->dispatcher->connect('op_action.post_execute_communityEvent_create', array("opTagRegister", "listenToEventCreate"));
$this->dispatcher->connect('op_action.post_execute_communityEvent_update', array("opTagRegister", "listenToEventUpdate"));
$this->dispatcher->connect('op_action.post_execute_communityTopic_create', array("opTagRegister", "listenToTopicCreate"));
$this->dispatcher->connect('op_action.post_execute_communityTopic_update', array("opTagRegister", "listenToTopicUpdate"));
//remover
$this->dispatcher->connect('op_action.post_execute_communityEvent_delete', array("opTagRemover", "listenToCommunityEventDelete"));
$this->dispatcher->connect('op_action.post_execute_communityTopic_delete', array("opTagRemover", "listenToCommunityTopicDelete"));
