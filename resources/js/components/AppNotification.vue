<template>
    <div class="text-xs-center">
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon :color="color">add_alert</v-icon>
                    <span>{{unread_count}}</span>
                </v-btn>
            </template>
            <v-list>
                <v-list-tile v-for="item in unRead" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-tile-title @click="markAsRead(item)" class="unread">{{item.replyBy}} reply on:
                            {{item.question}}
                        </v-list-tile-title>
                    </router-link>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile v-for="item in read" :key="item.id">
                    <router-link :to="item.path">
                        <v-list-tile-title class="read">{{item.replyBy}} reply on: {{item.question}}
                        </v-list-tile-title>
                    </router-link>
                </v-list-tile>
            </v-list>
        </v-menu>
    </div>
</template>
<script>
    export default {
        name: "AppNotification",
        data() {
            return {
                read: {},
                unRead: {},
                unread_count: 0
            }
        },
        created() {
            if (User.loggedIn()) {
                this.getNotification()
            };

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.unRead.unshift(notification);
                    this.unread_count++;
                });



        },
        methods: {
            getNotification() {
                axios.post('/api/notifications')
                    .then(res => {
                        this.read = res.data.read;
                        this.unRead = res.data.unRead;
                        this.unread_count = res.data.unRead.length;

                    })
                    .catch(err => Exception.handle(err))
            },
            markAsRead(data) {
                axios.post('/api/read/notification', {id: data.id})
                    .then(res => {
                        this.unRead.splice(data, 1);
                        this.read.unshift(data);
                        this.unread_count--;
                    })
                    .catch(err => console.log(err.response.data))
            }
        },
        computed:{
            color(){
                return this.unread_count != 0 ? 'red' : 'black';
            }
        }
    }
</script>
<style scoped>
    .unread {
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }
    .read {
        text-decoration: none;
        color: #000;
        font-weight: normal;
    }
</style>