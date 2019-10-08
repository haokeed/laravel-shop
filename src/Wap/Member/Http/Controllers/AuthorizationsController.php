<?php


namespace Haokeed\LaravelShop\Wap\Member\Http\Controllers;

use Haokeed\LaravelShop\Wap\Member\Facades\Member;
use Illuminate\Http\Request;
use Haokeed\LaravelShop\Wap\Member\Models\User;

class AuthorizationsController extends Controller
{
    public function wechatStore(Request $request)
    {
        // 获取微信的用户信息
        $wechatUser=session("wechat.oauth_user.default");

        $user=User::where("weixin_openid",$wechatUser->id)->first();

        if(!$user){
            // 不存在用户登录信息
            $user=User::create([
                "nickename"=>$wechatUser->name,
                "weixin_openid"=>$wechatUser->id,
                "image_head"=>$wechatUser->avatar
            ]);

            // 改变用户的状态设置为登录
            // auth

            Member::guard('member')->login($user);
            var_dump(Member::guard()->check());
            return "通过";

            return redirect()->route("wap.member.index");
        }

        return "测试";

        // 登录状态->改变
        // 迁移性问题



    }

}