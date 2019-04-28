<?php
/**
 * Created by PhpStorm.
 * User: Kison
 * Date: 2018/11/15 0015
 * Time: 下午 10:23
 */
namespace App\Helpers\Api;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return int
     * @author Kison
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     * @author Kison
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     * @author Kison
     */
    public function response($data,$header = [])
    {
        return Response::json($data,$this->getStatusCode(),$header);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     * @author Kison
     */
    public function status($status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status'  => $this->statusCode,
            'message' => $status

        ];

        $data = array_merge($status,$data);

        return $this->response($data);
    }

    /**
     * @param $message
     * @param int $code
     * @param string $status
     * @return mixed
     * @author Kison
     */
    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST,$status ='error')
    {
        return $this->setStatusCode($code)->message($message,$status);
    }

    /**
     * @param $message
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     * @author Kison
     */
    public function message($message, $status = 'success')
    {
        return $this->status($status,[
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     * @author Kison
     */
    public function internalError($message = 'Internal Error')
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     * @author Kison
     */
    public function created($message = 'created')
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)->message($message);
    }

    /**
     * @param $data
     * @param string $status
     * @return mixed
     * @author Kison
     */
    public function success($data = [], $status = 'success')
    {
        return $this->status($status,compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     * @author Kison
     */
    public function notFound($message = 'Not Found')
    {
        return $this->failed($message,FoundationResponse::HTTP_NOT_FOUND);
    }

}