<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

function ws() {
    console.log('ws start')
    window.Echo.channel('events').listen('RealTimeMessage', (e) => console.log('RealTimeMessage: ' + e.message));
}
setTimeout(ws, 2000);
</script>

<template>
    <AppLayout title="MagnitChat">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <hi>welcome</hi>
<!--                    <Welcome />-->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
