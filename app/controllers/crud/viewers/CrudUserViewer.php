<?php
namespace controllers\crud\viewers;

use Ubiquity\controllers\crud\viewers\ModelViewer;
 /**
  * Class CrudUserViewer
  */
class CrudUserViewer extends ModelViewer{
    public function getCaptions($captions, $className)
    {
        $dt= parent::getCaptions($captions, $className);

        return $dt;
    }

    public function getModelDataTable($instances, $model, $totalCount, $page = 1)
    {
        $dt = parent::getModelDataTable($instances, $model, $totalCount, $page);
        $dt->fieldAsLabel('firstname','users');
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
        return parent::getModelDataElement($instance, $model, $modal); // TODO: Change the autogenerated stub
    }

    public function getElementCaptions($captions, $className, $instance)
    {
        return parent::getElementCaptions($captions, $className, $instance); // TODO: Change the autogenerated stub
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
