<template>
    <div class="system-messages sticky-top">
        <error-message :error="errorMsg"></error-message>
        <success-message :message="successMsg"></success-message>
    </div>
</template>
<script>
    import ErrorMessage from './ErrorMessage.vue';
    import SuccessMessage from './SuccessMessage.vue';

    export default {
        name: 'system-messages',
        components: {
            ErrorMessage,
            SuccessMessage
        },
        props : ['successMsg', 'errorMsg'],
        mounted() {

        },

        computed: {
            /*errors() {
                //return this.$store.state.errors;
            },
            messages() {
                //return this.$store.state.messages;
            }*/
        },
        methods: {
            onClearError(index) {
                //this.$store.dispatch(CLEAR_ERROR, index);
            },
            onClearMessage(index) {
                alert('clearing' + this.messages[index]);
                this.messages[index] = '';
                //this.$store.dispatch(CLEAR_MESSAGE, index);
            }
        }
    }
</script>
