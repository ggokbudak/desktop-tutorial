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
class Permissions extends Model
{
	protected $table = 'permissions';
	public $timestamps = false;

	protected $casts = [
        'level' => 'boolean',
        'parentId' => 'int',
	];

	protected $fillable = [
		'name',
        'level',
        'parentId',
	];
    public function parent()
	{
		return $this->belongsTo(Permissions::class, 'parentId');
	}
}
