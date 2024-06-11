<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Blog from '@/Components/Blog.vue';

const props = defineProps({
    blogs: Object,
    users: Object,
    weatherData: Object
})
console.log(props.weatherData)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blog</h2>
                <div class="flex items-center gap-4">
                    <!-- <h1 class="font-bold">{{ props.weatherData.name }} </h1>
                    <p>{{ props.weatherData.weather[0].description }}</p>
                    <img :src="`https://openweathermap.org/img/wn/{{weatherData.weather[0].icon}}.png`" alt="">
                    <p>{{ props.weatherData.main.temp }}<sup>c</sup> (feels like: {{ props.weatherData.main.feels_like }}<sup>c</sup>)</p>
                    <p>Clouds: {{ props.weatherData.clouds.all }}%</p>
                    <p>Humidity: {{ props.weatherData.main.humidity }}%</p> -->
                </div>
            </div>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('blog.create')" class="p-2 bg-white rounded-lg shadow-sm" v-if="$page.props.auth.user.level === 'admin'">Uus postitus</Link>
                <div v-for="blog in blogs">
                    <Blog :blog="blog" :users="users"/>
                </div>
                <!-- <div v-for="(blog, index) in blogs" :key="index">
                    <Blog :blog="blog" />
                </div> -->
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4" v-for="blog in blogs">
                    <div class="p-6 text-gray-900">{{ blog.title }}</div>
                    <div class="px-6 pb-6 text-gray-900">{{ blog.description }}</div>
                    <form method="POST" class="px-6 pb-6" @submit.prevent="submit(blog)">
                        <p>Comment</p>
                        <div class="flex gap-2">
                            <input type="text" v-model="form.comment" name="comment">
                            <button type="submit">Add</button>
                        </div>
                    </form>
                </div> -->

            </div>
        </div>
    </AuthenticatedLayout>
</template>
