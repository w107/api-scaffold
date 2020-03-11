<?php

namespace Dyg0924\ApiScaffold\Traits;

trait EnumTrait
{
    /**
     * 获取字段的描述语
     * @param $field
     * @return string
     */
    public static function getDescription($field)
    {
        $attr = self::getStaticProperties($field);
        $arr = [];
        foreach ($attr as $key => $value) {
            $arr[] = "{$key}：{$value}";
        }

        return implode('，', $arr);
    }

    public static function __callStatic($name, $arguments)
    {
        $arr = self::getStaticProperties($name);
        $index = $arguments[0];
        $default = $arguments[1] ?? '未知';

        return $arr[$index] ?? $default;
    }

    protected static function getStaticProperties($name)
    {
        $reflect = new \ReflectionClass(new self());
        return $reflect->getStaticProperties()[$name];
    }

}
