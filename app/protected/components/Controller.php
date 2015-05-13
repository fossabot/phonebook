<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    /**
     * Returns items of store
     * @param $items
     * @param $count
     */
    protected function items($items, $count) {
        $this->renderJSON(array(
            'records' => $items,
            'total' => $count
        ));
    }

    protected function result($r, $params = array(), $message = '')
    {
        $r ? $this->success($params, $message)
           : $this->failure($params, $message);
    }

    /**
     * Return fail of request
     */
    protected function success($params = array(), $message = '') {
        $this->renderJSON(array(
            'success' => true,
            'message' => $message,
            'params' => $params
        ));
    }

    /**
     * Return fail of request
     */
    protected function failure($params = array(), $message = '') {
        $this->renderJSON(array(
            'success' => false,
            'message' => $message,
            'params' => $params
        ));
    }

    /**
     * Parses JSON request
     * @return mixed
     */
    protected function parseJSONRequest()
    {
        $request = Yii::app()->request;

        if ( ! ($body = $request->getRawBody()) ) {
            $this->failure();
        }

        $params = json_decode($body, true);
        return $params;
    }

    /**
     * Return data to browser as JSON and end application.
     * @param array $data
     */
    protected function renderJSON($data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        foreach (Yii::app()->log->routes as $route) {
            if($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
        Yii::app()->end();
    }

    protected function isAdmin() {
        return Yii::app()->user->group == 'ADMIN';
    }
}