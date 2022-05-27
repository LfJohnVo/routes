<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resultado
 *
 * @property int $id
 * @property string|null $calle
 * @property string|null $conductor
 * @property string|null $ss
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Resultado extends Model
{
	protected $table = 'resultados';

	protected $fillable = [
		'calle',
		'conductor',
		'ss'
	];
}
