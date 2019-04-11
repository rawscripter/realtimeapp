<template>
    <v-card class="mt-5">
        <markdown-editor v-model="body"  ref="markdownEditor"></markdown-editor>
        <v-btn color="green" @click="submitReply" dark>
            Reply
        </v-btn>
    </v-card>
</template>

<script>
    export default {
        props: ['questionSlug'],
        data(){
            return{
                body: null
            }
        },
        methods:{
            submitReply(){
                axios.post(`/api/question/${this.questionSlug}/reply`,{body:this.body})
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('newReply',res.data);
                        window.scrollTo(0,0);
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>

<style scoped>

</style>