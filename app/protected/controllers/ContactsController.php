<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 29.04.15
 * Time: 16:26
 */

/**
 * Contacts Controller
 * Class ContactsController
 */
class ContactsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Check access
     * @return array
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('create','destroy','update'),
                'roles'=>array('ADMIN'),
            ),
            array('allow',
                'actions'=>array('items'),
                'roles'=>array('USER'),
            ),
            array('deny',
                'actions'=>array('create','destroy','update','items'),
                'roles'=>array('GUEST'),
            ),
        );
    }
    /**
     * Return list of contacts
     */
    public function actionItems()
    {
        $criteria = new CDbCriteria;

        $request = Yii::app()->request;

        if ( $id = $request->getParam('id') ) {
            $criteria->compare('t.id', $id);
        }

        if ( $query = $request->getParam('query') ) {
            $criteria->addSearchCondition('CONCAT(t.firstname, \' \',t.lastname)', $query , true, 'OR');
            $criteria->addSearchCondition('CONCAT(t.lastname, \' \',t.firstname)', $query , true, 'OR');
            $criteria->addSearchCondition('t.phone', $query , true, 'OR');
        }

        $model = Contact::model();
        $count = $model->count($criteria);


        if ( $limit = $request->getParam('limit', 20) ) {
            $criteria->limit = $limit;
        }

        if ( $offset = $request->getParam('start', 0) ) {
            $criteria->offset = $offset;
        }

        $items = $model->findAll($criteria);


        $this->items($items, $count);
    }

    /**
     * Create new contact
     */
    public function actionCreate()
    {
        $params = $this->parseJSONRequest();

        unset($params['id']);

        $model = new Contact();
        $model->date_added = date('Y-m-d H:i:s');
        $model->setAttributes($params,false);


        $r = $model->save(true);
        $this->result($r, $params);
    }

    /**
     * Update exists contact
     */
    public function actionUpdate()
    {
        $params = $this->parseJSONRequest();


        $model = Contact::model()->findByPk($params['id']);
        $model->setAttributes($params,false);

        $r = $model->save(true);
        $this->result($r, $params);
    }

    /**
     * Destroy contact
     */
    public function actionDestroy()
    {

        var_dump( Yii::app()->user->checkAccess('USER') );
        $params = $this->parseJSONRequest();

        if ( empty($params['id']) ) {
            $this->failure();
        }

        $model = Contact::model();
        $model->deleteByPk($params['id']);

        $this->success();
    }
}