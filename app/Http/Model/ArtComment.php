<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Model\ArtComment
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $art_id
 * @property string|null $comment
 * @property int $order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Http\Model\Art $art
 * @property-read \App\Http\Model\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereArtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|ArtComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ArtComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ArtComment withoutTrashed()
 */
class ArtComment extends Model
{
    //
    protected  $table = 'arts_comments';
    protected $fillable = ['user_id','comment','art_id'];

    //开启软删除 deleted_at
    use SoftDeletes;

    public function art(){
        return $this->belongsTo(Art::class,'art_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
