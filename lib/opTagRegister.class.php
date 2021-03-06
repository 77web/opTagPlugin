<?php
/**
 * PluginTag
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    opTagPlugin
 * @subpackage lib
 * @author     Hiromi Hishida<info@77-web.com>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
class opTagRegister
{
  public static function listenToDiaryCreate($args)
  {
    $actionObj = $args['actionInstance'];
    $diaryForm = $actionObj->getVar("form");
    if($diaryForm && $diaryForm->getObject()->getId())
    {
      $form = new TagForm();
      $form->setForeignObj($diaryForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
  
  public static function listenToDiaryUpdate($args)
  {
    $actionObj = $args['actionInstance'];
    $diaryForm = $actionObj->getVar("form");
    if($diaryForm && $diaryForm->isValid())
    {
      $form = new TagForm();
      $form->setForeignObj($diaryForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
  
  public static function listenToEventCreate($args)
  {
    $actionObj = $args['actionInstance'];
    $eventForm = $actionObj->getVar("form");
    if($eventForm && $eventForm->getObject()->getId())
    {
      $form = new TagForm();
      $form->setForeignObj($eventForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
  
  public static function listenToEventUpdate($args)
  {
    $actionObj = $args['actionInstance'];
    $eventForm = $actionObj->getVar("form");
    if($eventForm && $eventForm->isValid())
    {
      $form = new TagForm();
      $form->setForeignObj($eventForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
  
  public static function listenToTopicCreate($args)
  {
    $actionObj = $args['actionInstance'];
    $topicForm = $actionObj->getVar("form");
    if($topicForm && $topicForm->getObject()->getId())
    {
      $form = new TagForm();
      $form->setForeignObj($topicForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
  
  public static function listenToTopicUpdate($args)
  {
    $actionObj = $args['actionInstance'];
    $topicForm = $actionObj->getVar("form");
    if($topicForm && $topicForm->isValid())
    {
      $form = new TagForm();
      $form->setForeignObj($topicForm->getObject());
      $form->bind($actionObj->getRequest()->getParameter("tag"));
      if($form->isValid())
      {
        $form->save();
      }
    }
  }
}