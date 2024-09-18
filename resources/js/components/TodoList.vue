<template>
  <ul>
    <li v-for="todoList in todoStore.todoLists" :key="todoList.id">
      <a href="#" @click="() => changeTodoList(todoList)">{{ todoList.name }}</a>
    </li>
  </ul>
</template>
<script setup>
import {useTodosStore} from "../store/todoStore.js";

const todoStore = useTodosStore();

const changeTodoList = async (todoList) => {
  todoStore.currentTodoList = todoList;
  await todoStore.fetch(1);
}
</script>
