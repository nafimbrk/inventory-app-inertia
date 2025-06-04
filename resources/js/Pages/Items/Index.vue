<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    items: Array,
});

const form = useForm({});

const deleteItem = (id) => {
    if (confirm("Yakin ingin menghapus item ini?")) {
        form.delete(`/items/${id}`);
    }
};
</script>
<template>
    <Head title="Items" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Item List
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <PrimaryButton>
                            <a href="/items/create" class="text-white"
                                >Create Item</a
                            >
                        </PrimaryButton>

                        <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-black-700 px-4 py-3 m-2 rounded relative" role="alert">
                            {{ $page.props.flash.success }}
                        </div>
                        <div v-if="$page.props.flash.error" class="bg-red-100 border border-red-400 text-black-700 px-4 py-3 m-2 rounded relative" role="alert">
                            {{ $page.props.flash.error }}
                        </div>

                        <table class="table-auto w-full mt-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">#</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Qty</th>
                                    <th class="px-4 py-2">Unit</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in items" :key="index">
                                    <td class="border px-4 py-2">
                                        {{ ++index }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ item.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ item.qty }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ item.unit }}
                                    </td>
                                    <td class="border px-4 py-2">
                                       <a :href="`/items/${item.id}/edit`" class="text-blue-400 hover:text-blue-700">edit</a> |
                                       <a :href="`/items/${item.id}/edit-stock`" class="text-blue-400 hover:text-blue-700">edit stock</a> |
                                       <a :href="`/items/${item.id}/stock-card`" class="text-blue-400 hover:text-blue-700">stock card</a> |
                                       <button @click="deleteItem(item.id)" class="text-red-500 hover:text-red-700">delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
