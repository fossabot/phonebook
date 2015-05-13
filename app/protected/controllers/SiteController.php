<?php

class SiteController extends Controller
{
    public function beforeAction($action) {
        if ( $action->getId() == 'login' ) {
            return true;
        }
        if ( Yii::app()->user->isGuest ) {
            if (Yii::app()->request->isAjaxRequest) {
                echo 'auth error';
            }
            $this->redirect('/site/login');
            Yii::app()->end();
        }
        return true;
    }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
       $this->pageTitle = 'Телефонный справочник';
       $this->render('index');
	}

    public function actionError()
    {
        //$this->redirect('/');
        //exit;
        $error = Yii::app()->errorHandler->error;
        $this->render('error',
            array(
                'code' => $error['code'],
                'message' => $error['message']
            )
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model=new User();

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->layout = 'login';
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}