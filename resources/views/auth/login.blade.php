<x-auth-layout>
    <div class="card w-96 bg-base-300">
        <div class="card-body">
            <h1 class="mt-1 text-xl font-bold text-center mb-5">
                Welcome Back
            </h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Email" class="input input-md" name="email"
                        @error('email') input-error @enderror value="{{ old('email') }}" />
                    <span>Email</span>
                </label>
                @error('email')
                    <div class="label -mt-4 mb-2">
                        <span class="label-text-alt text-error">
                            {{ $message }}
                        </span>
                    </div>
                @enderror
                <label class="floating-label mb-6">
                    <input type="password" placeholder="Password" class="input input-md" name="password"
                        @error('password') input-error @enderror />
                    <span>Password</span>
                </label>
                @error('password')
                    <div class="label -mt-4 mb-2">
                        <span class="label-text-alt text-error">
                            {{ $message }}
                        </span>
                    </div>
                @enderror
                <div class="divider"></div>
                <button type="submit" class="btn btn-primary btn-sm w-full">
                    Sign in
                </button>
            </form>
        </div>
    </div>
</x-auth-layout>
