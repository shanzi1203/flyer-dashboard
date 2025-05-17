<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "flyers".
 *
 * @property int $id
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 * @property string|null $image_path
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property FlyerActions[] $flyerActions
 * @property FlyerLocation[] $flyerLocations
 * @property FlyerProduct[] $flyerProducts
 */
class Flyers extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_EXPIRED = 0;
    
    public $locationIds = [];
    public $productIds = [];
    public $uploadFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flyers';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'), // for DATETIME columns
            ],
            BlameableBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_path', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['title', 'start_date', 'end_date'], 'required'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by','page_count'], 'integer'],
            [['title', 'image_path'], 'string', 'max' => 255],
            [['uploadFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, pdf'],
            ['end_date', 'compare', 'compareAttribute' => 'start_date', 'operator' => '>=', 'type' => 'date', 'message' => 'End Date must be equal to or after Start Date.'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'image_path' => 'Image Path',
            'page_count'=>'Page Count',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[FlyerActions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlyerActions()
    {
        return $this->hasMany(FlyerActions::class, ['flyer_id' => 'id']);
    }

    /**
     * Gets query for [[FlyerLocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlyerLocations()
    {
        return $this->hasMany(FlyerLocation::class, ['flyer_id' => 'id']);
    }

    /**
     * Gets query for [[FlyerProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlyerProducts()
    {
        return $this->hasMany(FlyerProduct::class, ['flyer_id' => 'id']);
    }
    public function getProductCount()
    {
        return $this->getFlyerProducts()->count();
    }
    public static function getStatusList()
    {
        return array(self::STATUS_ACTIVE => 'Active', self::STATUS_EXPIRED => 'Expired');
    }
    public function getStatusText()
    {
    $list=self::getStatusList();
    return $list[$this->status] ?? 'Unknown';
    }
    public function getLocations()
    {
        return $this->hasMany(\common\models\Locations::class, ['id' => 'location_id'])
            ->viaTable('flyer_location', ['flyer_id' => 'id']);
    }
    public function getProducts()
    {
        return $this->hasMany(\common\models\Products::class, ['id' => 'product_id'])
            ->viaTable('flyer_product', ['flyer_id' => 'id']);
    }
    public function getImageUrl()
    {
        return Yii::getAlias('@uploadUrl') . '/' . basename($this->image_path);
    }
   
}
