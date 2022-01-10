<template>
    <v-app>
        <div class="mb-15"></div>
        <v-container height="100px"  >
            <v-card color="grey lighten-2" height="580px" width="1100px" >
                <v-row justify="space-around">

                    <v-col md="8">
                        <div class="my-1"></div>

                        <v-card-title class="justify-center font-weight-bold" flat> ADD NEW SESSION</v-card-title>


                    </v-col>

                </v-row>

                <v-row justify="space-around"  >

                    <v-col md="8">
                        <validation-observer
                            ref="observer"
                            v-slot="{ invalid }"
                        >
                            <form @submit.prevent="submit">
                                <v-alert
                                    dense
                                    text
                                    type="success"
                                    v-if="alert=false"
                                >
                                    <strong> SESSION ADDED SUCCESSFULLY</strong>
                                </v-alert>
                                <v-alert
                                    dense
                                    text
                                    type="error"
                                    prominent
                                    v-if="alert3=false"
                                >
                                    <strong> {{ "there is a session booked at this time" }}</strong>
                                </v-alert>
                                <v-alert
                                    dense
                                    text
                                    prominent
                                    type="error"
                                    v-if="alert2=false"
                                >
                                    <strong> date chosen is already past </strong>
                                </v-alert>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="Name"
                                    rules="required|max:20"
                                >
                                    <v-text-field
                                        v-model="turfSessionData.name"
                                        :counter="20"
                                        :error-messages="errors"
                                        label="Name"
                                        required
                                    ></v-text-field>
                                </validation-provider>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="phoneNumber"
                                    :rules="{
                              required: true,
                               }"
                                >
                                    <v-text-field
                                        v-model="turfSessionData.phoneNumber"
                                        :counter="15"
                                        :error-messages="errors"
                                        label="Phone Number"
                                        required
                                    ></v-text-field>
                                </validation-provider>
                                <validation-provider
                                    v-slot="{ errors }"
                                    name="email"
                                    rules="required|email"
                                >
                                    <v-text-field
                                        v-model="turfSessionData.email"
                                        :error-messages="errors"
                                        label="E-mail"
                                        required
                                    ></v-text-field>
                                </validation-provider>
                                <validation-provider
                                    v-slot="{ errorszzzzz }"
                                    name="session"
                                >
                                    <v-menu
                                        v-model="menu1"
                                        :close-on-content-click="false"
                                        max-width="290"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                :value="computedDateFormattedMomentjs"
                                                clearable
                                                label="session date"
                                                prepend-icon="date_range"
                                                readonly
                                                v-model="turfSessionData.date"
                                                v-bind="attrs"
                                                v-on="on"
                                                @click:clear="date = null"
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="turfSessionData.date"
                                            @change="menu1"
                                        ></v-date-picker>
                                    </v-menu>
                                </validation-provider>
                                <v-menu
                                    ref="menu"
                                    v-model="menu4"
                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="time"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="turfSessionData.start"

                                            label="session starting time"
                                            prepend-icon="access_time"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
<!--                                    <v-time-picker-->
<!--                                        v-if="menu4"-->
<!--                                        v-model="turfSessionData.start"-->
<!--                                        full-width-->
<!--                                        :max="turfSessionData.end"-->
<!--                                        @click:minute="$refs.menu.save(time)"dd-->
<!--                                    ></v-time-picker>-->
                                </v-menu>
                                <v-menu
                                    ref="menu"
                                    v-model="menu3"

                                    :close-on-content-click="false"
                                    :nudge-right="40"
                                    :return-value.sync="time"
                                    transition="scale-transition"
                                    offset-y
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="turfSessionData.end"
                                            label="session ending time"
                                            prepend-icon="access_time"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
<!--                                    <v-time-picker-->
<!--                                        v-if="menu3"-->
<!--                                        v-model="turfSessionData.end"-->
<!--                                        :min="turfSessionData.start"-->
<!--                                        full-width-->
<!--                                        @click:minute="$refs.menu.save(time)"-->
<!--                                    ></v-time-picker>-->
                                </v-menu>
                                <v-btn
                                    class="mr-4"
                                    type="submit"
                                    :disabled="invalid"
                                >
                                    submit
                                </v-btn>
                            </form>
                        </validation-observer>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </v-app>
</template>
<script>
import {required, digits, email, max, regex} from 'vee-validate/dist/rules'
import {extend, ValidationObserver, ValidationProvider, setInteractionMode} from 'vee-validate'
import moment from 'moment'
import {format, parseISO} from 'date-fns'
import axios from 'axios';

setInteractionMode('eager')

extend('digits', {
    ...digits,
    message: '{_field_} needs to be {length} digits. ({_value_})',
})

extend('required', {
    ...required,
    message: '{_field_} can not be empty',
})

extend('max', {
    ...max,
    message: '{_field_} may not be greater than {length} characters',
})

extend('regex', {
    ...regex,
    message: '{_field_} {_value_} does not match {regex}',
})

extend('email', {
    ...email,
    message: 'Email must be valid',
})

export default {
    props:{
        turfSessionData:{required:true}

    },
    components: {
        ValidationProvider,
        ValidationObserver,


    },
    data: () => ({
            //
            // name:  this.turfSessionData.name,
            // phoneNumber: this.turfSessionData.phoneNumber,
            // email: this.turfSessionData.email,
            // start: this.turfSessionData.start,
            // end:this.turfSessionData.end,
            // date: this.turfSessionData.date,

        alert:false,
        error:null,
        alert2:false,
        alert3:false,
        select: null,
        checkbox: null,
        menu1: false,
        menu2: false,
        menu3: false,
        menu4: false,
        time: null,
        modal2: false,
        date: this.turfSessionData.date,
    }),
    computed: {
        computedDateFormattedMomentjs() {
            return this.date ? moment(this.date).format('dddd, MMMM Do YYYY') : ''
        },
        computedDateFormattedDatefns() {
            return this.date ? format(parseISO(this.date), 'EEEE, MMMM do yyyy') : ''
        },
    },
    // created(){
    //     this.test();
    // },

    methods: {
        test(){
          console.log(this.turfSessionData)
        },
        submit() {
            if(this.turfSessionData.date < this.date ){
                this.alert2 = true;
            }
            else{
                axios.post('/new_session',this.turfSessionData).then(response => {
                    this.error = response.data.data;
                    if(this.error){
                        this.alert3 = true;
                        this.alert = false;
                    }
                    else {
                        this.alert = true;
                        this.alert3 = false;


                    }
                    console.log(this.error)
                }).catch(error => {

                    console.log(error.response.data.data);
                })
            }

            this.$refs.observer.validate();
        },

    },
}
</script>
