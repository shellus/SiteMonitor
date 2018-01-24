<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 储存用户热数据，就是经常修改的。用来冷热数据垂直分表
 * App\UserData
 *
 * @property int $user_id
 * @property int|null $project_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserData whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserData whereUserId($value)
 * @mixin \Eloquent
 */
class UserData extends Model
{
    protected $primaryKey = 'user_id';
    //
}
