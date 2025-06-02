<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailReservation
 * 
 * @property int $numReservation
 * @property int $numType
 * @property string $lettreCategorie
 * @property int $quantité
 * 
 * @property Reservation $reservation
 * @property TypeBillet $type_billet
 *
 * @package App\Models
 */
class DetailReservation extends Model
{
	protected $table = 'detail_reservation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'numReservation' => 'int',
		'numType' => 'int',
		'quantité' => 'int'
	];

	protected $fillable = [
		'quantité'
	];

	public function reservation()
	{
		return $this->belongsTo(Reservation::class, 'numReservation');
	}

	public function type_billet()
	{
		return $this->belongsTo(TypeBillet::class, 'numType')
					->where('type_billet.idTypeBillet', '=', 'detail_reservation.numType')
					->where('type_billet.idCategorie', '=', 'detail_reservation.lettreCategorie');
	}
}
