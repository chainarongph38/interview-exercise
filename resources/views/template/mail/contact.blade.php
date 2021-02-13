<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container">
        <div class="flex justify-center">
            <div class="rounded px-8 pt-6 pb-8 mb-4 w-full lg:w-2/6">
                <h1 class="block text-black-700 font-bold mb-2 text-xl text-center">Information</h1>
                <br>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Name : {{ $data['name'] }}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700-700 text-sm font-bold mb-2">
                        Email : {{ $data['email'] }}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Phone : {{ $data['phone'] }}
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Message : {{ $data['message'] }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
