<x-layout title="Signin">

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
      function onSubmit(token) {
        document.getElementById("form").submit();
      }
    </script>


    <section class="lg:min-h-screen min-h-screen lg:items-center flex  lg:justify-center dark:bg-darkbgprimary dark:text-white">
        <!-- FORM -->
        <div class="lg:w-1/2 lg:px-20 px-5 lg:mt-0 w-screen lg:px-10 pb-5">

        <!-- ERROR SIGN OUT -->
            @if (session('failed'))
                <div class="toast toast-start">
                    <div class="alert alert-error flex">
                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                      <span>{{ session('failed') }}</span>
                    </div>
                </div>
            @endif

            @if (session('success') or session('status'))
                <div class="toast toast-start">
                    <div class="alert alert-success flex">
                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                      <span>{{ session('success') ?? session('status') }}</span>
                    </div>
                </div>
            @endif

            <div class="mt-16 lg:mt-0">
                <h2 class="font-bold lg:text-2xl text-lg">Welcome Back</h2>
                <p class="text-gray text-base dark:text-slate-400">Please enter your details</p>
            </div>
            <form method="POST" action="/signin" class="mt-5" id="form">
                @csrf

                <!-- EMAIL -->
                <x-input type="email" class="mb-6" name="email" label="Email" placeholder="Enter your email">
                    <x-icons.envelope input />
                </x-input>

                <!-- PASSWORD -->
                <x-input type="password" class="mb-6" name="password" label="Password" placeholder="Enter your password">
                    <x-icons.lock-closed input />
                </x-input>

                <!-- REMEMBER ME & FORGOT PASSWORD -->
                <div class="flex justify-between items-start mb-8">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" value="" class="checkbox checkbox-primary checkbox-sm">
                        <label for="remember" class="ml-2 lg:text-m text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Remember me</label>
                    </div>
                    <div class="flex items-center">
                        <a href="/forgot-password" class="lg:text-m text-sm text-purple hover:underline dark:text-purplelight">Forgot password</a>
                    </div>
                </div>

                <!-- BUTTON SIGN IN -->
                <div class="flex flex-col items-center">
                    <button class="btn btn-primary mb-5 bg-purple border-none w-60 rounded-full normal-case text-white g-recaptcha" data-sitekey="{{ config('recaptcha.sitekey') }}" data-callback='onSubmit' data-action='submit'>
                        Sign In
                    </button>
                    <div class="text-xs lg:text-m">
                        <p class="lg:text-m text-sm">Don't have an account? <a href="/signup" class="text-purple hover:underline dark:text-purplelight">Sign up</a></p>
                    </div>
                </div>
            </form>
        </div>
        <!-- IMAGE -->
        <div class="hidden bg-gradient-to-b from-[#BEB5F4] to-customblue lg:block lg:w-1/2 lg:p-5 lg:min-h-screen lg:flex lg:items-center lg:justify-center">
            <img class="max-w-[50%] sm:min-w-[40%]" src="{{ asset('images/manwoman-2.png') }}" alt="">
        </div>
    </section>

</x-layout>
