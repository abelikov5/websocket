<template>
    <AppLayout title="Users info">
        <div class="wrap_chat">
            <h1>hello users</h1>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Chat from '@/Components/Chat.vue';
import InputMessage from '@/Components/InputMessage.vue';

import {Inertia} from "@inertiajs/inertia";

</script>

<style>
.wrap_chat {
    width: 800px;
    margin: 50px auto;
}
</style>
