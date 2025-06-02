<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorie
 * 
 * @property string $idCategorie
 * @property string $libelleCategorie
 * 
 * @property Collection|ContenanceBateau[] $contenance_bateaus
 * @property Collection|TypeBillet[] $type_billets
 *
 * @package App\Models
 */
class Categorie extends Model
{
	protected $table = 'categorie';
	protected $primaryKey = 'idCategorie';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'libelleCategorie'
	];

	public function contenance_bateaus()
	{
		return $this->hasMany(ContenanceBateau::class, 'lettreCategorie');
	}

	public function type_billets()
	{
		return $this->hasMany(TypeBillet::class, 'idCategorie');
	}
}
