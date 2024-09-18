<template>
    <h1 class="font-bold">
        {{ todoStore.currentTodoList?.name }}
    </h1>

    <div class="overflow-hidden bg-white shadow sm:rounded-md mt-4">
        <ul role="list" class="divide-y divide-gray-200">
            <li class="h-8">
                <CreateTodoForm/>
            </li>
            <li class="px-4 py-4 sm:px-6" v-for="todo in todoStore.todos?.data" :key="todo.id">
                <Todo :todo="todo"/>
            </li>
        </ul>
    </div>

    <Pagination/>
    <TodoList/>
</template>

<script setup>

import {useTodosStore} from "../store/todoStore.js";
import {onMounted, ref} from "vue";
import Pagination from "./Pagination.vue";
import TodoList from "./TodoList.vue";
import Todo from "./Todo.vue";
import CreateTodoForm from "./CreateTodoForm.vue";

const todoStore = useTodosStore();

const fetchTodos = (page) => {
    return todoStore.fetch(page ?? 1);
}

onMounted(async () => {
    await Promise.all([
        todoStore.fetchTodoList(),
        todoStore.fetchTags()
    ]);
    await todoStore.fetch(1);
})

</script>

