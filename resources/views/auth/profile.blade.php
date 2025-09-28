<x-layout>
    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <div class="card w-96 shadow-xl rounded-xl   bg-base-300">
            <div class="card-body p-8">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Profile
                </h1>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="floating-label mb-6">
                        <input type="text" placeholder="Name" class="input input-md" name="name"
                            @error('name') input-error @enderror value="{{ old('name', Auth::user()->name) }}" />
                        <span>Name</span>
                    </label>
                    @error('name')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">
                                {{ $message }}
                            </span>
                        </div>
                    @enderror
                    <label class="floating-label mb-6">
                        <input type="text" placeholder="Email" class="input input-md" name="email"
                            @error('email') input-error @enderror" value="{{ old('email', Auth::user()->email) }}" />
                        <span>Email</span>
                    </label>
                    @error('email')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">
                                {{ $message }}
                            </span>
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-success btn-sm">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
        <div class="card w-96 shadow-xl rounded-xl   bg-base-300">
            <div class="card-body p-8">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Avatar
                </h1>
                @if (Auth::user()->image)
                    <div class="mb-4">
                        <img src="{{ Auth::user()->image->url() }}" alt="Avatar"
                            class="h-16 w-16 rounded-full object-cover">
                    </div>
                    <form action="{{ route('avatar.update', Auth::user()->image->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label class="floating-label mb-6">
                            <input type="file" placeholder="Avatar"
                                class="file-input w-full @error('avatar') file-input-error @enderror" name="avatar" />
                            <span>Avatar</span>
                        </label>
                        @error('avatar')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-success btn-sm">
                            Update Avatar
                        </button>
                    </form>
                @else
                    <form action="{{ route('avatar.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="floating-label mb-6">
                            <input type="file" placeholder="Avatar"
                                class="file-input w-full @error('avatar') file-input-error @enderror" name="avatar" />
                            <span>Avatar</span>
                        </label>
                        @error('avatar')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">
                                    {{ $message }}
                                </span>
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-success btn-sm">
                            Upload Avatar
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-layout>
