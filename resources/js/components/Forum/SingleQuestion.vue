<template>
    <v-flex xs8 offset-xs2 >
        <div v-if="question">
            <edit-question
                    v-if="editing"
                    :question = question
            ></edit-question>

            <show-question
                    v-else
                    :question = question
            ></show-question>

            <replies :data="question"></replies>

            <new-reply :questionSlug="question.slug"></new-reply>

        </div>
    </v-flex>
</template>

<script>
    import ShowQuestion from './ShowSingleQuestion'
    import EditQuestion from './EditQuestion'
    import Replies from "../Reply/Replies";
    import NewReply from "../Reply/NewReply";
    export default {
        components:{ShowQuestion,EditQuestion,Replies,NewReply},
        data(){
            return {
                question:null,
                editing:false
            }
        },
        created(){
            this.listen()
            this.getQuestion()
        },
        methods:{
            listen(){
                EventBus.$on('startEditing',()=>{
                    this.editing = true
                })
                EventBus.$on('cancelEditing',()=>{
                    this.editing = false
                })
            },
            getQuestion(){
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
            }
        }
    }
</script>

<style>
</style>