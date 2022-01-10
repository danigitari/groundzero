<template>
    <v-app>
        <nav>
            <v-app-bar elevation="4" class="primary" app>
                <v-app-bar-nav-icon class="white--text" app @click="showDrawer=true"></v-app-bar-nav-icon>
                <v-toolbar-title><span class="white--text "> GROUND ZERO TURF </span></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn prepend-icon="exit_to_app" @click="Logout">
<!--                    <v-icon>exit_to_app</v-icon>-->
                   logout
                </v-btn>

                <!--            <v-app-bar elevation="10" app ></v-app-bar>-->
            </v-app-bar>
            <v-navigation-drawer v-model="showDrawer" app  class="primary lighten-1 " width="350px" >
                <v-app-bar flat class="primary lighten-1 " >
                    <v-spacer></v-spacer>
                    <v-icon @click="showDrawer=false" class="white--text" >navigate_before </v-icon>
                </v-app-bar>
                <v-container class="primary lighten-1 py-5">
                    <v-list>
                        <v-list-item-group
                            class="white--text"
                        >
                            <v-list-item
                                v-for="link in links" :key="link.title" router :to="link.routes"
                                @click="showHomeComponent=false"

                            >
                                <v-list-item-icon>
                                    <v-icon >{{ link.icon }}</v-icon>

                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title >{{ link.title}}</v-list-item-title>


                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>

                </v-container>
                <!--                <v-icon> personal_video</v-icon>-->
                <!--                <v-spacer></v-spacer>-->

            </v-navigation-drawer>

        </nav>
        <span class=" my-5 "></span>
        <home v-if="showHomeComponent"></home>
        <router-view class="my-5" v-if="!showHomeComponent"></router-view>

    </v-app>
</template>

<script>
// import Calender from '../components/Calender.vue'
// import home from "../components/home.vue"
import axios from 'axios';
export default {
//   components: { Calender },
//   components: { home },
    data() {
        return {
            showDrawer: false,
            showHomeComponent :true,

            links: [
                { icon:'dashboard', title:'my sessions' , routes:'/dashboard'},
                { icon:'dashboard', title:'add sessions' , routes:'/home'},
                { icon:'dashboard', title:'Booked sessions' , routes:'/listsessions'},
                { icon:'dashboard', title:'Edit sessions' , routes:'/edit_sessions'},

            ],
        }
    },
    methods: {
        Logout(){
            axios.get('/logout',{}).then(response => {
                window.location.href = '/login';
            })

        }
    }
}
</script>
