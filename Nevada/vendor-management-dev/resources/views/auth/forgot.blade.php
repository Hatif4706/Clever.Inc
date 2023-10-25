<x-layout title="Forgot Password">
    <style>
        .tabs {
            display: none;
        }

        .active-tabs {
            display: block;
        }

        .active-tabs-border {
            border-color: #6F61C0;
            color: #6F61C0;

        }

    </style>

    @if (session('email'))
        <div class="toast toast-start">
            <div class="alert alert-error flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('email') }}</span>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="toast toast-start">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{!! session('success') !!}</span>
            </div>
        </div>
    @endif

    <div class="flex-wrap lg:flex dark:bg-darkbgprimary dark:text-graylight">
        <div class="hidden md:w-[50%] min-h-screen bg-gradient-to-b from-[#BEB5F4] to-customBlue dark:bg-darkbgprimary lg:flex items-center justify-center">
            <!-- <img src="{{asset('/images/phonelogo.png')}}"  class="w-[300px] active-tabs" id="image" alt="">
            <img src="{{asset('/images/phonelogo.png')}}" class="w-[300px] active-tabs" id="image" alt=""> -->
            <div id="image" class="hidden lg:block">
                <img src="/images/forgot1.png" alt="Gambar Default" class="duration-100 w-96">
            </div>
        </div>

        <div class="w-[100%] lg:w-[50%] my-auto min-h-screen bg-white dark:bg-darkbgprimary justify-center mx-auto lg:p-8 flex-wrap lg:flex-col dark:text-graylight flex xl:-mt-16">
            <div>
                <div class="m-auto text-lg md:text-2xl font-bold mx-auto text-center py-10 md:pt-16 hidden md:block">Forgot Password</div>
                <div class="justify-between md:hidden flex py-auto md:py-20 py-10">
                    <div class="my-auto absolute ml-5">
                        <a href="/signin">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 my-auto m">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                    </div>
                    <div class="m-auto text-lg md:text-2xl font-bold mx-auto text-center md:pt-16 block md:hidden">Forgot Password</div>
                </div>
                <div id="image2" class="hidden items-center justify-center">
                    <img src="/images/forgot1.png" alt="Gambar Default" class="w-40 duration-100">
                </div>

                <div id="tabs1" class="tabs active-tabs mt-4 pb-10">
                    <form action="/forgot-password" method="post">
                        @csrf
                        <div class="mx-auto text-center mb-8">Please enter your email address to receive <br> verification link </div>
                        <x-input name="email" placeholder="Enter your email" label="" class="max-w-xl px-5 lg:mx-auto !bg-transparent">
                            <x-icons.envelope input />
                        </x-input>
                        <div class="m-auto text-sm font-normal mx-auto text-center mt-14 dark:text-black">
                            <button type="submit" class="btn btn-primary bg-purple border-none w-60 rounded-full normal-case text-white">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
