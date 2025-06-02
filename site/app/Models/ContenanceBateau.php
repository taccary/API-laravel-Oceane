<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContenanceBateau
 * 
 * @property int $idBateau
 * @property string $lettreCategorie
 * @property int $capaciteMax
 * 
 * @property Bateau $bateau
 * @property Categorie $categorie
 *
 * @package App\Models
 */
class ContenanceBateau extends Model
{
	protected $table = 'contenance_bateau';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idBateau' => 'int',
		'capaciteMax' => 'int'
	];

	protected $fillable = [
		'capaciteMax'
	];

	public function bateau()
	{
		return $this->belongsTo(Bateau::class, 'idBateau');
	}

	public function categorie()
	{
		return $this->belongsTo(Categorie::class, 'lettreCategorie');
	}
}
