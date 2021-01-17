<template>
    <div class="container">

        <h1>Todo-do list</h1>
        <div class="row jumbotron">
            <div class="col-6">
                <h2>Add task</h2>
                <form action="" class="form-group">
                    <label>Title</label>
                    <input type="text" v-model="title" class="form-control" value="1"
                           placeholder="Example: Create an app vue.js" required>

                    <label>Description</label>
                    <textarea class="form-control" v-model="descr" value="2" id="exampleFormControlTextarea1" rows="3"
                              required></textarea>
                    <br>
                    <button type="button" @click="send" class="btn btn-outline-success">Create</button>

                </form>
            </div>
            <div class="col-6">
                <h3>Listing</h3>
                <div style="overflow: auto; height: 500px">
                    <table class="table list">
                        <thead>
                        <tr>

                            <th>Task</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr v-for="item in list.data" :key="item.id" :id="item.id" :class="item.status">

                            <td>

                                <span data-toggle="modal" class="task-title" :data-target="modalName + item.id">{{item.title}}</span>


                            </td>

                            <td>

                                <svg data-toggle="modal" :data-target="idEdit + item.id"
                                     xmlns="http://www.w3.org/2000/svg" width="25" fill="currentColor"
                                     class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>

                            </td>

                            <td>
                                <svg @click="delSend(item.id)" xmlns="http://www.w3.org/2000/svg" width="25"
                                     fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                </svg>

                            </td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" v-if="checkStatus(item.status)" width="35"
                                     fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" width="35" fill="currentColor"
                                     class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                            </td>
                            </th>

                            <ModalComponent :data="item" @refresh="refresh"/>
                            <EditModalComponent :edit="item" @refresh="refresh"/>

                        </tr>


                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>


</template>

<style>

    .list {

        overflow: scroll !important;
        height: 300px;

    }

    .task-title {

        word-break: break-all;
    }

    .done {
        background: #93d49e;
    }

    .process {

        background: #ffffff;
        font-family: 'Nunito', sans-serif

    }


</style>

<script>

    import ModalComponent from './ModalComponent.vue'
    import EditModalComponent from './EditModalComponent.vue'


    export default {
        components: {ModalComponent, EditModalComponent},
        name: 'TestComponent',

        data() {
            return {
                modalName: '#exampleModalLong',
                ourRequest: null,
                title: null,
                descr: null,
                list: null,
                result: null,
                status: null,
                idEdit: '#editModal'


            }
        },

        async mounted() {

            await this.$axios
                .get('http://localhost:8000/api/listing')
                .then(response => (this.list = response))

        },

        methods: {

            async refresh() {

                await this.$axios
                    .get('http://localhost:8000/api/listing')
                    .then(response => (this.list = response))

            },

            send: async function () {

                let data = {

                    title: this.title,
                    descr: this.descr

                }


                await this.$axios
                    .post('http://localhost:8000/api/create', data)
                    .then(response => (this.result = response))

                this.refresh()
            },

            async delSend(id) {
                let data = {

                    id: id
                }
                await this.$axios
                    .post('http://localhost:8000/api/delete', data)
                    .then(response => (this.result = response))

                setTimeout(this.refresh, 0)
            },

            checkStatus(status, id) {

                if (status == 'done') {

                    return true

                } else {

                    return false
                }

            }

        }

    }
</script>
