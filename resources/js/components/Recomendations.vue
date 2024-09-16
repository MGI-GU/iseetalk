<template>
    <div class="container-fluid">
        <h2 style="text-align:center">Add New Task</h2>
        <form @submit.prevent="addTask" style="text-align:center" class="justify-content-center">
            <div v-if="success" class="alert alert-success">Tersimpan</div>
            <div class="row justify-content-center">
                <div class="col-4">
                    <input
                        placeholder="Enter Task Name"
                        type="text"
                        class="form-control"
                        required
                        oninvalid="this.setCustomValidity('data tidak boleh kosong')"
                        oninput="setCustomValidity('')"
                        v-model="task.comment"
                    />
                    <span class="text text-danger">{{ error(errors.name) }}</span>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </div>
            </div>
        </form>

        <h2 style="text-align:center">List of Task</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama Tugas</th>
                    <th>Durasi</th>
                    <th>Ditambahkan Pada</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.comment }}</td>
                    <td>{{ task.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                success: false,
                task: {},
                tasks: [],
                errors: []
            };
        },
        created() {
            this.fetchComments()
        },
        methods: {
            fetchComments() {
                let uri = '/audio/R2Vab7kb0pX/comments';
                this.$http.get(uri).then(response => {
                    this.tasks = response.data.data;
                });
            },
            addTask() {
                let uri = '/comment/R2Vab7kb0pX/post';
                axios.post(uri, this.task)
                .then(response => {
                    this.success = response.data;
                    this.fetchComments()   // you need to call your api again, here, to fetch the latest results after successfully adding a new task
                }).catch(err => {
                    console.log(err);
                });
            },
            error(field) {
                return _.head(field);
            }
        }
    };
</script>