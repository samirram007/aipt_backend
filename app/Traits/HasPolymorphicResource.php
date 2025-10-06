<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

trait HasPolymorphicResource
{
    /**
     * Resolve a model or collection into its corresponding Resource
     *
     * @param Model|Collection|null $model
     * @return JsonResource|Collection|null
     */
    protected function resolveResource($model)
    {
        if (is_null($model)) {
            return null;
        }

        if ($model instanceof Collection || $model instanceof \Illuminate\Database\Eloquent\Collection) {
            return $model->map(fn($item) => $this->resolveResource($item));
        }

        if (!$model instanceof Model) {
            return $model;
        }

        $resourceClass = $this->getResourceClass(get_class($model));

        if (class_exists($resourceClass) && is_subclass_of($resourceClass, JsonResource::class)) {
            return new $resourceClass($model);
        }

        return $model;
    }

    /**
     * Generate the fully qualified resource class name from a model class
     *
     * @param string $modelClass Fully qualified model class name
     * @return string Fully qualified resource class name
     */
    protected function getResourceClass(string $modelClass): string
    {
        return str_replace(
            ['\\Models\\', 'App\\Modules\\'],
            ['\\Resources\\', 'App\\Modules\\'],
            $modelClass
        ) . 'Resource';
    }

    /**
     * Recursively resolve all loaded relations in a model
     *
     * @param Model $model
     * @param array<string|array<string,callable>> $relationsToWrap Relations to process
     * @return JsonResource|Model
     */
    protected function resolveRelations(Model $model, array $relationsToWrap = []): JsonResource|Model
    {
        foreach ($relationsToWrap as $key => $closureOrRelation) {
            if (is_int($key)) {
                // Handle simple relation string (e.g., 'ledgerable.address.state')
                $nested = explode('.', $closureOrRelation);
                $this->wrapNestedRelations($model, $nested);
            } elseif (is_string($key) && is_callable($closureOrRelation)) {
                // Handle relation with closure
                if ($model->relationLoaded($key)) {
                    $related = $model->{$key};
                    $resolved = $closureOrRelation($this->resolveResource($related));
                    $model->setRelation($key, $resolved);
                }
            }
        }

        return $this->resolveResource($model);
    }

    /**
     * Recursively wrap nested relations
     *
     * @param Model $model
     * @param array<string> $nested Array of relation segments
     * @return void
     */
    protected function wrapNestedRelations(Model $model, array $nested): void
    {
        if (empty($nested)) {
            return;
        }

        $relation = array_shift($nested);

        if (!$model->relationLoaded($relation)) {
            return;
        }

        $related = $model->{$relation};
        $resolved = $this->resolveResource($related);

        if (!empty($nested) && $resolved instanceof Model) {
            $this->wrapNestedRelations($resolved, $nested);
        }

        $model->setRelation($relation, $resolved);
    }
}
