<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Periode
 * 
 * @property string $idPeriode
 * @property string $libellePeriode
 * @property string $descriptionPeriode
 * 
 * @property Collection|Tarification[] $tarifications
 * @property Collection|Traversee[] $traversees
 *
 * @package App\Models
 */
class Periode extends Model
{
	protected $table = 'periode';
	protected $primaryKey = 'idPeriode';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'libellePeriode',
		'descriptionPeriode'
	];

	public function tarifications()
	{
		return $this->hasMany(Tarification::class, 'idPeriode');
	}

	public function traversees()
	{
		return $this->hasMany(Traversee::class, 'idPeriode');
	}
}
