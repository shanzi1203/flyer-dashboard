<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "flyer_actions".
 *
 * @property int $id
 * @property int $flyer_id
 * @property int $user_id
 * @property string $action_type
 * @property string $action_time
 *
 * @property Flyers $flyer
 * @property User $user
 */
class FlyerActions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flyer_actions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flyer_id', 'user_id', 'action_type'], 'required'],
            [['flyer_id', 'user_id'], 'integer'],
            [['action_time'], 'safe'],
            [['action_type'], 'string', 'max' => 50],
            [['flyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flyers::class, 'targetAttribute' => ['flyer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flyer_id' => 'Flyer ID',
            'user_id' => 'User ID',
            'action_type' => 'Action Type',
            'action_time' => 'Action Time',
        ];
    }

    /**
     * Gets query for [[Flyer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlyer()
    {
        return $this->hasOne(Flyers::class, ['id' => 'flyer_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
