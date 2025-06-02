<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BateauSecteur
 * 
 * @property int $idBateau
 * @property int $idSecteur
 * 
 * @property Bateau $bateau
 * @property Secteur $secteur
 *
 * @package App\Models
 */
class BateauSecteur extends Model
{
	protected $table = 'bateau_secteur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idBateau' => 'int',
		'idSecteur' => 'int'
	];

	protected $fillable = [
		'idBateau',
		'idSecteur'
	];

	public function bateau()
	{
		return $this->belongsTo(Bateau::class, 'idBateau');
	}

	public function secteur()
	{
		return $this->belongsTo(Secteur::class, 'idSecteur');
	}
}
