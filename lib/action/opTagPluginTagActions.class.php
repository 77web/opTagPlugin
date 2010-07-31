<?php

class opTagPluginTagActions extends sfActions
{
  public function executeSearch(sfWebRequest $request)
  {
    $tag = $request->getParameter("tag");
    $page = $request->getParameter("page", 1);
    $size = sfConfig::get("app_tag_search_pagesize", 20);
    $type = $request->getParameter("type", "all");
    if($type!="all")
    {
      $types = array($type);
    }
    else
    {
      $types = array("Diary", "CommunityTopic", "CommunityEvent");
    }
    $this->types = $types;
    
    $this->tag = $tag;
    $this->pagers = array();
    $memberId = $this->getUser()->getMemberId();
    foreach($types as $type)
    {
      $this->pagers[$type] = Doctrine::getTable("Tag")->getPager($tag, $type, $memberId, $size, $page);
    }
  }
}