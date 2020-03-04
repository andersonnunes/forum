<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <span class="fa fa-bell"></span>
        </a>

        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a class="dropdown-item" :href="notification.data.link"
                    v-text="notification.data.message"
                    @click="markAsRead(notification)"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return { notifications: false };
        },

        async created() {
            const { data } = await axios.get('/profiles/' + window.App.user.name + '/notifications');

            this.notifications = data;
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id);
            }
        }
    }
</script>
