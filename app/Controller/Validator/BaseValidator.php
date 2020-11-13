<?php


declare(strict_types=1);

namespace App\Controller\Validator;

use App\Exception\NormalApiException;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * 更多内置规则参考：https://learnku.com/docs/laravel/6.x/validation/5144#available-validation-rules
 * accepted  yes、 on 或者是 1。这在验证是否同意"服务条款"的时候非常有用。
 * active_url URL 一个合法的 URL，根据 PHP 函数 checkdnsrr。
 * date 必须是一个合法的日期，根据 PHP 函数 strtotime
 * date_format:format 必须符合给定的 format 的格式，根据 PHP 函数 date_parse_from_format
 * after:date 在给定日期之后，该日期将被传递到 PHP 的 strtotime 函数
 * before:date 在给定日期之前，该日期将被传递到 PHP 的 strtotime 函数
 * alpha  全字母
 * alpha_dash 字母、数字、中划线或下划线字符
 * alpha_num 全部由字母和数字构成
 * between:min,max 给定的 min 和 max 之间。字符串、数字以及文件都将使用大小规则进行比较
 * confirmed 比如，需要验证此规则的字段是  password，那么在输入中必须有一个与之相同的 password_confirmation 字段
 * different:field 必须与指定的 field 字段的值不同
 * digits:value 必须是一个 数字 并且必须满足 value 设定的精确长度
 * digits_between:min,max 长度必须介于 min 和 max 之间
 * email 合法的电子邮件地址
 * mobile 合法的手机号码
 * code 手机短信验证码
 * exists:table,column,where 必须在指定的数据库的表中存在 (column、where可选) 例：'email' => 'exists:staff,email,account_id,1'
 * unique:table,column,except,idColumn 数据库的表中唯一 (except:强制忽略一个给定的 ID)
 * 例： 强制忽略一个给定的 ID ： 'email' => 'unique:users,email_address,10'
 *
 * image 必须是一个图片 (jpeg, png, bmp 或者 gif)
 * in:foo,bar,... 值必须在给定的列表中存在
 * not_in:foo,bar,... 值不在给定的列表中存在
 * integer 整数
 * ip 合法的 IP 地址
 * max:value 值必须小于最大值 value。字符串，数值，数组，文件大小的计算方式都与 size 规则一致。
 * min:value 值必须大于最小值 value。字符串，数值，数组，文件大小的计算方式都与 size 规则一致。
 * mimes:foo,bar,... 文件的 MIME 类型必须在给定的列表中。
 * numeric 数值、数值字符串
 * float 浮点数
 * regex:pattern 正则表达式
 * required 必须存在验证
 * required_if:field,value 如果 field 字段值等于 value ，那么该验证为必须值
 * required_with:foo,bar,... 仅当 其它指定的字段存在的时候，验证此规则的值必须存在。
 * required_without:foo,bar,... 仅当 其它指定的字段 ‘有一个’ 不存在的时候，验证此规则的值必须存在。
 * required_without_all:foo,bar,... 仅当 其它指定的字段 ‘都不存在’ 的时候，验证此规则的值必须存在。
 * same:field 验证此规则的值必须与给定的 field 字段的值相同。
 * size:value 对于字符串，value 代表字符的个数；对于数字，value 代表它的整数值，对于文件，value 以KB为单位
 * url 合法的 URL
 * gt:value 大于
 * gte:value 大于等于
 * lt:value 小于
 * lte:value 小于等于
 */
class BaseValidator
{
    protected static $extends = [];

    public static function getValidator(): ValidatorFactoryInterface
    {
        static $validator = null;
        if (is_null($validator)) {
            $container = ApplicationContext::getContainer();
            $validator = $container->get(ValidatorFactoryInterface::class);
            self::initExtends();
            self::registerExtends($validator, self::$extends);
        }

        return $validator;
    }

    protected static function initExtends()
    {
        // 更多自定义的扩展

    }

    protected static function registerExtends(ValidatorFactoryInterface $validator, array $extends)
    {

    }

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param bool $firstError
     * @return bool
     * @throws
     */
    public static function make(array $data, array $rules, array $messages = [], bool $firstError = true): bool
    {

        $validator = self::getValidator();
        if (empty($messages)) {
            $messages = self::messages();
        }
        $valid = $validator->make($data, $rules, $messages);
        if ($valid->fails()) {
            $errors = $valid->errors();
            $error = $firstError ? $errors->first() : $errors;
            throw new NormalApiException($error);
        }
        return true;
    }

    // 这个其实用处不大
    public static function messages(): array
    {
        return [];
    }
}