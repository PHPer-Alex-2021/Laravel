<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Model\ArtImg
 *
 * @property int $id
 * @property int $art_id
 * @property int $order
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $img
 * @property-read \App\Http\Model\Art $art
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereArtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|ArtImg onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArtImg whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ArtImg withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ArtImg withoutTrashed()
 */
class ArtImg extends Model
{
    //
    protected  $table = 'arts_imgs';
    protected $fillable = ['img','art_id'];

    //开启软删除 deleted_at
    use SoftDeletes;

    //当前作品下有多少图片
    public function art(){
        return $this->belongsTo(Art::class,'art_id');
    }

}
