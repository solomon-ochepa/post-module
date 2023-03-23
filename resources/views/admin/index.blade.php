<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="row layout-top-spacing">
        <x-alert />

        <div class="table-responsive">
            <table class="table table-hover _table-striped _table-bordered">
                <thead>
                    <tr>
                        {{-- <th class="checkbox-area" scope="col">
                            <div class="form-check form-check-primary">
                                <input class="form-check-input" id="custom_mixed_parent_all" type="checkbox">
                            </div>
                        </th> --}}
                        <th scope="col" class="w-50">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Tags</th>
                        <th class="text-center" scope="col">Date</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts ?? [] as $post)
                        <tr>
                            {{-- <td>
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input custom_mixed_child" type="checkbox">
                                </div>
                            </td> --}}
                            <td>
                                <div class="media">
                                    {{-- <div class="avatar me-2">
                                        @if ($post->hasMedia(['image']))
                                            <img alt="avatar" src="{{ $post->media('image')->first()->getUrl() }}"
                                                class="rounded-circle" />
                                        @else
                                            <i class="fa fa-home rounded-circle"></i>
                                        @endif
                                    </div> --}}

                                    <div class="media-body align-self-center">
                                        <h6 class="mb-0">{{ $post->title }}</h6>
                                        {{-- <span>shaun.park@mail.com</span> --}}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0">{{ $post->author->name }}</p>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light-{{ $post->status->color }}">
                                    {{ $post->categories->implode('name', ', ') ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light-{{ $post->status->color }}">
                                    {{ $post->tags->implode('name', ', ') ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <p class="mb-0">{{ $post->created_at->format('D, M d, Y') }}</p>
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="action-btns">
                                    <a href="{{ route('admin.post.edit', $post->id) }}"
                                        class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                        data-placement="top" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit-2">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>

                                    <form class="d-inline" method="POST"
                                        action="{{ route('admin.post.destroy', $post->id) }}">
                                        @method('delete')
                                        @csrf

                                        <button type="submit"
                                            class="btn btn-sm bg-transparent px-2 action-btn btn-delete bs-tooltip"
                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                            {{-- <i class="fas fa-trash text-danger"></i> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if (!$posts->count())
                <p class="text-center py-4">
                    No record found.
                </p>
            @endif
        </div>
    </div>
</x-app-layout>
