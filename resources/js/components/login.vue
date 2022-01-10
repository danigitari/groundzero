<template>
    <v-app>
        <v-card width="600px" color="grey lighten-2 " class="mx-auto mt-12 pa-10 ">
            <v-card-title class="justify-center">
                LOGIN
            </v-card-title>
            <v-card-text>
                <v-alert
                    dense
                    outlined
                    prominent
                    type="error"
                    v-if="alert1"

                >
                    {{errors}}
                </v-alert>
                <v-text-field label="username" prepend-icon="email" v-model="formData.name"/>
<!--                <v-alert-->
<!--                    dense-->
<!--                    outlined-->
<!--                    prominent-->
<!--                    type="error"-->
<!--                    v-if="errors"-->

<!--                >-->

<!--                </v-alert>-->
                <v-text-field label="password" type="password" prepend-icon="lock" v-model="formData.password"/>

            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn color="primary" @click.prevent="submit"> SUBMIT</v-btn>
            </v-card-actions>

        </v-card>

    </v-app>
</template>

<script>
import axios from 'axios';
export default {
    name: "login",
    data: () => {
        return {
            formData: {
                name: '',
                password: '',
            },
            errors: [],
            role: [],
            alert1:false
        }
    },
    methods: {
        submit() {
            
            axios.post('/login', this.formData).then(response => {
                // this.$router.replace({path: '/parent' });
                this.errors = response.data.errors;
                this.role = response.data.role;
                if(!this.errors){
                    if(this.role){
                    if(this.role == 'admin'){
                        window.location.href = '/admin';
                    }
                    else if(this.role == 'user'){
                        window.location.href = '/test';
                        }
                    else{
                        window.location.href = '/test';
                    }
                         
                }
                }

                else{
                        this.alert1=true;
                }
               
                 }).catch(error => {
                    if (error) {
                        this.errors = error.response.data.errors;
                        console.log(this.errors);
                    }
                })

            }
        }

}
</script>

<style scoped>

</style>
