<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EmpAttnd */

$this->title = 'Create Emp Attnd';
$this->params['breadcrumbs'][] = ['label' => 'Emp Attnds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emp-attnd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
