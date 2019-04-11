<template>
    <div class="mt-3">
        <v-card>
            <v-card-title>
                <div class="headline">
                    {{data.name}}
                </div>
                <div class="ml-2">
                    Said {{data.created_at}}
                </div>
            </v-card-title>
            <v-divider></v-divider>

            <!--for edit user reply-->
            <edit-reply :reply="data" v-if="editing"></edit-reply>
            <!--end of edit reply component-->

            <v-card-text v-else v-html="reply">
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions v-if="own">
                <div v-if="!editing">
                    <v-btn icon small>
                        <v-icon @click="edit" color="orange">
                            edit
                        </v-icon>
                    </v-btn>
                    <v-btn @click="destroy" icon small>
                        <v-icon color="red">
                            delete
                        </v-icon>
                    </v-btn>
                </div>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    import EditReply from "./EditReply";

    export default {
        props: ['data', 'index'],

        components: {
            EditReply
        },
        data() {
            return {
                editing: false,
            }
        },
        computed: {
            own() {
                return User.own(this.data.user_id)
            },
            reply() {
                return md.parse(this.data.body)
            }
        },
        created(){
            this.listen();
        },
        methods: {
            listen() {
                EventBus.$on('cancelEditing', () => {
                    this.editing = false
                })
            },

            destroy() {
                EventBus.$emit('deleteReply', this.index);
            },
            save() {

            },
            edit() {
                this.editing = true;
                // EventBus.$emit('editReply', this.index);
            }
        }
    }
</script>

<style scoped>

</style>