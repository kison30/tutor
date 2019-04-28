<?php
/**
 * Created by PhpStorm.
 * User: Kison
 * Date: 2018/11/20
 * Time: 11:50
 */
namespace App\Helpers\Validations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
class CustomValidation extends Validator
{
    /**
     * @param $attributes
     * @param $value
     * @param $parameters
     * @return mixed
     * @author Kison
     * 校验密码
     */
    public function validateCheckPassword($attributes, $value, $parameters)
    {
        $user = User::find($parameters[0]);
        return Hash::check($value,$user->password);
    }

    /**
     * @param $attributes
     * @param $value
     * @param $parameters
     * @return bool
     * @author Kison
     * 判断用户名是否存在
     */
    public function validateExistUserName($attributes, $value, $parameters)
    {
        if (preg_match("/^1[34578]\d{9}$/", $value)) {
            $query = User::where('telephone', $value);
        } else {
            $query = User::where('name',$value);
        }
        $count = $query->count();
        return $count >= 1;
    }

    /**
     * @param $attributes
     * @param $value
     * @param $parameters
     * @return bool
     * @author Kison
     * 判断手机是不是唯一的
     */
    public function validateUniqueTelephone($attributes, $value, $parameters)
    {
        $count = User::where('telephone', $value)
            ->where('area_code',$parameters[0])
            ->count();
        return $count === 0;
    }

    /**
     * @param $attributes
     * @param $value
     * @param $parameters
     * @return bool
     * @author Kison
     * 判断手机是否存在
     */
    public function validateExistTelephone($attributes, $value, $parameters)
    {
        $count = User::where('telephone', $value)
            ->where('area_code',$parameters[0])
            ->count();
        return $count >= 1;
    }
}