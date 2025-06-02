<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarification
 * 
 * @property string $idCategorie
 * @property int $idTypeBillet
 * @property string $idPeriode
 * @property float $tarif
 * 
 * @property TypeBillet $type_billet
 * @property Periode $periode
 *
 * @package App\Models
 */
class Tarification extends Model
{
	protected $table = 'tarification';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTypeBillet' => 'int',
		'tarif' => 'float'
	];

	protected $fillable = [
		'tarif'
	];

	public function type_billet()
	{
		return $this->belongsTo(TypeBillet::class, 'idTypeBillet')
					->where('type_billet.idTypeBillet', '=', 'tarification.idTypeBillet')
					->where('type_billet.idCategorie', '=', 'tarification.idCategorie');
	}

	public function periode()
	{
		return $this->belongsTo(Periode::class, 'idPeriode');
	}
}
