<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    blog: Object
})

const form = useForm({
    title: props.blog.title,
    description: props.blog.description
})

const submit = () => {
    form.post(route('blog.update', props.blog), { _method: 'put' });
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
                <Link class="bg-white text-center p-2 rounded border" @click="submit" as="button" type="button">Update</Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>