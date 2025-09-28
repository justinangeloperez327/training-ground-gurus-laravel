<x-layout>
    <div class="px-4 mx-2">
        <div class="flex mb-2 justify-between">
            <div>
                <h2 class="text-2xl font-semibold">Add New Warehouse</h2>
            </div>
            <div>
                <a href="/warehouses" class="btn btn-dash sm">
                    Back to Warehouses
                </a>
            </div>
        </div>
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="mt-1 text-lg font-bold mb-6">
                    Warehouse Form
                </h1>
                <form action="/warehouses" method="POST">
                    @csrf
                    <label class="floating-label mb-6">
                        <input type="text" placeholder="Name"
                            class="input input-md @error('name') input-error @enderror" name="name" />
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
                        <input type="text" placeholder="Location"
                            class="input input-md @error('location') input-error @enderror" name="location" />
                        <span>Location</span>
                    </label>
                    @error('location')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">
                                {{ $message }}
                            </span>
                        </div>
                    @enderror

                    <div class="divider">

                    </div>
                    <button type="submit" class="btn btn-primary btn-dash">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
