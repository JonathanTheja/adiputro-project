<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>

<body>
    <nav
        class="mx-auto block w-full max-w-screen-xl rounded-xl border border-white/80 bg-white bg-opacity-80 py-2 px-4 text-white shadow-md backdrop-blur-2xl backdrop-saturate-200 lg:px-8 lg:py-4">
        <div>
            <div class="container mx-auto flex items-center justify-between text-gray-900">
                <a href="#"
                    class="mr-4 block cursor-pointer py-1.5 font-sans text-sm font-normal leading-normal text-inherit antialiased">
                    <span>Material Tailwind</span>
                </a>
                <ul class="hidden items-center gap-6 lg:flex">
                    <li class="block p-1 font-sans text-sm font-normal leading-normal text-inherit antialiased">
                        <a class="flex items-center" href="#">
                            Pages
                        </a>
                    </li>
                    <li class="block p-1 font-sans text-sm font-normal leading-normal text-inherit antialiased">
                        <a class="flex items-center" href="#">
                            Account
                        </a>
                    </li>
                    <li class="block p-1 font-sans text-sm font-normal leading-normal text-inherit antialiased">
                        <a class="flex items-center" href="#">
                            Blocks
                        </a>
                    </li>
                    <li class="block p-1 font-sans text-sm font-normal leading-normal text-inherit antialiased">
                        <a class="flex items-center" href="#">
                            Docs
                        </a>
                    </li>
                </ul>
                <button
                    class="middle none center hidden rounded-lg bg-gradient-to-tr from-pink-600 to-pink-400 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:inline-block"
                    type="button">
                    <span>Buy Now</span>
                </button>
                <button
                    class="middle none relative ml-auto h-6 max-h-[40px] w-6 max-w-[40px] rounded-lg text-center font-sans text-xs font-medium uppercase text-blue-gray-500 transition-all hover:bg-transparent focus:bg-transparent active:bg-transparent disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none lg:hidden"
                    data-collapse-target="navbar">
                    <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor"
                            strokeWidth="2">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </span>
                </button>
            </div>
            <div class="block h-0 w-full basis-full overflow-hidden transition-all duration-300 ease-in lg:hidden"
                data-collapse="navbar">
                <div class="container mx-auto">
                    <ul class="mt-2 mb-4 flex flex-col gap-2">
                        <li
                            class="block p-1 font-sans text-sm font-normal leading-normal text-blue-gray-600 text-inherit antialiased">
                            <a class="flex items-center" href="#">
                                Pages
                            </a>
                        </li>
                        <li
                            class="block p-1 font-sans text-sm font-normal leading-normal text-blue-gray-600 text-inherit antialiased">
                            <a class="flex items-center" href="#">
                                Account
                            </a>
                        </li>
                        <li
                            class="block p-1 font-sans text-sm font-normal leading-normal text-blue-gray-600 text-inherit antialiased">
                            <a class="flex items-center" href="#">
                                Blocks
                            </a>
                        </li>
                        <li
                            class="block p-1 font-sans text-sm font-normal leading-normal text-blue-gray-600 text-inherit antialiased">
                            <a class="flex items-center" href="#">
                                Docs
                            </a>
                        </li>
                    </ul>
                    <button
                        class="middle none center mb-2 block w-full rounded-lg bg-gradient-to-tr from-pink-600 to-pink-400 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        <span>Buy Now</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="w-full flex justify-center items-center">
        <div class="w-64 p-4 m-auto bg-white shadow-lg rounded-2xl">
            <div class="w-full h-full text-center">
                <div class="flex flex-col justify-between h-full">
                    <svg width="40" height="40" class="w-12 h-12 m-auto mt-4 text-indigo-500" fill="currentColor"
                        viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                        </path>
                    </svg>
                    <p class="mt-4 text-xl font-bold dark:text-gray-800">
                        Remove card
                    </p>
                    <p class="px-6 py-2 text-xs text-gray-600 dark:text-gray-400">
                        Are you sure you want to delete this card ?
                    </p>
                    <div class="flex items-center justify-between w-full gap-4 mt-8">
                        <button type="button"
                            class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Delete
                        </button>
                        <button type="button"
                            class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
