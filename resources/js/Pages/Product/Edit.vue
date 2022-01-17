<template>
    <app-layout title="Sunting Produk">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mengubah Koleksi</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-2xl">Sunting Produk</div>
                        <div
                            class="mt-2 text-gray-500"
                        >{{ product.name }} ({{ product.code }})</div>
                    </div>
                    <div class="bg-gray-200 bg-opacity-25">
                        <div class="p-6">
                            <div class="flex flex-col">
                                <!-- Form Edit Product -->
                                <div>
                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                        <div class="md:col-span-1">
                                            <div class="px-4 sm:px-0">
                                                <h3
                                                    class="text-lg font-medium leading-6 text-gray-900"
                                                >Informasi Umum</h3>
                                                <p
                                                    class="mt-1 text-sm text-gray-600"
                                                >Informasi ini akan terlihat oleh pelanggan, jadi hati-hati dengan apa yang kamu inputkan.</p>
                                                <jet-validation-errors class="my-4" />
                                            </div>
                                        </div>
                                        <div class="mt-5 md:mt-0 md:col-span-2">
                                            <form @submit.prevent="submit">
                                                <div
                                                    class="shadow sm:rounded-md sm:overflow-hidden"
                                                >
                                                    <div
                                                        class="px-4 py-5 bg-white space-y-6 sm:p-6"
                                                    >
                                                        <!-- Foto -->
                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700"
                                                            >Foto</label>
                                                            <div class="mt-1 flex items-center">
                                                                <span
                                                                    class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 relative"
                                                                >
                                                                    <img v-if="img_url != null" :src="img_url" class="h-12 w-12 object-cover rounded-full absolute">
                                                                    <img v-if="url" :src="url" class="h-12 w-12 object-cover rounded-full absolute">
                                                                    <svg
                                                                        class="h-full w-full text-gray-300"
                                                                        fill="currentColor"
                                                                        viewBox="0 0 24 24"
                                                                    >
                                                                        <path
                                                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
                                                                        />
                                                                    </svg>
                                                                </span>

                                                                <label
                                                                    for="product-photo"
                                                                    class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                    <input 
                                                                        type="file" 
                                                                        ref="photo" 
                                                                        @change="previewImage" 
                                                                        id="product-photo" 
                                                                        accept="image/*" 
                                                                        class="hidden">
                                                                Ubah</label>
                                                            </div>
                                                        </div>
                                                        <!-- Code & Name -->
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <label for="product-code" class="block text-sm font-medium text-gray-700">Kode</label>
                                                                <input type="text" v-model="form.code" id="product-code" autocomplete="product-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="MS-3031">
                                                            </div>

                                                            <div class="col-span-6 sm:col-span-4">
                                                                <label for="product-name" class="block text-sm font-medium text-gray-700">Nama</label>
                                                                <input type="text" v-model="form.name" id="product-name" autocomplete="product-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Milie Shirt 3031">
                                                            </div>
                                                        </div>
                                                        <!-- Amount -->
                                                        <div class="grid grid-cols-3 gap-6">
                                                            <div class="col-span-3 sm:col-span-1">
                                                                <label
                                                                    for="product-amount"
                                                                    class="block text-sm font-medium text-gray-700"
                                                                >Harga</label>
                                                                <div
                                                                    class="mt-1 flex rounded-md shadow-sm"
                                                                >
                                                                    <span
                                                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
                                                                    >Rp.</span>
                                                                    <input
                                                                        type="number"
                                                                        v-model="form.amount"
                                                                        id="product-amount"
                                                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                                                        step="2500"
                                                                        min="50000"
                                                                        max="100000000"
                                                                        placeholder="50000"
                                                                    />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Desc -->
                                                        <div>
                                                            <label
                                                                for="product-desc"
                                                                class="block text-sm font-medium text-gray-700"
                                                            >Deskripsi</label>
                                                            <div class="mt-1">
                                                                <textarea
                                                                    v-model="form.desc"
                                                                    id="product-desc"
                                                                    rows="3"
                                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                                                    placeholder="Product Size, feature, variant, etc."
                                                                ></textarea>
                                                            </div>
                                                            <p
                                                                class="mt-2 text-sm text-gray-500"
                                                            >Deskripsi singkat untuk produk ini. Jangan terlalu pendek!</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                                                    >
                                                        <!-- Submit & Cancel -->
                                                        <div class="flex justify-end items-center space-x-4">
                                                            <Link
                                                                :href="route('collection')"
                                                                class="p-1 px-2 text-xs uppercase tracking-widest text-gray-600 border border-gray-400 rounded-lg shadow-md"
                                                            >Kembali</Link>
                                                            <button 
                                                                type="submit"
                                                                class="p-1 px-2 text-xs uppercase tracking-widest text-indigo-50 bg-indigo-600 border border-indigo-600 rounded-lg shadow-md hover:border-indigo-700 hover:bg-indigo-700"
                                                            >Sunting Produk</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        AppLayout,
        JetValidationErrors,
        Link
    },
    props: {
        product: Object,
        img_url: String,
        update_url: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                code: this.product.code,
                name: this.product.name,
                amount: this.product.amount.substring(0, this.product.amount.length - 3),
                desc: this.product.desc,
                '_method': 'PUT',
                photo: null
            }, {
                resetOnSuccess: false,
            }),
            url: null,
        }
    },
    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }
            this.form.post(this.update_url)
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        }
    }


})
</script>
