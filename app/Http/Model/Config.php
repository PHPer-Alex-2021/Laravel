<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Http\Model\Config
 *
 * @property int $id
 * @property string $conf_title
 * @property string $conf_name
 * @property string $conf_type
 * @property string $conf_content
 * @property string $conf_order
 * @property string $conf_tips
 * @property string $conf_values
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfTips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereConfValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Config extends Authenticatable
{
    //
    protected $fillable = [
        'conf_title','conf_name',
        'conf_type','conf_content',
        'conf_order','conf_tips','conf_values'
    ];
}
