<?php
declare(strict_types = 1);

namespace Maksi\LaravelRequestMapper\MappingStrategies;

use Illuminate\Http\Request;
use Maksi\LaravelRequestMapper\RequestData\AllRequestData;
use Maksi\LaravelRequestMapper\RequestData\RequestData;

/**
 * Class AllStrategy
 *
 * @package Maksi\LaravelRequestMapper\MappingStrategies
 */
class AllStrategy implements StrategyInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * AllStrategy constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param RequestData $object
     *
     * @return array
     */
    public function resolve(RequestData $object): array
    {
        return $this->request->all();
    }

    /**
     * @param RequestData $object
     *
     * @return bool
     */
    public function support(RequestData $object): bool
    {
        return $object instanceof AllRequestData;
    }
}