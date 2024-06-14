<script>
import axios from "axios";

export default {
    data() {
        return {
            whatapi: '',
            limit: 0,
            apiData: null,
        }
    },
    methods: {
        fetchdata() {
            axios
                .get('/api/api/class', {
                    params: {
                        whatapi: this.whatapi,
                        limit: this.limit,
                    }
                
                })
                .then(response => {
                    console.log(response.data);
                    this.apiData = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<template>
    <div class="p-12">
        <div class="flex gap-2 justify-center items-center border-b pb-12">
                <select name="" v-model="whatapi" id="">
                    <option value="">Select api</option>
                    <option value="lurescape">Sulla Mulla Kala</option>
                    <option value="cars">Autod</option>
                </select>
                <input
                    type="number"
                    name="limit"
                    id="limit"
                    v-model="limit"
                />
                <button @click="fetchdata" class="">Fetch</button>
            </div>
        <div class="grid grid-cols-3 gap-24 items-center py-24" v-if="apiData">

            <div
                v-if="whatapi == 'lurescape'"
                v-for="data in apiData"
                :key="data.id"
            >
                <div>
                    <div class="w-24 h-24">
                        <img :src="data?.image_url" :alt="data?.name" />
                    </div>
                    <div>
                        <h1>{{ data?.name }}</h1>
                        <p>{{ data?.description }}</p>
                        <p>{{ data?.is_carnivore }}</p>
                        <p>{{ data?.avg_size }}</p>
                    </div>
                </div>
            </div>
            <div
                v-if="whatapi == 'cars'"
                v-for="data in apiData"
                :key="data.id"
            >
                <div class="border rounded-lg bg-white p-4">
                    <h1 class="font-semibold text-lg">{{ data?.brand }}, {{ data?.year }}</h1>
                    <p>Engine: {{ data?.model }}</p>
                    <p>Body: {{ data?.body }}</p>
                    <p>Kilometers: {{ data?.mileage }}</p>
                </div>
            </div>
        </div>
    </div>
</template>