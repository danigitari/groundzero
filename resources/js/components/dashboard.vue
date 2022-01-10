<template>
<v-app>
    <v-container >
        <div class="mt-5 mb-5"></div>
        <v-row class="justify-center ma-5">
            <v-toolbar-title  class="blue--text">  <strong>MY SESSIONS</strong></v-toolbar-title>
        </v-row>
        <v-data-table
            :headers="headers"
            :items="sessionData"
            class="blue lighten-4"

        >
        </v-data-table>
    </v-container>
    </v-app>
</template>

<script>
import axios from 'axios';
export default {
name: "dashboard",
    data () { return{
        sessionData:[],

        errors:{},

        headers: [
            {
                text: 'NAME',
                align: 'start',
                value: 'name',
                sortable: true,
            },
            { text: 'PHONENUMBER', value: 'phoneNumber' },
            { text: 'EMAIL', value: 'email' },
            { text: 'DATE', value: 'date' },
            { text: 'START TIME', value: 'start' },
            { text: 'END TIME', value: 'end' },
        ],

    }


    },
    created() {
    this.session();
    },
    methods: {

    session(){
        axios.get('/list_session',{}).then(response => {
            this.sessionData = response.data.data;
            // console.log(this.sessionData)

        }).catch(error => {
            this.errors = error.response.data.errors;
        })
    }
    }
}
</script>

<style scoped>

</style>
