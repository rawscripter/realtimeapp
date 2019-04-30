<template>
    <v-card style="margin: 50px auto">
        <v-card-title>
            <div>
                <div class="headline">
                    {{question.title}}
                </div>
                <br>
                <p class="grey--text">
                    {{question.user}} posted {{question.created_at}}
                </p>
            </div>
            <v-spacer></v-spacer>
            <v-btn color="teal" dark>{{replyCount}} Replies</v-btn>
        </v-card-title>

        <v-card-text v-html="body">
        </v-card-text>


        <v-divider>4</v-divider>
        <v-card-actions>

            <v-btn v-if="own" @click="edit" icon small>
                <v-icon color="orange">edit</v-icon>
            </v-btn>

            <v-btn v-if="own" @click="deleteQuestion" icon small>
                <v-icon color="red">delete</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    export default {
        name: "ShowSingleQuestion",
        props: ['question'],
        isUser: false,
        data() {
            return {
                own: User.own(this.question.user_id),
                replyCount: this.question.reply_count
            }
        },
        computed: {
            body() {
                return md.parse(this.question.body)
            }
        },
        methods: {
            deleteQuestion() {
                axios.delete(`/api/question/${this.question.slug}`)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => console.log(error.response.data))
            },
            edit() {
                EventBus.$emit('startEditing')
            }
        },
        created() {
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    console.log(notification);
                    if (notification.path == this.question.path){
                        this.replyCount++;
                    }
                });

        }
    }
</script>

<style scoped>

</style>