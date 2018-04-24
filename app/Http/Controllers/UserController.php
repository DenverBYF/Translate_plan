<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Qiniu\Storage\UploadManager;

class UserController extends Controller
{
    //
	public function index()
	{

	}


	public function show($id)
	{
		$user = Auth::user();
		return view('index.person', compact('user'));
	}

	public function edit($id)
	{
		$user = Auth::user();
		return view('index.edit', compact('user'));
	}

	public function update($id, UserRequest $request)
	{
		$user = Auth::user();
		if ($request->hasFile('img')) {
			if ($request->file('img')->isValid()) {
				//判断文件合法性
				$img = $request->file('img');
				$type = $img->extension();
				$mimeType = $img->getMimeType();
				$typeArray = ['jpg', 'png', 'jpeg', 'gif'];
				$mimeArray = ['image/jpeg', 'image/gif', 'image/png'];
				if (in_array($type, $typeArray) and in_array($mimeType, $mimeArray)) {
					//七牛云上传文件
					$fileName = md5(uniqid().time()).".".$type;
					$filePath = $img->path();
					$this->resizeImage($filePath);
					$access_key = env('QINIU_ACCESS_KEY');
					$secret_key = env('QINIU_SECRET_KEY');
					$bucket = env('QINIU_BUCKET_NAME');
					$auth = new \Qiniu\Auth($access_key, $secret_key);
					$token = $auth->uploadToken($bucket);
					$uploadManager = new UploadManager();
					list($ret, $err) = $uploadManager->putFile($token, $fileName, $filePath);
					if (!empty($err)) {
						$errors = collect(['头像上传失败']);
						return view('index.edit', compact('errors', 'user'));
					} else {
						unlink($filePath);
						//获取url
						$url = 'http://'.env('QINIU_DOMAIN_NAME').$ret['key'];
					}
					return $this->updateUserInfo($user, $request, $url);
				} else {
					$errors = collect(['头像必须为图片类型']);
					return view('index.edit', compact('errors', 'user'));
				}
			} else {
				$errors = collect(['图片不可用']);
				return view('index.edit', compact('errors', 'user'));
			}
		} else {
			return $this->updateUserInfo($user, $request);
		}
	}

	//用户数据更新
	protected function updateUserInfo($user, $request, $url = null)
	{
		unset($request['img']);
		$data = empty($url)?$request->all():array_merge($request->all(), ['url' => $url]);
		$ret = $user->update($data);
		if ($ret) {
			return redirect()->route('person.show', $user->id)->with('success', "个人信息更新成功");
		}
	}

	//图片剪裁
	protected function resizeImage($filePath)
	{
		$image = Image::make($filePath);
		$image->resize(362, 362, function ($constraint) {
			// 防止裁图时图片尺寸变大
			$constraint->upsize();
		});
		// 对图片修改后进行保存
		$image->save();
	}
}
