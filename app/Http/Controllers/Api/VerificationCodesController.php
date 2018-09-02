<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Support\Facades\Cache;


class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        $captchaData = Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->response->error('图片验证码已失效',422);
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清楚缓存
            Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('验证码错误');
        }

        $phone = $request->phone;

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补 0
            $code = str_pad(\random_int(1,9999), 4, 0, STR_PAD_LEFT);
    
            try {
                $result = $easySms->send($phone, [
                    'content' => "您的验证码是{$code}。如非本人操作，请忽略本短信"
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableExcet4ption $exception) {
                $message = $exception->getException('qcloud')->getMessage();
                return $this->response->errorInternal($message ?? '短信发送异常');
            }            
        }    
            $key = 'verificationCode_' . str_random(15);
            $expiredAt = now()->addMinutes(10);
    
            // 缓存验证码 10 分钟 过期。
            Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

            // 清除图片验证码缓存
            Cache::forget($request->captcha_key);
    
            return $this->response->array([
                'key' => $key,
                'expired_at' => $expiredAt->toDateTimeString(),
            ])->setStatusCode(201);
        
        
    }
}