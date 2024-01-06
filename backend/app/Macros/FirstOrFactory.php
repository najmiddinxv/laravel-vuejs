<?php

use Illuminate\Database\{
    Eloquent\Builder as EloquentBuilder,
};

EloquentBuilder::macro('firstOrFactory', function (array $data = null) {
    return $this->firstOr(function () use ($data) {
        return $this->getModel()->factory()->create($data);
    });
});
