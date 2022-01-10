<template>
    <v-app>
    <v-card width="600px" color="grey lighten-2 " class="mx-auto mt-12 pa-10 ">
            <v-card-title class="justify-center">
            REGISTER NEW ADMIN
        </v-card-title>
        <v-card-text>
            <v-alert
                dense
                outlined
                prominent
                type="error"
                v-if="duplicate"

            >
                email or username is already in use
            </v-alert>
            <v-text-field label="username" prepend-icon="person" v-model="formData.name" autocomplete="false" />
            <v-alert
                dense
                outlined
                type="error"
                v-if="errors.name"
            >
                {{errors.name}}
            </v-alert>
            <v-text-field label="email" prepend-icon="email" v-model="formData.email" autocomplete="false" />
            <v-alert
                dense
                outlined
                type="error"
                v-if="errors.email"
            >
                {{errors.email}}
            </v-alert>
            <v-text-field label="password" prepend-icon="lock" v-model="formData.password" type="password" autocomplete="false" />
            <v-alert
                dense
                outlined
                type="error"
                v-if="errors.password"
            >
                {{errors.password}}
            </v-alert>
            <v-text-field label="confirm password" prepend-icon="lock" v-model="formData.password_confirmation" type="password" autocomplete="false" />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn color="primary" @click="submit()"> SUBMIT </v-btn>

        </v-card-actions>
        <!-- <a href="/login"> already have an account?</a> -->
    </v-card>
    </v-app>
</template>

<script>
import axios from 'axios';
export default {
name: "register",
    data: () => {
    return {
        formData: {
            name:'',
            email:'',
            password:'',
            password_confirmation:'',
        },
        errors:{},
        duplicate:false,
        recievedResponse:false,
    }
    },

    methods: {
    redirect(){
        window.location.href = '/test';
    },
    submit(){

        axios.post('/adminRegister',this.formData).then(response => {
            window.location.href = '/test';
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors;
                        console.log(this.errors);

                    }
            if(error.response.status == 500){
                this.duplicate=true;
                console.log(this.errors);
            }
                console.log(error);



        })

    }
    }
}
</script>

<style scoped>

</style>
