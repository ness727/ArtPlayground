<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'title',
		'img',
		'start_date',
		'end_date',
		'description',
		'price'
	];
}
