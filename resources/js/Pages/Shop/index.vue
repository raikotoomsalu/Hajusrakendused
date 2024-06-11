<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    products: Object
})
</script>

<template>
     <Head title="Dashboard" />

    <AuthenticatedLayout>
             
                    <div v-for="product in products">
                        <Link :href="route('shop.show', product.id)">
                            <p class="font-bold text-lg">{{ product.title }}</p>
                            <p>{{ product.description }}</p>
                            <p>{{ product.price }}</p>
                        </Link>
                    </div>

       
    </AuthenticatedLayout>
  
    
    
</template>