<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    blog: Object,
    users: Object,
})

const form = useForm({
    comment: ''
})

const submit = (data) => {
    form.post(route('comment.store', data), {
        onSuccess: () => {
            form.reset()
        }
    });
};

function returnDate(date) {
    let docDate = new Date(Date.parse(date));
    return docDate.toLocaleDateString("et-ET", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function returnUser(id) {
    return props.users.find(x => x.id === id)
}
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
        <div class="p-6 text-gray-900 flex justify-between">
            <h1 class="font-bold text-lg">{{ blog.title }}</h1>
            <div class="flex gap-4" v-if="$page.props.auth.user.level === 'admin'">
                <Link :href="route('blog.edit', blog)">Edit</Link>
                <Link class="text-red-500" :href="route('blog.destroy', blog)" method="delete" as="button">Delete</Link>
            </div>
        </div>
        <div class="px-6 pb-6 text-gray-900">{{ blog.description }}</div>
        <form method="POST" class="px-6 pb-6" @submit.prevent="submit(blog)">
            <div class="flex gap-2">
                <input type="text" v-model="form.comment" name="comment" placeholder="comment">
                <button type="submit">Add</button>
            </div>
        </form>
        <div class="px-6 pb-4">
            <p>Comments</p>
            <div v-for="comment in blog.comments" class="my-2 border rounded lg p-2 flex justify-between items-center">
                <div>
                    <p class="text-sm text-neutral-600">{{ returnUser(comment.user_id).name }} {{ returnDate(comment.created_at) }}</p>
                    <p>{{ comment.description }}</p>
                </div>
                <div class="flex gap-4 pr-4" v-if="$page.props.auth.user.level === 'admin' || $page.props.auth.user.id === comment.user_id">
                    <Link :href="route('comment.edit', comment)">Edit</Link>
                    <Link class="text-red-500" :href="route('comment.destroy', comment)" method="delete" as="button">Delete</Link>
                </div>
            </div>
        </div>
    </div>
</template>