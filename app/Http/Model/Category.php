<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Http\Model\Category
 *
 * @property int $id
 * @property string $cate_name
 * @property string $cate_title
 * @property string $cate_keywords
 * @property string $cate_description
 * @property int $cate_view
 * @property int $cate_order
 * @property int $cate_pid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCatePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCateView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Authenticatable
{
    //
    protected $fillable = [
        'cate_name','cate_title',
        'cate_keywords','cate_descript'
    ];

    protected $guarded = [

    ];

    protected $hidden = [

    ];
    //获取树形分类 多级分类
    public static function getTree($data,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr=[];
        foreach($data as $k=>$v){
            if($v[$field_pid] == $pid){//获取顶级分类
                $data[$k]['_cate_name']=$data[$k]['cate_title'];
                $arr[] = $data[$k];
                foreach($data as $m=>$n){
                    if($n[$field_pid] == $v[$field_id]){
                        $data[$m]['_cate_name']='|---'.$data[$m]['cate_title'];
                        $arr[]=$data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
