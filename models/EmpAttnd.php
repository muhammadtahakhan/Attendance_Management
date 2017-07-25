<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emp_attnd".
 *
 * @property integer $id
 * @property integer $emp_id
 * @property string $date
 * @property string $time
 */
class EmpAttnd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emp_attnd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_id', 'date', 'time'], 'required'],
            [['emp_id'], 'integer'],
            [['date', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'emp_id' => Yii::t('app', 'Emp ID'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
        ];
    }
}
