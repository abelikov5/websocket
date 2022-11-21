<template>
    <AppLayout title="Users info">
        <div class="wrap_total bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div>Online users: <strong> {{total}}</strong></div>
        </div>
        <div class="wrap_users bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div v-for="user in all_users" :key="user.id" class="user_item flex">
                <div>
                    <div class="user_name">
                        {{this.add_you(user)}}
                    </div>
                    <div class="user_email">
                        {{user.email}}
                    </div>
                </div>
                <div class="last_visit" v-if="user.online">
                    <div>
                        online
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    props: ['users'],
    components: {
        AppLayout
    },
    data() {
        return {
            show: [],
            all_users: [],
            total: 0,
        }
    },
    methods: {
        show_message(mess) {
            let user_mess = JSON.parse(mess);
            this.show.push(user_mess);
            setTimeout(this.scroll, 1);
        },
        set_online(id, offline = true) {
            this.all_users.forEach(el => {
                if (el.id === id) {
                    el.online = offline;
                }
            })
        },
        add_you(user) {
            if (Inertia.page.props.user.id === user.id) {
                return user.name + ' (you)';
            }
            return user.name;
        }
    },
    mounted() {
        this.all_users = Inertia.page.props.users.slice(0);
        window.Echo.join(`events`)
            .here((join_users) => {
                join_users.forEach(el => {
                    this.set_online(el.id, true);
                })
                this.total = join_users.length;
            })
            .joining((user) => {
                if (!this.all_users.find(el => el.id === user.id)) {
                    this.all_users.push(user);
                }
                this.total++;
                this.set_online(user.id, true);
            })
            .leaving((user) => {
                this.set_online(user.id, false);
                this.total--;
            })
    }
}

</script>

<style>
.wrap_total {
    width: 800px;
    margin: 20px auto;
    padding: 20px;
    text-align: left;
    display: flex;
    justify-content: right;
}

.wrap_users {
    width: 800px;
    margin: 20px auto;
    padding: 10px;
}

.user_email {
    color: #9ca3af;
    font-size: 12px;
}

.user_item {
    margin-bottom: 10px;
    justify-content: space-between;
}

.last_visit {
    color: #1f2937;
    font-size: 13px;
    justify-content: center;
    align-items: center;
    display: flex;
}

</style>
