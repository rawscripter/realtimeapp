<template>
    <v-card>
        <v-card-title>
            <div>
                <div class="headline">
                    {{question.title}}

                    <v-btn v-if="own" @click="edit" icon small>
                        <v-icon color="orange">edit</v-icon>
                    </v-btn>
                </div>
                <br>
                <p class="grey--text">
                    {{question.user}} posted {{question.created_at}}
                </p>
            </div>


            <v-spacer></v-spacer>
            <v-btn color="teal">2 Replies</v-btn>
        </v-card-title>

        <v-card-text v-html="body">
        </v-card-text>

        <v-card-actions>
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
                own: User.own(this.question.user_id)
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
            edit(){
                EventBus.$emit('startEditing')
            }
        }
    }
</script>

<style scoped>

</style>