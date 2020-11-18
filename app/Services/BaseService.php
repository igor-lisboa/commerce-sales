<?php

namespace App\Services;

class BaseService
{
    // the model that will be used to make the operations
    private $model;


    public function __construct($model)
    {
        $this->setmodel($model);
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index($perPage = 5, $pageName = "page", $page = 1)
    {
        return $this->model->orderBy('id','desc')->paginate($perPage, ['*'], $pageName, $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $attributes
     * @return model $model
     */
    public function store($attributes)
    {
        return $this->model::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @return model
     */
    public function show()
    {
        return $this->model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $attributes
     * @return model
     */
    public function update($attributes)
    {
        return $this->model->update($attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return model
     */
    public function destroy()
    {
        return $this->model->delete();
    }
}
