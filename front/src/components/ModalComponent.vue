<template>

    <div>

    <!-- Modal -->
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{data.title}}  <span :class="styleMsg"> {{  showMsg }}</span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: left">
                    <span><b>Описание:</b></span><br>
                    {{data.descr}}

                    <hr>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('refresh')" data-dismiss="modal">Close</button>
                    <button type="button" v-if="checkStatus(data.status)" class="btn btn-success" @click="doneTask">Completed</button>

                </div>
            </div>
        </div>
    </div>


    </div>
</template>

<script>

    export default {
        name: 'ModalComponent',
        props: {
            data: {
                id: this.id,
                type: Object,
                default(){

                    return {}
                }

            }
        },
        data () {
            return {

                id: 'exampleModalLong' + this.data.id,
                response: null,
                showMsg: null,
                styleMsg: null

            }
        },

        methods: {

           async doneTask(){

               let data = {

                    id: this.data.id


                }

                await this.$axios
                    .post('http://localhost:8000/api/status', data)
                    .then(response => (this.response = response))

                this.$emit('refresh')
                $('#' + this.id).modal('hide')



            },
            checkStatus(status){
                if(status == 'process'){

                    this.showMsg  = ' Process'
                    this.styleMsg = 'badge badge-info'
                    return true
                }

                else{
                    this.showMsg  = ' Completed'
                    this.styleMsg = 'badge badge-success'
                    return false
                }


            }

        }






    }


</script>