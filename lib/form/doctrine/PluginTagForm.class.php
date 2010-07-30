<?php

/**
 * PluginTag form.
 *
 * @package    opTagPlugin
 * @subpackage form
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginTagForm extends BaseTagForm
{
  protected $foreignObj = null;

  public function __construct($options=array(), $attributes=array(), $csrf=true)
  {
    parent::__construct($options, $attributes, false);
  }
  
  public function setup()
  {
    parent::setup();
    unset($this['id']);
    $this->useFields(array("name"));
    
    $this->setWidget("name", new sfWidgetFormInput(array("label"=>"tag"), array("size"=>40)));
    $this->setValidator("name", new sfValidatorString(array("required"=>true)));
    $this->getWidgetSchema()->setHelp("name", sfConfig::get("app_tag_separator_caption")."で区切って複数指定できます。");
  }
  
  public function setForeignObj($obj)
  {
    $this->foreignObj = $obj;
    
    if($this->foreignObj->getId())
    {
      $tags = array();
      foreach(Doctrine::getTable("Tag")->getTags($this->foreignObj->getId(), get_class($this->foreignObj)) as $tag)
      {
        $tags[] = $tag->getName();
      }
      $this->setDefault("name", implode(sfConfig::get("app_tag_separator", ","), $tags));
    }
  }
  
  public function save()
  {
    $names = $this->getValue("name");
    if(strlen($names))
    {
      $memberId = $this->foreignObj->getMemberId();
      $communityId = (strpos(get_class($this->foreignObj), "Community")!==FALSE)?$this->foreignObj->getCommunityId():null;

      Doctrine::getTable("Tag")->saveTags($names, $this->foreignObj->getId(), get_class($this->foreignObj), $memberId, $communityId);
    }
  }
}
