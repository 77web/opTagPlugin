<?php

class opTagPluginTagComponents extends sfComponents
{
  public function executeCloud($request)
  {
    $this->tag_list = Doctrine::getTable("Tag")->getTagRank(30, 1);
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
}