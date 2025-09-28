<x-auth-layout>
    <div class="card w-96 bg-base-300">
        <div class="card-body">
            <h1 class="mt-1 text-xl font-bold text-center mb-5">
                Create Account
            </h1>
            <form action="">
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Name" class="input input-md" />
                    <span>Name</span>
                </label>
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Email" class="input input-md" />
                    <span>Email</span>
                </label>
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Password" class="input input-md" />
                    <span>Password</span>
                </label>
                <label class="floating-label mb-6">
                    <input type="text" placeholder="Password" class="input input-md" />
                    <span>Confirm Password</span>
                </label>
                <div class="divider"></div>
                <button type="submit" class="btn btn-primary btn-sm w-full">
                    Register
                </button>
            </form>
        </div>
    </div>
</x-auth-layout>
