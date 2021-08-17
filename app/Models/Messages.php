<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 23 Jul 2017 13:16:10 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Messages extends Model
{
	protected $table = 'mesagges';
	public $timestamps = false;

	protected $casts = [
        

	];

	protected $fillable = [
		'name',
	
        'aciklama',
      	'email',
     
	
		'user_id',
	

  
	];

    
}
