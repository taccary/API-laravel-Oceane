<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NiveauAccessibilite
 * 
 * @property int $idNiveau
 * @property string $libelle
 * @property string $descriptionAccessibilite
 * 
 * @property Collection|Bateau[] $bateaus
 *
 * @package App\Models
 */
class NiveauAccessibilite extends Model
{
	protected $table = 'niveau_accessibilite';
	protected $primaryKey = 'idNiveau';
	public $timestamps = false;

	protected $fillable = [
		'libelle',
		'descriptionAccessibilite'
	];

	public function bateaus()
	{
		return $this->hasMany(Bateau::class, 'niveauPMR');
	}
}
