<?php
/**
 * PluginTagTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    opTagPlugin
 * @subpackage model
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class PluginTagTable extends Doctrine_Table
{
  
  public function saveTags($tags, $foreignId, $foreignTable, $memberId, $communityId=null)
  {
    $tags = explode(sfConfig::get("app_tag_separator", ","), $tags);
    foreach($this->getTags($foreignId, $foreignTable) as $tag)
    {
      if(!in_array($tag->getName(), $tags))
      {
        $tag->delete();
      }
    }
    
    foreach($tags as $name)
    {
      $this->saveTag($name, $foreignId, $foreignTable, $memberId, $communityId);
    }
  }
  
  public function saveTag($tag, $foreignId, $foreignTable, $memberId, $communityId=null)
  {
    if($tag!="")
    {
      $obj = $this->createQuery()->where("member_id=?", $memberId)->addWhere("foreign_table=?", $foreignTable)->addWhere("foreign_id=?", $foreignId)->addWhere("name=?", $tag)->fetchOne();
      if(!$obj)
      {
        $obj = new Tag();
        $obj->setMemberId($memberId);
        if($communityId) $obj->setCommunityId($communityId);
        $obj->setForeignTable($foreignTable);
        $obj->setForeignId($foreignId);
        $obj->setName($tag);
        $obj->save();
      }
    }
  }
  
  public function getTags($foreignId, $foreignTable)
  {
    return $this->createQuery()->where("foreign_id=?", $foreignId)->addWhere("foreign_table=?", $foreignTable)->execute();
  }
  
  public function getTagsString($foreignId, $foreignTable, $sep=",")
  {
    $tags = array();
    foreach($this->getTags($foreignId, $foreignTable) as $t)
    {
      $tags[] = $t->getName();
    }
    return implode($sep, $tags);
  }
  
  public function getTagRank($size, $page=1)
  {
    $query = $this->createRankQuery('t');
    return $this->generateCloud($query, $size, $page);
  }

  public function getTagRankMember($memberId, $size, $page=1)
  {
    $query = $this->createRankQuery('t')->addWhere('t.member_id = ?', $memberId);
    return $this->generateCloud($query, $size, $page);
  }

  private function createRankQuery($name = 't')
  {
    return $this->createQuery($name)->select($name.'.name, count('.$name.'.id) as cnt')->groupBy($name.'.name')->orderBy("cnt DESC");
  }
  
  private function generateCloud($query, $size, $page = 1)
  {
    $query->limit($size)->offset($size*($page-1));
    
    $ranks = array();
    $i = 0;
    foreach($query->execute() as $obj)
    {
      if($i<=5)
      {
        $ranks[] = array("tag"=>$obj->getName(), "level"=>1);
      }
      elseif($i<=10)
      {
        $ranks[] = array("tag"=>$obj->getName(), "level"=>2);
      }
      else
      {
        $ranks[] = array("tag"=>$obj->getName(), "level"=>3);
      }
      
      $obj->free(true);
      unset($obj);
            
      $i++;
    }
    shuffle($ranks);
    
    
    return $ranks;
  }
  
  public function getPager($tag, $foreignTable, $memberId, $size, $page=1)
  {
    $q = $this->createQuery("t")->select("t.*")->where("t.name=?", $tag)->orderBy("t.updated_at DESC")->addFrom($foreignTable." f")->addWhere("f.id = t.foreign_id AND t.foreign_table = ?", $foreignTable);
    
    switch($foreignTable)
    {
      case "Diary":
        if($memberId>0)
        {
          $q->addWhere("f.public_flag = ? OR f.public_flag = ?", array(DiaryTable::PUBLIC_FLAG_OPEN, DiaryTable::PUBLIC_FLAG_SNS));
        }
        else
        {
          $q->addWhere("f.public_flag = ?", DiaryTable::PUBLIC_FLAG_OPEN);
        }
        break;
      case "CommunityTopic":
      case "CommunityEvent":
        $communityQuery = Doctrine::getTable("CommunityConfig")->createQuery("cc")->select("cc.community_id")->where("cc.name = 'public_flag'");
        if($memberId>0)
        {
          $communityQuery->addWhere("cc.value != 'auth_commu_member'");
        }
        else
        {
          //!!attention!! will be active only after community's open to web launched.
          $communityQuery->addWhere("cc.value = 'open'");
        }
        $communityIdList = array();
        foreach($communityQuery->execute() as $communityConfig)
        {
          $communityIdList[] = $communityConfig->getCommunityId();
        }
        if(count($communityIdList)>0)
        {
          $q->andWhereIn("f.community_id", $communityIdList);
        }
        else
        {
          //if no community matches the public_flag, no contents to get
          $q->addWhere("f.community_id = 0");
        }
        break;
    }
    
    
    $pager = new sfDoctrinePager("Tag", $size);
    $pager->setQuery($q);
    $pager->setPage($page);
    $pager->init();
    
    return $pager;
  }
}
