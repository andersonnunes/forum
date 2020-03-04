<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        mounted() {
          this.enabled = this.active;
        },

        data() {
            return {
                enabled: false
            }
        },

        computed: {
            classes() {
                return ['btn', this.enabled ? 'btn-primary' : 'btn-secondary']
            }
        },

        methods: {
            subscribe() {
                axios[(this.active ? 'delete' : 'post')](location.pathname + '/subscriptions')
                    .then(() => this.enabled = !this.enabled);
            }
        }
    }
</script>
