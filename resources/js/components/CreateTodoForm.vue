<template>
    <input type="text"
           name="name"
           v-model="formTitle"
           @keyup.enter="addNewTask"
           placeholder="Nouvelle todo ?"
           class="pl-1 block w-full h-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
</template>
<script setup>
import {useTodosStore} from "../store/todoStore.js";
import {ref} from "vue";

const todoStore = useTodosStore();
const formTitle = ref(undefined);

const addNewTask = async () => {
    await todoStore.create(formTitle.value);
    formTitle.value = '';
}

</script>
