<template>
    <div class="container">
        <div class="flex justify-center">
            <form id="form" class="rounded px-8 pt-6 pb-8 mb-4 w-full lg:w-2/6">
                <br>
                <h1 class="block text-black-700 font-bold mb-2 text-xl text-center">Contact</h1>
                <br>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name" id="name" type="text" placeholder="" v-model="name">
                    <span class="text-xs text-red-700" id="nameError">{{ nameError }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email" id="email" type="text" placeholder="" v-model="email">
                    <span class="text-xs text-red-700" id="emailError" >{{ emailError }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Phone
                    </label>
                    <input
                        class="border rounded w-full py-2 px-3 text-black-700 leading-tight"
                        name="phone" id="phone" type="text" placeholder="" v-model="phone">
                    <span class="text-xs text-red-700" id="phoneError">{{ phoneError }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Message
                    </label>
                    <textarea class="resize border rounded-md w-full py-2 px-3 " v-model="message"></textarea>
                    <span class="text-xs text-red-700" id="messageError">{{ messageError }}</span>
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
    data() {
        return {
            name: '',
            email: '',
            phone: '',
            message: '',
            nameError: '',
            emailError: '',
            phoneError: '',
            messageError: '',
        }
    },
    methods: {
        submitContact: function () {
            axios({
                method: 'POST',
                url: '/contact',
                data: {name: this.name, email: this.email, phone: this.phone, message: this.message},
            }).then(function (response) {
                console.log(response)
            }).catch(function (e) {
                if (e.response.status === 422){
                    this.nameError = _.get(e, 'response.data.errors.name[0]', '');
                    this.emailError = _.get(e, 'response.data.errors.email[0]', '');
                    this.phoneError = _.get(e, 'response.data.errors.phone[0]', '');
                    this.messageError = _.get(e, 'response.data.errors.message[0]', '');
                }
            }.bind(this))
        }
    }
}
</script>
