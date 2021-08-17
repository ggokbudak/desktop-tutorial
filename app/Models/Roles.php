<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 03 May 2017 02:18:00 +0000.
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class SetHacim
 *
 * @property int $id
 * @property string $name
 * @property float $litre
 *
 * @property \Illuminate\Database\Eloquent\Collection $envanter_genels
 *
 * @package App\Models
 */
class Roles extends Model
{
	protected $table = 'roles';
	public $timestamps = false;



	protected $fillable = [
		'title',
        'permissions'
	];

}
