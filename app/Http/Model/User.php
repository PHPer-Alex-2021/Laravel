<?php

namespace App\Http\Model;

use App\Http\Model\Blog;
use App\Http\Model\Art;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Http\Model
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $is_admin
 * @property string $email_token
 * @property int $email_active
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Art[] $arts
 * @property-read int|null $arts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Blog[] $blogs
 * @property-read int|null $blogs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $followering
 * @property-read int|null $followering_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $followers
 * @property-read int|null $followers_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','password'
    ];

    //当前用户发表的所有博客
    public function blogs(){
        return $this->hasMany(Blog::class,'user_id');
    }
    //当前用户发表的所有作品
    public function arts(){
        return $this->hasMany(Art::class,'user_id');
    }

    //获取所有粉丝（被关注者是主角） 查看被关注者的粉丝
    public function followers(){
        return $this->belongsToMany(User::class,'follows','user_id','follower');
    }

    //获取所有关注 （关注者是主角） 查看当前用户的关注
    public function followering(){
        return $this->belongsToMany(User::class,'follows','follower','user_id');
    }

    //检测用户是否关注  指定用户是否关注爱豆成为粉丝
    public function isFollow($uid)
    {
        return $this->followers()->where('follower',$uid)->first();
    }

    //关注和取消关注  当前用户对爱豆关注和取消关注
    public function followToggle($ids)
    {
        $ids=is_array($ids) ?: [$ids];
        return $this->followers()->withTimestamps()->toggle($ids);
    }

}
