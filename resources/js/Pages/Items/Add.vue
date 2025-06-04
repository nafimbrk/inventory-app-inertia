<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: '',
    qty: 0,
    unit: ''
})

const submitForm = () => {
    // console.log(form);

    form.post('/items');
}
</script>

<template>
    <Head title="Items" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Add Item
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Item Name:</label>
                                <input type="text" v-model="form.name" id="name" required class="shadow appearance-none border rounded w-full">
                                <div class="bg-red-100 border border-red-400 text-black-700 p-2 mt-2 rounded" v-if="form.errors.name">{{ form.errors.name }}</div>

                            </div>
                            <div class="mb-4">
                                <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                                <input type="number" v-model="form.qty" id="qty" required class="shadow appearance-none border rounded w-full">
                                <div class="bg-red-100 border border-red-400 text-black-700 p-2 mt-2 rounded" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="unit" class="block text-gray-700 text-sm font-bold mb-2">Unit:</label>
                                <input type="text" v-model="form.unit" id="unit" required class="shadow appearance-none border rounded w-full">
                                <div class="bg-red-100 border border-red-400 text-black-700 p-2 mt-2 rounded" v-if="form.errors.unit">{{ form.errors.unit }}</div>
                            </div>
                            <PrimaryButton type="submit">Add Item</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
