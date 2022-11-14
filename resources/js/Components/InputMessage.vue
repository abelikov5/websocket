<template >
    <div class="wrap_input">
        <div v-if="error_mess" class="error_valid">
            <div >
                {{ error_mess }}
            </div>
        </div>
        <div class="wrap_input d_flex bg-white overflow-hidden shadow-xl sm:rounded-lg" >
            <input v-model="message" class="chat_input"
                   placeholder="Write a message ...." v-on:keyup.enter="verified_message">
            <div class="input_send"  @click="verified_message">
                <div>
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                         width="100%" height="100%" viewBox="0 0 225.000000 225.000000"
                         preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,225.000000) scale(0.100000,-0.100000)"
                           fill="#da0810" stroke="none">
                            <path d="M1310 1675 c-498 -156 -994 -312 -1102 -346 -109 -34 -195 -66 -192
                            -70 3 -5 95 -76 204 -159 l200 -151 2 -373 3 -374 192 166 c105 92 192 171
                            192 175 1 5 -18 31 -40 58 l-42 49 -71 -63 c-39 -35 -77 -67 -84 -71 -9 -6
                            -12 38 -12 206 l0 214 333 201 c182 110 505 305 717 432 212 128 394 237 405
                            243 18 9 18 9 5 -4 -8 -8 -91 -78 -185 -154 -689 -566 -1086 -897 -1083 -905
                            6 -15 583 -437 590 -430 4 3 196 352 428 776 232 424 432 789 446 812 27 48
                            29 53 12 52 -7 0 -420 -128 -918 -284z"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</template>

<style>
    .wrap_input {
        position: relative;
    }
    .error_valid {
        position: absolute;
        min-height: 20px;
        padding: 10px;
        background-color: white;
        border: 1px solid gray;
        border-radius: 20px;
        z-index: 20;
        top: -50px;
        left: 20px;
    }
    .wrap_input {
        margin-top: 20px;
        position: relative;
    }
    .chat_input {
        background-color: #fff;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5rem;
        --tw-shadow: 0 0 #0000;
        width: 90%;
    }
    .chat_input:focus {
        border: unset;
        outline: none;
    }
    .input_send div {
        position: relative;
    }
    .input_send {
        width: 30px;
        height: 100%;
        position: absolute;
        right: 12px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>

<script>
import {Inertia} from "@inertiajs/inertia";
// import ErrorValidation from '@/Components/ErrorValidation.vue';



export default {
    name: 'chat',
    data() {
        return {
            error_mess: '',
            message: '',
        }
    },
    methods: {
        error_mess_off() {
          this.error_mess = '';
        },
        verified_message() {
            let regExp = '^[a-zA-Z]+$';
            if (this.message.search(regExp) === -1) {
                this.error_mess = 'Please verify you message, and try again! Only latin characters are valid';
                setTimeout(this.error_mess_off, 5000);
                return ;
            } else {

            }

            if (this.message.trim() === '' || this.message.length < 2) return;

            this.send_message();

        },
        send_message() {
            // console.log(this.message, Inertia.page.props.user);
            let data = JSON.stringify({
                message: this.message,
                user_name: Inertia.page.props.user.name,
                user_id: Inertia.page.props.user.id
            });
            try {
                axios.post('/chat-message', {
                    message: data,
                });
                this.message = '';
                this.error_mess = '';
            } catch (e) {
                console.log("ERROR_124: " + e);
            }
        },
    },

}

</script>
