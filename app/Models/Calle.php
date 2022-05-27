<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Calle
 *
 * @property int $id
 * @property string $street
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Calle extends Model
{
	use SoftDeletes;
	protected $table = 'calle';
	public $timestamps = false;

	protected $fillable = [
		'street'
	];
}
