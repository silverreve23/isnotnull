<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless"><i class="fas fa-bell"></i></a>
        <div class="navbar-dropdown is-right" v-if="notifications.length">
            <a :href="notification.data.link" class="navbar-item" v-for="notification in notifications" v-text="notification.data.message" @click.prevent="markAsRead(notification)"></a>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                notifications: false
            };
        },
        computed: {
            endpoint(){
                return '/profiles/' + App.user.name + '/notifications';
            }
        },
        created(){
            axios.get(this.endpoint).then(({data}) => this.notifications = data);
        },
        methods: {
            markAsRead(notification){
                console.log(notification);
                let notifyUrl = this.endpoint + '/' + notification.id;

                axios.delete(notifyUrl).then(() => {

                });
            }
        }
    }
</script>
