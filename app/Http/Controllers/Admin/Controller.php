<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Api\ApiResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,ApiResponse;

    /**
     * Controller constructor.
     * @param Request $request
     * @throws \Exception
     * 构造函数 进行验证
     */
    public function __construct(Request $request)
    {
        $this->validateRequest($request);
    }

    /**
     * @param Request $request
     * @param null $name
     * @throws \Exception
     * @author Kison
     * 验证参数
     */
    protected function validateRequest(Request $request,$name = null)
    {
        if (!$validator = $this->getValidator($request,$name)) {
            return ;
        }
        $rules   = array_get($validator,'rules',[]);
        $message = array_get($validator,'message',[]);

        $result = validator($request->all(),$rules,$message);
        if ($result->fails()) {
            throw new \Exception($result->errors()->first(),403);
        }
    }

    /**
     * @param Request $request
     * @param null $name
     * @return bool|mixed
     * @author Kison
     * 调用validation校验
     */
    protected function getValidator(Request $request,$name = null)
    {
        list($controller,$method) = explode('@', $request->route()->action['uses']);

        $method = $name ?: $method;

        $class = str_replace('Controller','Validation',$controller);


        if (!class_exists($class) || !method_exists($class, $method)) {
            return false;
        }

        return call_user_func([new $class,$method]);
    }

}
