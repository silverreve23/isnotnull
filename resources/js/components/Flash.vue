<template>
    <div class="notification" v-if="show">
        <button @click="hide" class="delete"></button>
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data(){
            return {
                show: false,
                body: this.message
            };
        },
        created(){
            if(this.body) this.flash(this.body);

            window.events.$on('flash', $message => $message && this.flash($message));
        },
        methods: {
            flash($message){
                this.body = $message;
                this.show = true;
            },
            hide(){
                this.body = null;
                this.show = false;
            }
        }
    }
</script>

<style>
    .notification {
        position: fixed;
        bottom: 5px;
        right: 5px;
        width: 310px;
        border: 1px solid #c1c1c1;
    }
</style>
