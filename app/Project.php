<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Project
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Monitor[] $monitors
 * @property-read \App\User $user
 */
class Project extends Model
{
	protected $fillable = ['title','user_id'];

    /**
     * 项目所属的用户
     */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	/**
     * 项目里的监控
	 */
	public function monitors()
	{
		return $this->hasMany('App\Monitor');
	}
}
