<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeBillet
 * 
 * @property string $idCategorie
 * @property int $idTypeBillet
 * @property string $libelleTypeBillet
 * 
 * @property Categorie $categorie
 * @property Collection|DetailReservation[] $detail_reservations
 * @property Collection|Tarification[] $tarifications
 *
 * @package App\Models
 */
class TypeBillet extends Model
{
	protected $table = 'type_billet';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTypeBillet' => 'int'
	];

	protected $fillable = [
		'libelleTypeBillet'
	];

	public function categorie()
	{
		return $this->belongsTo(Categorie::class, 'idCategorie');
	}

	public function detail_reservations()
	{
		return $this->hasMany(DetailReservation::class, 'numType');
	}

	public function tarifications()
	{
		return $this->hasMany(Tarification::class, 'idTypeBillet');
	}
}
