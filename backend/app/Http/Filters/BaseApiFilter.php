<?php

namespace App\Http\Filters;

use App\Http\Requests\BaseApiFormRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;

abstract class BaseApiFilter
{
    protected $queryParams;
    protected ?Builder $builder;

    //bu pastdagi paginatsiya uchun
    // protected bool $pagination = false;
    // protected int $defaultSize = 20;

    public function __construct(protected readonly Request $request)
    {
        if ($this->request instanceof BaseApiFormRequest) {
            $this->queryParams = $this->request->validated();
        } else {
            $this->queryParams = array_filter(
                array_map('trim', $this->request->all())
            );
        }

    }

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->queryParams as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
                // call_user_func([$this, $method], $value, $builder);
            }
        }

        $filterClass = static::class;
        $reflectionClass = new ReflectionClass($filterClass);
        if ($reflectionClass->getMethod('defaultOrder')->class === $filterClass) {
            $this->defaultOrder();
        }
        // if ($reflectionClass->getMethod('applyWith')->class === $filterClass) {
        //     $this->applyWith();
        // }

        //paginatsiyani chaqrish
        // if ($this->pagination) {
        //     return $this->paginate();
        // }

        return $this->builder;
    }

    //paginatsiyani ham filterni ichida chaqirish uchun
    // public function paginate(): LengthAwarePaginator
    // {
    //     return $this->builder->paginate(
    //         perPage: $this->request->integer('per_page', $this->defaultSize),
    //         page: $this->request->integer('page', 1)
    //     );
    // }

    abstract function defaultOrder();
    // abstract function applyWith();


}
