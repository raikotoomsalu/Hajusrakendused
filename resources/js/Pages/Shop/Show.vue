<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


defineProps({
    id: String,
    products: Object
})
</script>

<template>
     <AuthenticatedLayout>
        <body>
            <section class="w-fit mx-auto flex justify-center mt-10">
                <div class="w-72 h-72 flex bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                        <p class="text-4xl font-bold truncate block capitalize">{{ products.title }}</p>
                        <div class="flex items-center">
                            <p class="text-3xl font-semibold text-black my-3">{{ products.price }}€</p>
                        </div>
                </div>
            </section>
        </body>
     </AuthenticatedLayout>
</template>