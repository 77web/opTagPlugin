<?php

class opTagPluginTagComponents extends sfComponents
{
  public function executeCloud($request)
  {
    $this->tag_list = Doctrine::getTable("Tag")->getTagRank(30, 1);
    $this->getResponse()->addStylesheet("/opTagPlugin/css/tag.css");
  }

  public function executeMemberCloud($request)
  {
    $memberId = $request->getParameter('id', $this->getUser()->getMemberId());
    $this->tag_list = Doctrine::getTable("Tag")->getTagRankMember($memberId, 30, 1);
    $this->getResponse()->addStylesheet("/opTagPlugin/css/tag.css");
  }
  
  public function executeForm($request)
  {
    $this->tagForm = new TagForm();
    if(isset($this->diary))
    {
      $this->tagForm->setForeignObj($this->diary);
    }
    if(isset($this->communityEvent))
    {
      $this->tagForm->setForeignObj($this->communityEvent);
    }
    if(isset($this->communityTopic))
    {
      $this->tagForm->setForeignObj($this->communityTopic);
    }
  }
  
  public function executeShow($request)
  {
    $this->isTable = false;
    if(isset($this->diary))
    {
      $this->tags = Doctrine::getTable("Tag")->getTags($this->diary->getId(), "Diary");
    }
    if(isset($this->communityEvent))
    {
      $this->tags = Doctrine::getTable("Tag")->getTags($this->communityEvent->getId(), "CommunityEvent");
      $this->isTable = true;
    }
    if(isset($this->communityTopic))
    {
      $this->tags = Doctrine::getTable("Tag")->getTags($this->communityTopic->getId(), "CommunityTopic");
    }
  }
}