<script setup>

import { ref, onMounted, computed } from 'vue';
import  axios  from 'axios';

let id = 0;

const data = ref([]);

const newTodo = ref('');
const hideCompleted = ref(false);
const todos = ref ([
  {id:id++,text:'Estudar Vue', done:true},
  {id:id++,text:'Estudar Vuee', done:true},
  {id:id++,text:'Estudar Vueee', done:true},
])

const filteredTodos = computed(() => {
  return hideCompleted.value
  ? todos.value.filter((t) => !t.done)
  : todos.value
})

function addToBase () {
  
  axios.post("http://localhost:8000/insert.php", {
    descricao : newTodo.value
  })
  .then((response => {
    console.log(response.data);
    fetchData();
  }))
  .catch((error) => {
    console.log(error);
  })
}

function deleteTarefa (id) {
  axios.post("http://localhost:8000/delete.php" , {
    id : id
  })
  .then((response) => {
    console.log(response.data);
    fetchData();
  }) 
  .catch((error) => {
    console.log(error);
  })
}
function alterDone (id,done) {
  if (done == 0) {
     axios.post("http://localhost:8000/update.php" , {
      id: id,
      updates: 1
     })
     .then((response) => {
      console.log(response.data);
      fetchData();
     })
     .catch((error) => {
      console.log(error);
     })
  }
  else if(done == 1) {
    axios.post("http://localhost:8000/update.php" , {
      id: id,
      updates: 0
     })
     .then((response) => {
      console.log(response.data);
      fetchData();
     })
     .catch((error) => {
      console.log(error);
     })
  }
}


async function fetchData() {

  try {
    const response = await fetch("http://localhost:8000/get.php");
    const jsonData = await response.json();
    data.value = jsonData;
    console.log(data.value);
  } catch (error) {
    console.error(error);
  }
}


function removeTodo(todo) {
  todos.value = todos.value.filter((t) => t !== todo)
}

onMounted(fetchData);

//onMounted(() => {
//     fetch('http://localhost:8000/get.php')
//         .then(response => response.json())
//         .then(json => {

//           console.log(json)

//         })
// })

</script>

<template>
  <header>
    
    <div>

      <h1> 
        Lista de tarefas:
      </h1>

      <form @submit.prevent = "addToBase">
      <input v-model="newTodo">
      <button>Adicionar</button>

    </form>
    <ul>
      <li v-for="item in data" :key="item.id">
        <input v-if="item.done == 0" type="checkbox" @click="alterDone(item.id, item.done)">
        <input v-if="item.done == 1" type="checkbox" @click="alterDone(item.id, item.done)" checked>
        <!-- <input type="checkbox"> -->
        <!-- <span :class="{ done: todo.done }">{{ todo.text }} -->
        <!-- </span> -->
        <p> {{ item.descricao }}</p>
        <button @click="deleteTarefa(item.id)">X</button>
      </li>
    </ul>
    <button @click="hideCompleted = !hideCompleted">
    {{ hideCompleted ? 'Mostrar tarefas concluídas' : 'Esconder concluídas' }}
    </button>
    </div>
  </header>

  <main>

  </main>
</template>

<style>

</style>
