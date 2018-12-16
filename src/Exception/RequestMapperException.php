<?php
declare(strict_types = 1);

namespace Maksi\LaravelRequestMapper\Exception;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * TODO: rename me
 *
 * Class RequestMapperAbstractException
 *
 * @package Maksi\RequestMapperL\Exception
 */
class RequestMapperException extends AbstractException
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $result = [];

        /** @var ConstraintViolation $value */
        foreach ($this->constraintViolationList ?? [] as $value) {
            // TODO: Add tests for this lines (inside loop)
            $localResult = [];
            $localResult['message'] = $value->getMessage();
            $localResult['property'] = $value->getPropertyPath();
            $localResult['given'] = $value->getInvalidValue();

            $result[] = $localResult;
        }

        return JsonResponse::create(['errors' => $result])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
