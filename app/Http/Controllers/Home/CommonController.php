<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Art;
use App\Http\Model\ArtImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use zgldh\QiniuStorage\QiniuStorage;

class CommonController extends Controller
{
    /**
     * 文件上传
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadArtPic(Request $request)
    {
        //
        $file = $request->file('photo');
        // 验证
        $check = $this->checkFile($file);
        if (!$check['status']) {
            return response()->json(['ServerNo' => '400', 'ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path('uploads/arts');
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        $fileName = md5(time().rand(0, 10000)).'.'.$postfix;
        // 移动
        if (!$file->move($path, $fileName)) {
            return response()->json(['ServerNo' => '400', 'ResultData' => '文件保存失败']);
        }
        // 这里处理 数据库逻辑

        /**
         *Store::uploadFile(['fileName'=>$fileName]);
         **/
        return response()->json(['ServerNo' => '200', 'ResultData' => $fileName]);
    }

    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }
        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }

        return ['status' => true];
    }

    public function UploadAction(Request $request)
    {
        // 判断是否有文件上传
        if ($request->hasFile('file')) {
            // 获取文件,file对应的是前端表单上传input的name
            $file = $request->file('file');
            // 初始化
            $disk = QiniuStorage::disk('qiniu');
            // 重命名文件
            $fileName = md5($file->getClientOriginalName().time().rand()).'.'.$file->getClientOriginalExtension();
            // 上传到七牛
            $bool = $disk->put('iwanli/image_'.$fileName,file_get_contents($file->getRealPath()));
            // 判断是否上传成功
            if ($bool) {
                $path = $disk->downloadUrl('iwanli/image_'.$fileName);
                return '上传成功，图片url:'.$path;
            }
            return '上传失败';
        }
        return '没有文件';
    }
}
?>
