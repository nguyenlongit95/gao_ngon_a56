<template>
    <div class="col-12">
        <p>{{ txt }}</p>
    </div>
</template>

<script>
    import Vue from 'vue';
    import VueToast from 'vue-toast-notification';
    import 'vue-toast-notification/dist/theme-sugar.css';

    Vue.use(VueToast);

    export default {
        data() {
            return {
                txt: 'Base data ware house'
            }
        },
        created: function()
        {
            this.openToast('Base e-commerce', 'success', 2000);
        },
        methods: {
            openToast (message, type, duration, dismissible) {
                Vue.$toast.open({
                    message: message,
                    type: type,
                    duration: duration,
                    dismissible: dismissible,
                    position: 'top-right'
                })
            },
        }
    }
</script>

<style scoped>

</style>
