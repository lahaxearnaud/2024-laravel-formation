<template>
    <div class="flex">
        <div class="flex-none w-14 h-6">
            <input class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                   type="checkbox"
                   @click="() => toggleStatusTodo()"
                   :checked="todo.completed"/>
        </div>
        <div class="grow h-6 flex">
            <div class="grow">
                {{ todo.title }}
            </div>

            <div class="w-60">
                <Tag
                    v-for="tag in todo.tags" :key="tag.id"
                    :tag="tag"
                ></Tag>
            </div>
        </div>
        <div class="flex-none w-14 h-6">
            <button @click="() => deleteTodo()">X</button>
        </div>
    </div>
</template>
<script setup>

import {useTodosStore} from "../store/todoStore.js";
import Tag from "./Tag.vue";

const props = defineProps(['todo']);

const todoStore = useTodosStore();

const toggleStatusTodo = () => {
    props.todo.completed = !props.todo.completed;
    todoStore.update({...props.todo});
}

const deleteTodo = () => {
    todoStore.delete(props.todo);
}
</script>
