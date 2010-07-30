<?php

class opTagPluginTagActions extends sfActions
{
  public function executeSearch(sfWebRequest $request)
  {
    $tag = $request->getParameter("tag");
    $page = $request->getParameter("page", 1);
    $size = sfConfig::get("app_tag_search_pagesize", 20);
    
    $this->tag = $tag;
    $this->pager = Doctrine::getTable("Tag")->getPager($tag, $size, $page);
    
  }
}