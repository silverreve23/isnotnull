<template>
    <button type="button" :class="classes" @click="toggle">
        Subscribe
    </button>
</template>
<script>
    export default {
        props: ['active'],
        data(){
            return {
            };
        },
        computed: {
            classes(){
                return ['button is-small', this.active ? 'is-primary' : null];
            },
            endpoint(){
                return location.pathname + '/subscriptions';
            },
            method(){
                return this.active ? 'delete' : 'post';
            }
        },
        methods: {
            toggle(){
                axios.[this.method](this.endpoint).then(res => {
                    this.active = !this.active;
                    this.$emit('changed', this.active);
                });
            }
        }
    }
</script>
