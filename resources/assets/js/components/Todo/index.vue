<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-6">
          <form @submit.prevent="onSubmit" class="form-inline">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="New Task Name" v-model="taskName">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Add Task</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-6">
          <div v-if="isLoading" class="alert alert-info"> Loading data... </div>
          <ul v-else-if="tasks.length" class="list-group">
            <li v-for="task in tasks" :key="task.id" class="list-group-item">
              <div class="form-check">
                <input 
                  :id="'task'+task.id"
                  class="form-check-input"
                  type="checkbox"
                  :value="task.id"
                  :checked="task.done"
                  @click="_handleChecked(task.id)"
                >
                <label class="form-check-label" :for="'task'+task.id">
                  {{ task.name }}
                </label>
              </div>
              <div class="delete-btn">
                <a href="#" @click.prevent="deleteTask(task.id)" class="badge badge-danger">delete</a>
              </div>
            </li>
          </ul>
          <div v-else class="alert alert-warning"> No Data </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      mounted () {
        this.fetchTasks()
      },
      data: function () {
        return {
          taskName: '',
          tasks: [],
          isLoading: false
        }
      },
      methods: {
        fetchTasks: async function () {
          if (!this.tasks.length) {
            this.isLoading = true
          }
          
          const {data} = await axios.get('api/tasks')
            .then((res) => {
              this.isLoading = false
              return res
            })
            .catch((err) => {
              console.log(err)
              this.isLoading = false
            })
          
          this.tasks = data
        },
        
        onSubmit: async function () {
          if (this.taskName) {
            const {data} = await axios.post('api/tasks', {
              name: this.taskName
            })
            .then((res) => {
              this.taskName = ''
              return res
            })
            .catch((err) => {
              console.log(err)
            })

            this.tasks = data
          }
        },

        _handleChecked: async function (id = null) {
          if (id) {
            const {data} = await axios.put('api/tasks/' + id)
            .then((res) => {
              return res
            })
            .catch((err) => {
              console.log(err)
            })

            this.tasks = data
          }
        },

        deleteTask: async function (id = null) {
          if (id) {
            const {data} = await axios.delete('api/tasks/' + id)
            .then((res) => {
              return res
            })
            .catch((err) => {
              console.log(err)
            })

            this.tasks = data
          }
        }
      }
    }
</script>
