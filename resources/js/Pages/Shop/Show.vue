<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    id: String,
    products: Object
})
</script>

<template>
     <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shop
            </h2>
        </template>
        <body>
            <section class="w-fit mx-auto flex justify-center mt-10">
                <div class="w-72 h-72 flex bg-white shadow-md rounded-xl flex-col gap-5 p-5">
                        <p class="text-4xl font-bold truncate block capitalize">{{ products.title }}</p>
                        <p class="text-2xl">{{ products.description }}</p>
                        <div class="flex items-center">
                            <p class="text-3xl font-semibold text-black mt-3 mb-8">{{ products.price }}€</p>
                        </div>
                        <Link>
                            <h1 class="text-3xl font-bold">Add to bag</h1>
                        </Link>
                </div>
            </section>
        </body>
     </AuthenticatedLayout>
</template>