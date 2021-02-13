<template>
    <div class="container">
        <div class="flex justify-center">
            <form id="form" class="rounded px-8 pt-6 pb-8 mb-4 w-full lg:w-2/6">
                <br>
                <h1 class="block text-black-700 font-bold mb-2 text-xl text-center">Contact</h1>
                <br>
                <div class="mb-2">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Name
                    </label>
                    <input
                        class="border-2 rounded w-full py-2 px-3 text-black-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name" id="name" type="text" placeholder="" v-on:keydown="removeBorder" v-model="name" v-bind:class="{'border-red-300': this.nameError}">
                    <span class="text-xs text-red-700 block h-4" >{{ nameError }}</span>
                </div>
                <div class="mb-2">
                    <label class="block text-black-700-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <input
                        class="border-2 rounded w-full py-2 px-3 text-black-700-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email" id="email" type="text" placeholder="" v-on:keydown="removeBorder" v-model="email" v-bind:class="{'border-red-300': this.emailError}">
                    <span class="text-xs text-red-700 block h-4" >{{ emailError }}</span>
                </div>
                <div class="mb-2">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Phone
                    </label>
                    <input
                        class="border-2 rounded w-full py-2 px-3 text-black-700 leading-tight"
                        name="phone" id="phone" type="text" placeholder="" v-on:keydown="removeBorder" v-model="phone" v-bind:class="{'border-red-300': this.phoneError}">
                    <span class="text-xs text-red-700 block h-4" >{{ phoneError }}</span>
                </div>
                <div class="mb-4">
                    <label class="block text-black-700 text-sm font-bold mb-2">
                        Message
                    </label>
                    <textarea class="border-2 resize rounded-md w-full py-2 px-3" id="message" v-on:keydown="removeBorder" v-model="message" v-bind:class="{'border-red-300': this.messageError}"></textarea>
                    <span class="text-xs text-red-700 block h-4" >{{ messageError }}</span>
                </div>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border rounded" type="button" v-on:click="submitContact">
                    Send
                </button>
            </form>
        </div>
        <loading-component :loading-hidden="this.loadingHidden"></loading-component>
    </div>
</template>

<script>
import LoadingComponent from './LoadingComponent';
export default {
    components: {
        LoadingComponent
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
            loadingHidden: true,
        }
    },
    methods: {
        submitContact: function () {
            this.loadingHidden = false;
            axios({
                method: 'POST',
                url: '/contact',
                data: {name: this.name, email: this.email, phone: this.phone, message: this.message},
            }).then(function (response) {
                console.log(response)
                this.loadingHidden = true;
                alert('Send data success');
            }.bind(this)).catch(function (e) {
                this.loadingHidden = true;
                if (e.response.status === 422){
                    this.nameError = _.get(e, 'response.data.errors.name[0]', '');
                    this.emailError = _.get(e, 'response.data.errors.email[0]', '');
                    this.phoneError = _.get(e, 'response.data.errors.phone[0]', '');
                    this.messageError = _.get(e, 'response.data.errors.message[0]', '');
                }
            }.bind(this))
        },
        removeBorder: function (event) {
            let error = event.target.id + 'Error';
            this[error] = '';
        }
    }
}
</script>
