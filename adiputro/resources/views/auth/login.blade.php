<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/js/app.js')
</head>

<body>

    <section class="gradient-form bg-gradient-to-r from-slate-900 to-transparent min-h-screen flex justify-center items-center">

        <div class="container h-full justify-center items-center">

            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="lg:w-10/12">

                    @include('includes.alert')

                    <div class="block bg-white shadow-2xl rounded-lg">
                        <div class="lg:flex lg:flex-wrap g-0">
                            <div class="lg:w-6/12 px-4 md:px-0">
                                <div class="md:p-12 md:mx-6">
                                    <div class="text-center">
                                        <img class="mx-auto w-48" src={{ asset('img/adiputro_logo.svg') }}
                                            alt="logo" style="width:180px;height:180px" />
                                        {{-- <h1 class="text-lg font-semibold mt-1 mb-12 pb-1">ADIPUTRO</h1> --}}
                                    </div>
                                    <form action="{{ url('doLogin') }}" method="POST">
                                        @csrf
                                        <p class="my-6">Login to Adiputro</p>
                                        <div class="mb-4">
                                            <input type="text"
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                id="exampleFormControlInput1" placeholder="Username" name="username" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="password"
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                id="exampleFormControlInput1" placeholder="Password" name="password" />
                                        </div>
                                        <div class="text-center pt-1 mb-12 pb-1">
                                            <button
                                                class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-slate-200 hover:text-black hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gray-800"
                                                type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                                                style="">
                                                Log in
                                            </button>
                                            {{-- <a class="text-gray-500" href="#!">Forgot password?</a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div
                                class="lg:w-6/12 items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none bg-[url('/img/bus_wall_1.jpg')] bg-cover lg:block hidden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
