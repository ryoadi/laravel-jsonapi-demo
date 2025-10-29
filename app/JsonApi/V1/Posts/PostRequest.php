<?php

namespace App\JsonApi\V1\Posts;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class PostRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        $uniqueSlugRule = Rule::unique('posts', 'slug');
        if ($this->isUpdating()) {
            $uniqueSlugRule->ignore($this->model());
        }

        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'publishedAt' => ['nullable', JsonApiRule::dateTime()],
            'slug' => ['required', 'string', $uniqueSlugRule],
            'tags' => [JsonApiRule::toMany()],
        ];
    }

}
