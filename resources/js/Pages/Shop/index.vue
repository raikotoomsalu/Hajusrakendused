<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    products: Object
})
</script>

<template>
    <Head title="Shop" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shop
            </h2>
        </template>
        <body>
            <section class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
                <div v-for="product in products" class="w-48 h-48 flex bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                    <Link :href="route('shop.show', product.id)" class="px-4 py-3 w-full h-full">
                        <p class="text-lg font-bold text-black truncate block capitalize">{{ product.title }}</p>
                        <div class="flex items-center">
                            <p class="text-lg font-semibold text-black my-3">{{ product.price }}€</p>
                        </div>
                    </Link>
                </div>
            </section>
        </body>
    </AuthenticatedLayout>  
</template>