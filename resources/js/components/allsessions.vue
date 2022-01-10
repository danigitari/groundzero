<template>
    <v-app>
        <v-container >
            <v-alert
                dense
                text
                type="success"
                v-if="alert1"
            >
                <strong> SESSION DELETED SUCCESSFULLY</strong>
            </v-alert>
            <div class="mt-5 mb-5"></div>
            <v-row class="justify-center ma-5">
                <v-toolbar-title  class="blue--text">  <strong>ALL SESSIONS</strong></v-toolbar-title>
            </v-row>
            <v-data-table
                :headers="headers"
                :items="sessionData"
                class="blue lighten-4"

            >
                <!-- <template v-slot:item.edit="{ item }">
                    <v-chip
                        color="primary"
                        @click=" edit(item.id)"

                    >
                        EDIT

                    </v-chip> -->
                <!-- </template> -->
                <template v-slot:item.delete="{ item }">
                    <v-chip
                        color="red"
                        @click="drop(item.id)"
                    >
                        DELETE
                    </v-chip>
                </template>
            </v-data-table>
        </v-container>
    </v-app>
</template>

<script>
import axios from "axios";

export default {
    name: "edit_sessions",
    data() {
        return{
            sessionData:[],
            id:null,
            data :{
                id:null
            },

            errors:{},
            alert1:false,
            headers: [
                { text: 'ID', value: 'id'},
                {
                    text: 'NAME',
                    align: 'start',
                    value: 'name',
                },
                { text: 'PHONENUMBER', value: 'phoneNumber' },
                { text: 'EMAIL', value: 'email' },
                { text: 'DATE', value: 'date' },
                { text: 'START TIME', value: 'start' },
            { text: 'END TIME', value: 'end' },
                { text: 'DELETE', value: 'delete'},

            ],

        }

    },
    created() {
        this.session();
    },
    methods: {


        session(){
            axios.get('/all-sessions',{}).then(response => {

            this.sessionData = response.data.data;
                                                                                
            console.log(this.sessionData);
                // console.log(this.sessionData)

            }).catch(error => {
                this.errors = error.response.data.errors;
            })
          
            

        },

        drop(id){
            console.log(id);
            this.id = id;
            this.data = {identity:this.id}
            console.log(this.data);
            
            console.log (this.id);
            axios.post('/drop', {name : this.id}).then(response => {
                this.alert1 = true;
                this.session();
            })
        }

    }
}

</script>

<style scoped>

</style>
