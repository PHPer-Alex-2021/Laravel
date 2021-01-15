<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Model\Art
 *
 * @property int $id
 * @property int $user_id
 * @property int $order
 * @property string $title
 * @property int $status
 * @property string|null $content
 * @property string $comment
 * @property int $click
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ArtComment[] $artComments
 * @property-read int|null $art_comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Model\ArtImg[] $artImgs
 * @property-read int|null $art_imgs_count
 * @property-read \App\Http\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Art newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Art newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Art query()
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereClick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Art onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Art withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Art withoutTrashed()
 */
class Art extends Model
{
    //
    protected  $table = 'arts';

    protected $fillable = ['title','content'];

    //开启软删除 deleted_at
    use SoftDeletes;
    //关联查询
//    protected  $with = ['user'];

    //批量赋值取消
//    protected  $guarded = [];

    //批量赋值取消时间字段
//    public $timestamps = false;

    //该作品归属
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    //该作品有所有图片
    public function artImgs(){
        return $this->hasMany(ArtImg::class,'art_id');
    }

    //该作品有所有评论
    public function artComments(){
        return $this->hasMany(ArtComment::class,'art_id');
    }
}
