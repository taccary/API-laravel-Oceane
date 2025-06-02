<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Secteur
 * 
 * @property int $id
 * @property string $nom
 * @property string $photo
 * @property string $description
 * @property string|null $url
 * 
 * @property Collection|Bateau[] $bateaus
 * @property Collection|Liaison[] $liaisons
 *
 * @package App\Models
 */
class Secteur extends Model
{
	protected $table = 'secteur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nom',
		'photo',
		'description',
		'url'
	];

	public function bateaus()
	{
		return $this->belongsToMany(Bateau::class, 'bateau_secteur', 'idSecteur', 'idBateau');
	}

	public function liaisons()
	{
		return $this->hasMany(Liaison::class, 'codeSecteur');
	}
}
