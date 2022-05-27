<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Conductore
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Conductore extends Model
{
	use SoftDeletes;
	protected $table = 'conductores';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];
}
