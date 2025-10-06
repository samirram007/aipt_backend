<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
trait HasPolymorphicResourceB
{
    protected array $resource = [];

    protected function resolveResource($data)
    {
        if (is_null($data))
            return null;

        if ($data instanceof \Illuminate\Support\Collection) {
            return $data->map(fn($item) => $this->resolveResource($item));
        }

        if ($data instanceof \Illuminate\Database\Eloquent\Model) {
            $this->loadResourceRelations($data);

            $modelClass = get_class($data);
            $resourceClass = str_replace(
                '\\Models\\',
                '\\Resources\\',
                $modelClass
            ) . 'Resource';

            return class_exists($resourceClass)
                ? new $resourceClass($data)
                : $data;
        }

        return $data;
    }

    protected function loadResourceRelations($model): void
    {
        if (empty($this->resource)) {
            return;
        }

        $with = [];

        foreach ($this->resource as $key => $value) {
            // If array key is numeric, it's a simple relation string
            if (is_int($key)) {
                $with[] = $value;
            }
            // If key is relation and value is closure, keep as key => fn
            elseif ($value instanceof \Closure) {
                $with[$key] = $value;
            }
        }

        $model->loadMissing($with);
    }
}
// trait HasPolymorphicResource
// {
//     protected array $resourceRelations = [];

//     public function loadResourceRelations(Model $model): void
//     {
//         if (!empty($this->resourceRelations)) {
//             $model->loadMissing($this->resourceRelations);
//         }
//     }

//     protected function resolveResource($data)
//     {
//         if (is_null($data))
//             return null;

//         if ($data instanceof \Illuminate\Support\Collection) {
//             return $data->map(fn($item) => $this->resolveResource($item));
//         }

//         if ($data instanceof \Illuminate\Database\Eloquent\Model) {
//             $this->loadResourceRelations($data);

//             $modelClass = get_class($data);
//             $resourceClass = str_replace('\\Models\\', '\\Resources\\', $modelClass) . 'Resource';

//             return class_exists($resourceClass)
//                 ? new $resourceClass($data)
//                 : $data;
//         }

//         return $data;
//     }
//     protected function resolveResourceC($data)
//     {
//         // Handle null case
//         if (is_null($data)) {
//             return null;
//         }

//         // Handle Eloquent Collection or array of models
//         if ($data instanceof Collection || is_array($data)) {
//             return $data->map(fn($item) => $this->resolveResource($item));
//         }

//         // Handle single Eloquent Model
//         if ($data instanceof Model) {
//             $modelClass = get_class($data);

//             // Example: App\Modules\Supplier\Models\Supplier
//             // Convert to: App\Modules\Supplier\Resources\SupplierResource
//             $resourceClass = str_replace('\\Models\\', '\\Resources\\', $modelClass) . 'Resource';

//             if (class_exists($resourceClass)) {
//                 $resource = new $resourceClass($data);

//                 // Recursively resolve nested loaded relations if needed
//                 foreach ($data->getRelations() as $relation => $related) {
//                     $resource->{$relation} = $this->resolveResource($related);
//                 }

//                 return $resource;
//             }

//             return $data; // fallback if no resource exists
//         }

//         // For anything else (e.g., primitives)
//         return $data;
//     }



//     // protected function resolveResource($model)
//     // {
//     //     if (!$model) {
//     //         return null;
//     //     }

//     //     $modelClass = get_class($model);
//     //     // Example: App\Modules\Supplier\Models\Supplier

//     //     // Convert Models → Resources
//     //     $resourceClass = str_replace('\\Models\\', '\\Resources\\', $modelClass) . 'Resource';
//     //     // dump($resourceClass);
//     //     // Result: App\Modules\Supplier\Resources\SupplierResource

//     //     if (class_exists($resourceClass)) {
//     //         return new $resourceClass($model);
//     //     }

//     //     // Fallback to returning the model as-is
//     //     return $model;
//     // }
// }
