<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function __construct(#[CurrentUser()] protected User $user)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @param  array{
     *     title?: string,
     *     description?: string|null,
     *     status?: string,
     *     links?: array<int, string>,
     *     steps?: array<int, string>,
     *     image?: \Illuminate\Http\UploadedFile|null,
     * }  $attributes
     */
    public function handle(array $attributes)
    {

        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links',
        ])->toArray();

        $data['links'] = array_values(array_filter(
            $data['links'] ?? [],
            static fn (string $link): bool => filled($link)
        ));

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($data, $attributes) {
            $idea = $this->user->ideas()->create($data);

            $steps = collect($attributes['steps'] ?? [])
                ->filter(static fn (string $step): bool => filled($step))
                ->map(static fn (string $step): array => ['description' => $step])
                ->values()
                ->all();

            if ($steps !== []) {
                $idea->steps()->createMany($steps);
            }

            // return $idea;
        });

    }
}
