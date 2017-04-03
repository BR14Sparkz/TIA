<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;
    // if you dont use the same name of the table (plural - articles - article)  
    // then you will have to call it using this:
    // protected $table = 'the_name_of_the_table';

	protected $fillable = [
		'user_id', 'title', 'image', 'content', 'live', 'post_on'
	];   

	protected $dates = ['post_on', 'deleted_at'];
	
	/* this is a mutator that will grab the value being saved and covert it to a boolean*/
	public function setLiveAttribute($value)
	{
		$this->attributes['live'] = (boolean)($value);
	}

	public function getShortContentAttribute()
	{
		return substr($this->content, 0, random_int(60, 150)) . '...';
	}

	public function setPostOnAttribute($value)
	{
		$this->attributes['post_on'] = Carbon::parse($value);
	}
}
