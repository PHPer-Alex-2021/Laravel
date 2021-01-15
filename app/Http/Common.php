<?php

namespace App\Http;

class Common
{
    /**
     * 根据key删除数组中指定元素
     *
     * @param  array  $arr  数组
     * @param  string/int  $key  键（key）
     * @return array
     */
    public function array_remove_by_key($arr, $key)
    {
        if(!array_key_exists($key, $arr)){
            return $arr;
        }
        $keys = array_keys($arr);
        $index = array_search($key, $keys);
        if($index !== FALSE){
            array_splice($arr, $index, 1);
        }
        return $arr;
    }

    /**
     * 图片上传
     *
     * @param  array  $file  可能是数组
     * @return array
     */
    public function upload($file)
    {
        if(!is_array($file)){
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                if(!in_array($ext,['jpg','jpeg','gif','png']) ) return false;
                // 上传文件
                $filename = date('YmdHis').'-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称

                //把临时文件移动到指定的位置，并重命名
                $path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'artsImg'.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

                $bool =  $file->move($path,$filename);
//                dd($filename);
                if($bool){
                    $data['imgs_path'][]=date('Y').'/'.date('m').'/'.date('d').'/'.$filename;
                }else{
                    return false;
                }
            }
        }else {
            $imgs = [];
            foreach ($file as $files) {
                if ($files->isValid()) {
                    // 获取文件相关信息
                    $originalName = $files->getClientOriginalName(); // 文件原名
                    $ext = $files->getClientOriginalExtension();     // 扩展名
                    $realPath = $files->getRealPath();   //临时文件的绝对路径
                    $type = $files->getClientMimeType();     // image/jpeg

                    if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
                        return false;
                    }

                    // 上传文件
                    $file_name = date('YmdHis').'-'.uniqid().'.'.$ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    //这里的uploads是配置文件的名称

                    //把临时文件移动到指定的位置，并重命名
                    $path = public_path(
                        ).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'artsImg'.DIRECTORY_SEPARATOR.date(
                            'Y'
                        ).DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d');
                    $bool = $files->move($path, $file_name);
                    if ($bool) {
                        $data['imgs_path'][]=date('Y').'/'.date('m').'/'.date('d').'/'.$file_name;
                    } else {
                        return false;
                    }
                }
            }

        }
    }

    /**
     * 删除指定的文件
     *
     * @param  array   $file      可能是数组
     * @param  string  $filedir   文件所在目录
     * @param  string  $field     字段
     * @param  string  $type      文件类型
     *
     * @return string
     */
    public function removeFile($file,$filedir,$field,$type='img')
    {
        if(!is_array($file)){
            //file文件路径
            $filename = $filedir.$file[$field];
            //删除
            if (file_exists($filename)) {
                $data['status']=1;
                $data['info'] = '原图片删除成功';
                if ($type != 'img') {
                    $data['info'] = '原文件删除成功';
                }
                unlink($filename);
            } else {
                $data['status']=0;
                $data['info'] = '原图片未找到:'.$filename;
                if($type!='img'){
                    $data['info'] = '原文件未找到:'.$filename;
                }
            }
            return $data;
        }else{
            //如果文件是数组
            foreach ($file as $val) {
                //file文件路径
                $filename = $filedir.$val[$field];

                //删除
                if (file_exists($filename)) {
                    continue;
                } else {
                    $data['status']=0;
                    $data['info'] = '原图片未找到:'.$filename;
                    if($type!='img'){
                        $data['info'] = '原文件未找到:'.$filename;
                    }
                    return $data;
                }
            }

            foreach ($file as $va) {
                $filename = $filedir.$va[$field];
                $data['status']=1;
                $data['info'] = '原图片删除成功';
                if ($type != 'img') {
                    $data['info'] = '原文件删除成功';
                }
                unlink($filename);
            }
            return $data;
        }
    }

}
