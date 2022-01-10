<template>
    <v-app>
        <v-container>
        <div class="mt-5 mb-5"></div>
            <v-row class="justify-center ma-5">
            <v-toolbar-title  class="blue--text">  <strong>LIST OF ALL BOOKED SESSIONS </strong></v-toolbar-title>
            </v-row>
        <v-data-table
            outlined
            class="mt-5 blue lighten-4"
            :headers="headers"
            :items="sessionData"
        > </v-data-table>
        </v-container>
    </v-app>
</template>

<script>
import axios from 'axios'
export default {
    name: "listsessions.vue",
    data() {
        return{
            sessionData:[],
            headers:[

                {   text: 'DATE',
                    align: 'start',
                    sortable: true,
                    value:'date'
                },
                    {text: 'START TIME', value: 'start'},
                {text: 'END TIME', value: 'end'}
        ]
        }

    },
    created(){
        this.getAllSessions();
    },
    methods:{
        getAllSessions(){
            axios.get('/list-all-sessions',{}).then(response => {
                this.sessionData = response.data.data
            }).catch(error => {

            })
        }
    }


}

</script>

<style scoped>

</style>
