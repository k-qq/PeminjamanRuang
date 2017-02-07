<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruang".
 *
 * @property string $id
 * @property string $nama
 * @property integer $kapasitas
 *
 * @property Pesanan[] $pesanans
 */
class Ruang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'kapasitas'], 'required'],
            [['kapasitas'], 'integer'],
            [['id'], 'string', 'max' => 8],
            [['nama'], 'string', 'max' => 32],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'kapasitas' => 'Kapasitas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesanans()
    {
        return $this->hasMany(Pesanan::className(), ['id_ruang' => 'id']);
    }
}
