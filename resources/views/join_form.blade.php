<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Join Our Waiting List</title>
    <link
            href="https://unpkg.com/tailwindcss/dist/tailwind.min.css"
            rel="stylesheet"
    >
</head>


<body class="bg-white font-sans leading-normal tracking-normal">

<div class="max-w-3xl mx-auto my-96">
    <form method="POST" action="{{ route('waiting_list__join') }}">
        <label for="email">Email Address</label>
        <input
                class="appearance-none bg-white border-gray-600 rounded-md border-solid border box-border cursor-text block font-sans text-base leading-normal mx-0 mb-0 mt-1 py-2 px-3 shadow-xs w-full focus:border-blue-600 focus:shadow-xs"
                id="email"
                type="email"
                name="email"
                required="required"
                autofocus="autofocus"
                style="--tw-shadow:0 1px 2px 0 rgba(0,0,0,0.05); --tw-ring-inset:var(--tw-empty, ); --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgba(59,130,246,0.5); --tw-ring-offset-shadow:0 0 transparent; --tw-ring-shadow:0 0 transparent; quotes: auto;"
        />

        <span class="inline-flex rounded-md shadow-sm mt-6">
    <button type="submit" href="http://artisanbuild.test/register" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base leading-6 font-medium rounded-md text-gray-700  hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 uppercase">
            Join Our Mailing List
        </button>
</span>





    </form>

</div>

</body>

</html>
