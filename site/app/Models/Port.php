<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Port
 * 
 * @property string $nom_court
 * @property string $nom
 * @property string $description
 * @property string $adresse
 * @property string|null $photo
 * @property string|null $camera
 * 
 * @property Collection|Liaison[] $liaisons
 *
 * @package App\Models
 */
class Port extends Model
{
	protected $table = 'port';
	protected $primaryKey = 'nom_court';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nom',
		'description',
		'adresse',
		'photo',
		'camera'
	];

	public function liaisons()
	{
		return $this->hasMany(Liaison::class, 'portDepart');
	}
}
