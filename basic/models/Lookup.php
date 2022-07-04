<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_lookup".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $code
 * @property string|null $type
 * @property string|null $position
 * @var $model = new \app\models\Lookup;
 */
class Lookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_lookup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'code'], 'integer'],
            [['name', 'type', 'position'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }

    private static array $_items;

    public static function items($type): array
    {
        if(!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return self::$_items[$type];
    }

    public static function item($type, $code): bool
    {
        if(!isset(self::$_items[$type])) {
            self::loadItems($type);
        }
        return self::$_items[$type][$code] ?? false;
    }

    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = Lookup::find()->where('type=:type')->params([':type'=>$type])->orderBy('position')->all();

        /** @var Lookup $model */
        foreach($models as $model) {
            self::$_items[$type][$model->code] = $model->name;
        }
    }
}
