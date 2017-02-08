<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pesanan;

/**
 * PesananSearch represents the model behind the search form about `app\models\Pesanan`.
 */
class PesananSearch extends Pesanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sesi_waktu'], 'integer'],
            [['nim_mahasiswa', 'id_ruang', 'tanggal_penggunaan', 'no_surat', 'status', 'tanggal_pesan', 'tanggal_verifikasi'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pesanan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idRuang')
            ->joinWith('sesiWaktu');

        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_penggunaan' => $this->tanggal_penggunaan,
            'tanggal_pesan' => $this->tanggal_pesan,
            'tanggal_verifikasi' => $this->tanggal_verifikasi,
        ]);

        $query->andFilterWhere(['like', 'nim_mahasiswa', $this->nim_mahasiswa])
            ->andFilterWhere(['like', 'ruang.nama', $this->id_ruang])            
            ->andFilterWhere(['like', 'waktu.jam', $this->sesi_waktu])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
