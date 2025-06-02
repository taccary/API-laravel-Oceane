<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bateau
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $photo
 * @property string|null $description
 * @property float|null $longueur
 * @property float|null $largeur
 * @property float|null $vitesse_croisiere
 * @property int $niveauPMR
 * 
 * @property NiveauAccessibilite $niveau_accessibilite
 * @property Collection|Secteur[] $secteurs
 * @property Collection|ContenanceBateau[] $contenance_bateaus
 * @property Collection|Traversee[] $traversees
 *
 * @package App\Models
 */
class Bateau extends Model
{
	protected $table = 'bateau';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'longueur' => 'float',
		'largeur' => 'float',
		'vitesse_croisiere' => 'float',
		'niveauPMR' => 'int'
	];

	protected $fillable = [
		'nom',
		'photo',
		'description',
		'longueur',
		'largeur',
		'vitesse_croisiere',
		'niveauPMR'
	];

	public function niveau_accessibilite()
	{
		return $this->belongsTo(NiveauAccessibilite::class, 'niveauPMR');
	}

	public function secteurs()
	{
		return $this->belongsToMany(Secteur::class, 'bateau_secteur', 'idBateau', 'idSecteur');
	}

	public function contenance_bateaus()
	{
		return $this->hasMany(ContenanceBateau::class, 'idBateau');
	}

	public function traversees()
	{
		return $this->hasMany(Traversee::class, 'idBateau');
	}
}
