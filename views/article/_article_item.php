<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** @var $model \app\models\Article  */
?>


<div>
    <a href="<?php echo \yii\helpers\Url::to(['article/view', 'slug'=> $model->slug]) ?>">
    <h3><?php echo \yii\helpers\Html::encode($model->title)  ?></h3>
    </a>
    <div>
        <?php echo yii\helpers\StringHelper::truncateWords($model->getEncodedBody(), 40)  ?>
    </div>

    <p class="text-muted text-right" >
        <small>Created At: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at);  ?></b>
            By: <b><?php echo $model->createdBy->username; ?></b>
        </small>
    </p>
                <hr>
</div>
