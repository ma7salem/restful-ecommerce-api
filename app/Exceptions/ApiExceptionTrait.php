<?php
namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ApiExceptionTrait {

	public function apiException($request, $exception)
	{
		if($this->isModel($exception)) {

			return $this->ModelResponse($exception);

		}elseif ($this->isHttp($exception)) {

			return $this->HttpResponse($exception);

		}elseif ($this->isMethodNotAllowed($exception)) {

			return $this->MethodNotAllowedResponse($exception);

		}else{
			return $this->otherExceptionResponse($exception);
		}

		return $this->giveResponse(404, ['Error Found.']);
	}

	protected function isModel($e)
	{
		return $e instanceof ModelNotFoundException;
	}
	protected function isHttp($e)
	{
		return $e instanceof NotFoundHttpException; 
	}

	protected function isMethodNotAllowed($e)
	{
		return $e instanceof MethodNotAllowedHttpException;
	}

	protected function ModelResponse($e)
	{
		return $this->giveResponse(404, ['Data Not Found.']);
	}
	protected function HttpResponse($e)
	{
		return $this->giveResponse(404, ['Page Not Found.']);
	}

	protected function MethodNotAllowedResponse($e)
	{
		return $this->giveResponse(405, ['Not Valid Request.']);
	}

	public function otherExceptionResponse($e)
	{
		if($e->getMessage() != null){
			return $this->giveResponse(404, [$e->getMessage()]);
		}
		return $this->giveResponse(404, ['Ops, there is an error.']);
	}

	protected function giveResponse($statusNumber = 404, $errors = [], $status = 'fail')
	{
		return response()->json(
			[
			'status' => $status,
			'errors' => $errors,
			]
			, $statusNumber);
	}
}