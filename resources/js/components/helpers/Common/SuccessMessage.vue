<template>
    <div class="system-message alert alert-success" role="alert" v-if="message">
        <button @click.stop="clearMessage()" class="close">&times;</button>
        <p>{{ message }}</p>
    </div>
</template>
<script>
    export default {
        name: 'success-message',
        props: ['message'],
        methods: {
            clearMessage : function () {
                this.message = '';
            }
        }
    }
</script>
