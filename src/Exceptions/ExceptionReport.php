<?php

namespace Dyg0924\ApiScaffold\Exceptions;

use Dyg0924\ApiScaffold\Helpers\ApiResponse;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class ExceptionReport
{
    use ApiResponse;

    /**
     * @var Throwable
     */
    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Throwable $exception
     */
    function __construct(Request $request, Throwable $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
        $this->doReport = array_merge($this->doReport, config('apiscaffold.exceptions'));
    }

    /**
     * @var array
     */
    //当抛出这些异常时，可以使用我们定义的错误信息与HTTP状态码
    //可以把常见异常放在这里
    public $doReport = [
        ValidationException::class => []
    ];

    public function register($className, callable $callback)
    {
        $this->doReport[$className] = $callback;
    }

    /**
     * @return bool
     */
    public function shouldReturn()
    {
        foreach (array_keys($this->doReport) as $report) {
            if ($this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }

        return false;

    }

    /**
     * @param Throwable $e
     * @return static
     */
    public static function make(Throwable $e)
    {
        return new static(\request(), $e);
    }

    /**
     * @return mixed
     */
    public function report()
    {
        if ($this->exception instanceof ValidationException) {
            $error = Arr::first($this->exception->errors());
            return $this->failed(Arr::first($error), $this->exception->status);
        }
        $message = $this->doReport[$this->report];
        return $this->failed($message[0], $message[1]);
    }

    public function prodReport()
    {
        return $this->failed('服务器错误', '500');
    }
}
