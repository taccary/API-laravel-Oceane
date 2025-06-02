<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 * 
 * @property int $num
 * @property string $nom
 * @property string $adr
 * @property string $cp
 * @property string $ville
 * @property int $numTraversee
 * 
 * @property Traversee $traversee
 * @property Collection|DetailReservation[] $detail_reservations
 *
 * @package App\Models
 */
class Reservation extends Model
{
	protected $table = 'reservation';
	protected $primaryKey = 'num';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'num' => 'int',
		'numTraversee' => 'int'
	];

	protected $fillable = [
		'nom',
		'adr',
		'cp',
		'ville',
		'numTraversee'
	];

	public function traversee()
	{
		return $this->belongsTo(Traversee::class, 'numTraversee');
	}

	public function detail_reservations()
	{
		return $this->hasMany(DetailReservation::class, 'numReservation');
	}
}
