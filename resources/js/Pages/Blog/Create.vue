<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: ''
})

const submit = () => {
    form.post(route('blog.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12 w-full flex justify-center items-center">
            <form action="" class="flex flex-col justify-center gap-4" @submit.prevent="submit">
                <div>
                    <p>Title</p>                    
                    <input type="text" name="title" id="" v-model="form.title" class="rounded">
                </div>
                <div>
                    <p>Description</p>                    
                    <input type="text" name="description" id="" v-model="form.description" class="rounded">
                </div>
                <Link class="bg-white text-center p-2 rounded" @click="submit" as="button" type="button">Submit</Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>