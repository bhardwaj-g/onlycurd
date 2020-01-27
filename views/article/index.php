<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \app\models\Article  */


$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns'=> [
                ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'body',
                'value' => function ($dataProvider) {
                    $url = $dataProvider->body;
                    return \yii\helpers\BaseStringHelper::truncateWords($url,30,null,true);
                },
            ],
            [
                 'attribute'=> 'created_at',
                 'value'=> function($model){
                    $url= $model->created_at;
                    return Yii::$app->formatter->asRelativeTime($url);
                 }
            ],
            [
                'attribute'=> 'status',
                'value'=> function($model){
                    $val = $model->status;
                    if($val == 1){
                        return 'active';
                    }elseif($val == 0){
                        return 'deactive';
                    }
                }
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'headerOptions' => ['width' => '80'],
            'template' => '{view} {update} {delete}{link}',
            'buttons' => [
                'view'=> function ($url, $model) {
                    $url = \yii\helpers\Url::to(['/article/view', 'slug' => $model->slug]);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'view'),
                    ]);
                },
                'update'=> function ($url, $model) {
                    $url = \yii\helpers\Url::to(['/article/update', 'slug' => $model->slug]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'update'),
                    ]);
                },
                'delete'=> function ($url, $model) {
                    $url = \yii\helpers\Url::to(['/article/delete', 'slug' => $model->slug]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'delete'),
                    ]);
                },
            ]
        ],
            ]

        /*'itemOptions' => ['class' => 'item'],
        'itemView' => '_article_item'*/
        
    ]) ?>


</div>
