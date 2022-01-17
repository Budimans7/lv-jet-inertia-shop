<template>
    <app-layout title="Koleksi">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Koleksi</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-2xl">Collection Product</div>
                        <div
                            class="mt-6 text-gray-500"
                        >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor autem eum temporibus.</div>
                    </div>
                    <div class="bg-gray-200 bg-opacity-25">
                        <div class="p-6">
                            <div class="flex flex-col">
                                <div class="mb-4">
                                    <Link :href="create_url" class="p-1 px-2 text-xs uppercase tracking-widest text-gray-600 border border-gray-400 rounded-lg shadow-md hover:text-green-600 hover:border-green-400">Add Product</Link>
                                </div>
                                <!-- Table Product -->
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div
                                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                                    >
                                        <div
                                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                        >
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >Name</th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >Description</th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >Status</th>
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                        >Amount</th>
                                                        <th
                                                            scope="col"
                                                            class="relative px-6 py-3"
                                                        >
                                                            <span class="sr-only">Edit</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-gray-200"
                                                >
                                                    <tr v-for="product in products" :key="product.id">
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="flex-shrink-0 h-10 w-10"
                                                                >
                                                                    <!-- <img
                                                                        class="h-10 w-10 rounded-full"
                                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                                        alt
                                                                    /> -->
                                                                    <img
                                                                        class="h-10 w-10 rounded-full object-cover"
                                                                        :src="product.photo"
                                                                        alt
                                                                    />
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div
                                                                        class="text-sm font-medium text-gray-900"
                                                                    >{{ product.name }}</div>
                                                                    <div
                                                                        class="text-sm text-gray-500"
                                                                    >Category Name</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div
                                                                class="text-sm text-gray-900"
                                                            >Product Material</div>
                                                            <div
                                                                class="text-sm text-gray-500"
                                                            >{{ product.desc }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span
                                                                v-if="!product.disable"
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                                            > Available </span>
                                                            <span 
                                                                v-if="product.qty = 0"
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800"
                                                            > Out of Stock </span>
                                                            <span 
                                                                v-if="product.disable"
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                                                            > Disabled </span>
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                                        >{{ product.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                                        >
                                                            <Link
                                                                :href="product.edit_url"
                                                                class="text-indigo-600 hover:text-indigo-900 mr-2"
                                                            >Edit</Link>
                                                            <Link
                                                                v-if="!product.disable"
                                                                :href="product.disable_url"
                                                                class="text-red-600 hover:text-red-900"
                                                            >Disable</Link>
                                                            <Link
                                                                v-if="product.disable"
                                                                :href="product.restore_url"
                                                                class="text-green-600 hover:text-green-900"
                                                            >Restore</Link>
                                                        </td>
                                                    </tr>

                                                    <!-- More people... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        AppLayout,
        Link
        
    },
    props: {
        products: Object,
        create_url: String,
    },
    data() {
        return{
            
        }
    },
    methods: {
        
    }


})
</script>
