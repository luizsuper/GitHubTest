<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/26
 * Time: 11:00
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{

    private $msg;
    private $code;
    private $errorCode;
    public function render(\Exception $ex)
    {
        if($ex instanceof BaseException)
        {
            $this->msg = $ex->msg;
            $this->errorCode = $ex->errorCode;
            $this->code = $ex->code;
        }
        else
            {
                if(config('app_debug'))
                {
                    return parent::render($ex);
                }
                else
                    {
                        $this->code = 500;
                        $this->msg ='不想告诉你';
                        $this-> errorCode = 999;
                        $this->recordError($ex);
                    }

            }
        $request = Request::instance();

        $result = ['msg'=>$this->msg,'errorCode'=>$this->errorCode,'request_url'=>$request->url(),
                    'resultParm'=>$request->param()
        ];
        return json($result,$this->code);
    }
    public  function  recordError(\Exception $ex)
    {
        Log::init([
            'type'  => 'File',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error'],
        ]);
        Log::record($ex->getMessage(),'error');
    }


}