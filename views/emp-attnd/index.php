<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpAttndSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emp Attnds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emp-attnd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Emp Attnd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'emp_id',
            'date',
            'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
