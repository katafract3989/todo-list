<template>

    <!-- Modal -->
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="newTitle" required>
                        <label>Description</label>
                        <textarea class="form-control" v-model="newDescr"  rows="9" required></textarea>


                    </form>

                    <div class="alert alert-primary" role="alert">
                        {{response}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="update" >Update</button>

                </div>
            </div>
        </div>
    </div>


</template>

<script>

    export default {

        name: 'EditModalComponent',
        props: {
            edit: {
                id: this.id,
                type: Object,
                default(){

                    return {}
                }

            }
        },
        data () {
            return {
               id: 'editModal' + this.edit.id,
                response: null,
                list: null,
                newTitle: null,
                newDescr: this.edit.descr,
                idElem: this.edit.id


            }
        },
        mounted(){

            this.newTitle = this.edit.title,
            this.newDescr = this.edit.descr
        },

        methods: {

          async update(){

                let data = {

                    newTitle: this.newTitle,
                    newDescr: this.newDescr,
                    id: this.edit.id

                }

              await this.$axios
                    .post('http://localhost:8000/api/update', data)
                    .then(response => (this.response = response))
                  if(this.response != null)
                      this.response = this.response.data
              else
                  this.response = 'error'

              this.$emit('refresh')

           }

        }



    }


</script>