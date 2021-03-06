<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    /**
     * 上传到本地
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function webuploader(Request $request)
    {
        // 判断是否有文件上传成功
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // 有文件上传
            $filename = sha1(time() . $request->file('file')->getClientOriginalName()) . '.' .
                $request->file('file')->getClientOriginalExtension();
            Storage::disk('public')->put($filename, file_get_contents($request->file('file')->path()));
            // 返回数据
            $request = [
                'errCode' => '0',
                'errMsg' => '',
                'successMsg' => '文件上传成功',
                'path' => '/storage/' . $filename,
            ];
        } else {
            // 没有文件上传
            $request = [
                'errCode' => "0001",
                'errMsg' => $request->file('file')->getErrorMessage(),
            ];
        }
        return response()->json($request);
    }

    /**
     * 上传到七牛云存储空间
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function qiniu(Request $request)
    {
        // 判断是否有文件上传成功
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // 有文件上传
            $filename = sha1(time() . $request->file('file')->getClientOriginalName()) . '.' .
                $request->file('file')->getClientOriginalExtension();
            $disk = Storage::disk('qiniu');
            $disk->put($filename, file_get_contents($request->file('file')->path()));
            // 返回数据
            $request = [
                'errCode' => '0',
                'errMsg' => '',
                'successMsg' => '文件上传成功',
                'path' => $disk->getDriver()->downloadUrl($filename),
            ];
        } else {
            // 没有文件上传
            $request = [
                'errCode' => "0001",
                'errMsg' => $request->file('file')->getErrorMessage(),
            ];
        }
        return response()->json($request);
    }
}
