<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


defineProps({
    id: String,
    products: Object
})
</script>

<template>
     <AuthenticatedLayout>
        <div class="flex justify-center mt-10">
            <div class="w-72 h-72 flex bg-white shadow-md rounded-xl">
                    <p class="text-lg font-bold text-black truncate block capitalize pt-5 pl-5 w-full">{{ products.title }}</p>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black my-3">{{ products.price }}€</p>
                    </div>
            </div>
        </div>
     </AuthenticatedLayout>
</template>