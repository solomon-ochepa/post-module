<x-app-layout>
    <div class="row layout-top-spacing">
        <h2 class="mb-4 border-bottom">{{ $title }}</h2>

        <x-alert />

        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post[user_id]" value="{{ $user->id }}">

            <div class="row mb-4 gy-3">
                <div class="col-md-9">
                    <div class="row mb-4 gy-3">
                        <div class="col-col-12">
                            <input type="text" class="form-control" name="post[title]" placeholder="Title"
                                required />
                            @error('post.title')
                                <div class="text-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <textarea rows="6" class="form-control" name="post[body]" placeholder=""></textarea>
                            @error('post.body')
                                <div class="text-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 gy-3">
                        <div class="col-md-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" class="form-control" name="images" />
                            @error('images')
                                <div class="text-danger form-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3">
                    <section class="mt-0">
                        <h6 class="border-bottom fw-bold">Categories</h6>
                        @forelse ($categories ?? [] as $category)
                            <label for="{{ $category->slug }}" class="d-block">
                                <input type="checkbox" name="categories" id="{{ $category->slug }}" />
                                {{ $category->name }}
                            </label>
                        @empty
                            <p class="text-center py-3">No category found</p>
                        @endforelse
                    </section>

                    <label for="allow_comments" class="d-block">
                        <input type="checkbox" name="post[allow_comments]" id="allow_comments" /> Allow comments
                    </label>
                </div>
            </div>

            <input type="submit" class="mb-4 btn btn-primary">
        </form>
    </div>
</x-app-layout>
