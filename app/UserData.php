<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
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
