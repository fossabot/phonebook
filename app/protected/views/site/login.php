<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle='Партнерская программа - Авторизация';
?>

<div class="b-plainpage">
    <div class="b-plainpage-h">
        <div class="b-card">
            <div class="b-card-h">
                <?/*<div class="b-card-item lang_en">
                    <div class="b-card-item-h">
                        <div class="b-card-switcher">
                            <div class="b-card-switcher-item"><span class="g-link g-pseudo" data-lang="ru"><span class="g-pseudo-h">РУС</span></span></div><div class="b-card-switcher-item state_active">ENG</div>
                        </div>
                        <a class="b-card-item-logo" href="http://www.sotmarket.com/" target="_blank">
                            <div class="b-card-item-logo-sign"></div>
                            www.sotmarket.com
                        </a>
                        <div class="b-card-item-body">
                            <div class="b-card-item-name">Ivan Chirkin</div>
                            <div class="b-card-item-position">CRM Lead Developer</div>
                            <div class="b-card-item-address">
                                Russia, Moscow, 7A/30 Staropetrovskij dr.<br>
                                office: +7 (495) 780 98 98, ext. 1763<br>
                                mobile: +7 (920) 812 24 89
                            </div>
                            <div class="b-card-item-footer">
                                <a href="mailto:chirkin.ivan@gmail.com">chirkin.ivan@gmail.com</a>, skype: <a href="skype:chirkin.ivan?chat">chirkin.ivan</a>
                                <div class="b-card-item-footer-social">
                                    <a href="http://ru.linkedin.com/in/ichirkin" target="_blank" class="g-ico mod_linkedin"><b>Linked</b><i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>*/?>
                <div class="b-card-item lang_ru">
                    <div class="b-card-item-h">
                        <div class="b-card-item-body">
                            <div class="b-card-item-name">Авторизация</div>
                            <div class="form">
                                <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'login-form',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array(
                                        'validateOnSubmit'=>true,
                                        'afterValidateAttribute'=>'js:function(form,data,hasError){
                                            if(!hasError){
                                                console.log(1);
                                            }
                                                console.log(2);
                                        }'
                                    ),
                                )); ?>

                                <div class="row">
                                    <?php echo $form->label($model,'username'); ?>
                                    <?php echo $form->textField($model,'username', array('placeholder' => 'Логин...')); ?>
                                    <?php echo $form->error($model,'phone'); ?>
                                </div>

                                <div class="row">
                                    <?php echo $form->label($model,'password'); ?>
                                    <?php echo $form->passwordField($model,'password', array('placeholder' => 'Пароль...')); ?>
                                    <?php echo $form->error($model,'password'); ?>
                                </div>

                                <div class="row buttons">
                                    <?php echo CHtml::submitButton('Войти'); ?>
                                </div>

                                <?php $this->endWidget(); ?>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>