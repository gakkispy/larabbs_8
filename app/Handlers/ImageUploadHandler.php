<?php

namespace App\Handlers;

use Image;


class ImageUploadHandler
{
    //  只允许指定后缀名的图片文件上传
    protected $allowed_ext = ["pnh", "jpg", "gif", "jpeg"];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 构建存储的文件夹规则，得到的值将会是： uploads/images/avatars/201808/21/此类
        // 文件夹的分类能够提高查找的效率
        $folder_name = "uploads/images/$folder/" . date('Ym/d', time());

        // 文件存储的物理路径， public_path 获取 的是 public 文件夹的物理路径
        // 结果将会是: /home/vagrant/Code/larabbs/public/uploads/.../21
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里粘贴时后缀名为空，这一步可以确保后缀名不缺失
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        // 拼接文件名，加前缀以增加辨析度，前缀可以是相关数据模型的 ID
        // 值如: 1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10);

        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到目标存储路径
        $file->move($upload_path, $filename);

        // 如果限制了图片大小,需要进行裁剪
        if ($max_width && $extension !='gif') {
            
            // 此类中封装的函数,用于裁剪图片
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$filename",
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 先实例化,传参是文件的物理路径
        $image = Image::make($file_path);

        // 进行大小调整
        $image->resize($max_width, null, function ($constraint) {

            // 设定宽度是 $max_width, 高度等比例双方缩放
            $constraint->aspectRatio();

            // 放置裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 保存
        $image->save();
    }
}