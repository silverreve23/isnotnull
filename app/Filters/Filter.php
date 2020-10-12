<?php

namespace App\Filters;
use App\Models\User;
use Illuminate\Http\Request;

abstract class Filter {
    protected $request = null;
    protected $builder = null;
    protected $filters = [];

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function apply($builder){
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value){
            if(!$this->hasFilter($filter)) continue;

            $this->$filter($value);
        }

        return $this->builder;
    }

    private function getFilters(){
        return array_filter($this->request->only($this->filters));
    }

    private function hasFilter($filter){
        return (
            method_exists($this, $filter)
            && $this->request->has($filter)
        );
    }
}
