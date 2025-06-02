<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Traversee
 * 
 * @property int $num
 * @property Carbon $date
 * @property Carbon $heure
 * @property int $codeLiaison
 * @property int $idBateau
 * @property bool $sans_vehicule
 * @property string $idPeriode
 * 
 * @property Liaison $liaison
 * @property Bateau $bateau
 * @property Periode $periode
 * @property Collection|Reservation[] $reservations
 *
 * @package App\Models
 */
class Traversee extends Model
{
	protected $table = 'traversee';
	protected $primaryKey = 'num';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'heure' => 'datetime',
		'codeLiaison' => 'int',
		'idBateau' => 'int',
		'sans_vehicule' => 'bool'
	];

	protected $fillable = [
		'date',
		'heure',
		'codeLiaison',
		'idBateau',
		'sans_vehicule',
		'idPeriode'
	];

	public function liaison()
	{
		return $this->belongsTo(Liaison::class, 'codeLiaison');
	}

	public function bateau()
	{
		return $this->belongsTo(Bateau::class, 'idBateau');
	}

	public function periode()
	{
		return $this->belongsTo(Periode::class, 'idPeriode');
	}

	public function reservations()
	{
		return $this->hasMany(Reservation::class, 'numTraversee');
	}
}
