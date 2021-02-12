<template>
    <div class="container">
        <div class="flex justify-center">
            <form id="form" class="rounded px-8 pt-6 pb-8 mb-4 w-full lg:w-2/6">
                <br>
                <h1 class="block text-black-700 font-bold mb-2 text-xl text-center">Contact</h1>
                <br>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name" id="name" type="text" placeholder="">
                </div>
                <div class="mb-4">
                    <label class="block text-black-700-700 text-sm font-bold mb-2" for="name">
                        Email
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email" id="email" type="text" placeholder="">
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2" for="name">
                        Phone
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700 leading-tight"
                        name="phone" id="phone" type="text" placeholder="">
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2" for="name">
                        Message
                    </label>
                    <textarea class="resize border rounded-md w-full" name="message" id="message"></textarea>
                </div>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border rounded" type="button" v-on:click="submitContact">
                    Send
                </button>
            </form>


        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        submitContact: function (event) {
            axios({
                method: 'POST',
                url: '/contact',
                data: {name: $('#name').val(), email: $('#email').val(), phone: $('#phone').val(), message: $('#message').val()},
            }).then(function (response) {
                console.log(response)
            }).catch(function (e) {
                console.log(e)
            })
        }
    }
}
</script>
