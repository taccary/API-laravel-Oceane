<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Liaison
 * 
 * @property int $code
 * @property int $codeSecteur
 * @property float $distance
 * @property string $portDepart
 * @property string $portArrivee
 * 
 * @property Secteur $secteur
 * @property Port $port
 * @property Collection|Traversee[] $traversees
 *
 * @package App\Models
 */
class Liaison extends Model
{
	protected $table = 'liaison';
	protected $primaryKey = 'code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'code' => 'int',
		'codeSecteur' => 'int',
		'distance' => 'float'
	];

	protected $fillable = [
		'codeSecteur',
		'distance',
		'portDepart',
		'portArrivee'
	];

	public function secteur()
	{
		return $this->belongsTo(Secteur::class, 'codeSecteur');
	}

	public function port()
	{
		return $this->belongsTo(Port::class, 'portDepart');
	}

	public function traversees()
	{
		return $this->hasMany(Traversee::class, 'codeLiaison');
	}
}
