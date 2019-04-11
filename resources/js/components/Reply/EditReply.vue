<template>
    <div>
        <markdown-editor v-model="reply.body" ref="markdownEditor"></markdown-editor>

        <div>
            <v-btn icon small>
                <v-icon @click="update" color="green">
                    save
                </v-icon>
            </v-btn>
            <v-btn @click="cancel" icon small>
                <v-icon color="black">
                    cancel
                </v-icon>
            </v-btn>
        </div>

    </div>
</template>

<script>
    export default {
        name: "EditReply",
        props: ['reply'],
        methods:{
            cancel(){
                EventBus.$emit('cancelEditing');
            },
            update(){
                axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,{body:this.reply.body})
                    .then(res=>{
                        if (res.status == 202){
                            this.cancel();
                        }
                    })
                    .catch(err => err.response.data)
            }
        }
    }
</script>

<style scoped>

</style>