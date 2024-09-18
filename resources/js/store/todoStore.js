import { defineStore } from 'pinia'
import axios from 'axios'


const instance = axios.create({
    baseURL: '/api/',
    timeout: 1000,
    headers: {'X-Custom-Header': 'foobar'}
});

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useTodosStore = defineStore('todos', {
    state: () => ({
        todos: undefined,
        todoLists: [],
        tags: [],
        currentTodoList: undefined
    }),
    actions: {
        async create(title) {
            const toDoToInsert = {
                title,
                completed: false
            }
            const result = await instance.post('/todo-lists/' + this.currentTodoList.id + '/todos', toDoToInsert);
            await this.fetch(1);

            return result;
        },
        async update(toDoToUpdate) {
            const index = this.todos.data.findIndex((todo) => todo.id === toDoToUpdate.id);
            this.todos.data[index] = toDoToUpdate;

            return instance.put('/todo-lists/' + this.currentTodoList.id + '/todos/' + toDoToUpdate.id, toDoToUpdate)
        },
        async delete(toDoToDelete) {
            this.todos.data = this.todos.data.filter((todo) => todo.id !== toDoToDelete.id);

            return instance.delete('/todo-lists/' + this.currentTodoList.id + '/todos/' + toDoToDelete.id)
        },
        async fetch(page) {
            const response = await instance.get('/todo-lists/' + this.currentTodoList.id + '/todos', {
                params: {
                    page: page ?? 1
                }
            });
            this.todos = response.data;
        },
        async fetchTodoList() {
            const response = await instance.get('/todo-lists');
            this.todoLists = response.data;
            if (!this.currentTodoList && this.todoLists.length > 0) {
                this.currentTodoList = this.todoLists[0];
            }
        },
        async fetchTags() {
            const response = await instance.get('/tags');
            this.tags = response.data;
        },
    }
})
