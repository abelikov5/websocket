<script>
import {Inertia} from "@inertiajs/inertia";


export default {
    data() {
        return {
            show: [],
        }
    },
    methods: {
        scroll() {
            document.getElementById('scroll_anchor').scrollIntoView({block: "center", behavior: "smooth"});
        },
        show_message(mess) {
            let user_mess = JSON.parse(mess);
            this.show.push(user_mess);
            setTimeout(this.scroll, 1);
        }
    },
    mounted() {
        window.Echo.channel('events').listen('ChatMessage', (e) => this.show_message(e.message));

        window.Echo.join(`events`)
            .here((users) => {
                console.log('heare', users)
            })
            .joining((user) => {
                console.log('joing', user);
            })
            .leaving((user) => {
                console.log("leaving", user);
            })
    }
}

</script>

<template>
    <div class="chat_main bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="chat_message">
            <div v-for="el in show">
                <div class="user_message flex">
                    <div class="user_name">{{ el.user_name }}:</div>
                    <div class="user_message">{{ el.message }}</div>
                </div>
            </div>
            <div id="scroll_anchor"></div>
        </div>
    </div>
</template>

<style>
#scroll_anchor {
    height: 10px;
}

.chat_main::-webkit-scrollbar {
    width: 8px; /* ширина всей полосы прокрутки */
    border-radius: 20px;
}

.chat_main::-webkit-scrollbar-track {
    background: white; /* цвет зоны отслеживания */
}

.chat_main::-webkit-scrollbar-thumb {
    background-color: whitesmoke; /* цвет бегунка */
    border-radius: 20px; /* округлось бегунка */
    border: 1px solid #e3e3e3; /* отступ вокруг бегунка */
}

.chat_main {
    width: 100%;
    height: 250px;
    overflow-y: scroll;

}

.chat_message {
    height: 100%;
    padding: 0.5rem 0.75rem;
}
</style>



