<?php
namespace controllers\crud\viewers;

use Ubiquity\controllers\crud\viewers\ModelViewer;
 /**
  * Class CrudGroupsViewer
  */
class CrudGroupsViewer extends ModelViewer{
    public function getCaptions($captions, $className)
    {
        $dt= parent::getCaptions($captions, $className);

        return $dt;
    }

    public function getModelDataTable($instances, $model, $totalCount, $page = 1)
    {
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt->fieldAsLabel('name','users');
        $dt->setValueFunction('groups',function($v){
            return count($v);
        });
        return dt;
    }

    public function recordsPerPage($model, $totalCount = 0)
    {
        return 10;
    }

    protected function getDataTableRowButtons()
    {
        return ['display','edit','delete'];
    }



//------------------------------------------------------------------------------------------------------------
    public function getModelDataElement($instance, $model, $modal)
    {
        return parent::getModelDataElement($instance, $model, $modal);
    }

    public function getElementCaptions($captions, $className, $instance)
    {
        return parent::getElementCaptions($captions, $className, $instance);
    }
    //------------------------------------------------------------------------------------------------------------
    public function isModal($objects, $model)
    {
    }

    public function getForm($identifier, $instance, $updateUrl = 'updateModel')
    {
    }

    public function getFormCaptions($captions, $className, $instance)
    {
    }
}
